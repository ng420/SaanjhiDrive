<%@ Page Language="C#" %>
<%@ Import Namespace="System"%>
<%@ Import Namespace="System.IO"%>
<%@ Import Namespace="System.Net"%>
<%@ Import NameSpace="System.Web"%>
<%@ Import Namespace = "System.Data" %>
<%@ Import Namespace = "MySql.Data.MySqlClient" %>
<%@ Import Namespace = "System.Security.Cryptography" %>

<Script  runat=server>
void Page_Load(object sender, EventArgs e) {
    string path = Server.MapPath("/");
    //string user_name = (string)Session["username"]; //                                    Change this later !!
    //string user_name = "abhishek";
    string user_name;
    using (StreamReader streamReader = File.OpenText(path+"DesktopApp\\currentUsersUsername.txt"))
        user_name = streamReader.ReadLine();

    //UPLOAD TEXTFILE FROM CLIENT CONTAINING NAME OF NEW FOLDERS TO BE CREATED

    foreach(string f in Request.Files.AllKeys) {
        HttpPostedFile file = Request.Files[f];  //always a text file
       file.SaveAs(path+"DesktopApp\\" + file.FileName);
    }
    
     ////////////////////////////////////////////////Declare Variables and set up connection/////////////////////////////////////////////////////////
       MySqlConnection connection = new MySqlConnection("Server=localhost;Database=mysql_db;Uid=root;Pwd=r00tpass;");
       int next_file_id = 0;  
       string line="";
       string[] fileListFolder={};
       string[] dirs={};
       int len=0;
       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       //get next file id from database
       try{        
            connection.Open();
            MySqlCommand cmd = new MySqlCommand("SELECT file_id FROM filesystem ORDER BY file_id", connection);
            MySqlDataReader rdr010101 = cmd.ExecuteReader();
            while (rdr010101.Read())
                next_file_id = (int)rdr010101.GetValue(0);
            next_file_id++;
            rdr010101.Close();
          }
          catch(Exception ehchecksa){
              Response.Write("Connection problem !");
              Response.End();
          }
       //////////////////////////////////////////////////////Get the file list to be uploaded to the server///////////////////////////////////////////
       try{
       using (StreamReader streamReader = File.OpenText(path+"DesktopApp\\xtrafiles2beadded2server.txt"))
           line = streamReader.ReadToEnd();
       fileListFolder = line.Split('`');
       ///Directories
       dirs = fileListFolder[1].Split('\n');
       len = dirs.Length;
       }
       catch(Exception ehchdecksa){
              Response.Write("Error in opening file !");
              Response.End();
       }
       //////////////////////////////////////////////////////Insert directory information into database//////////////////////////////////////////////
       for(int i=0;i<len;i++)
       {
           if(dirs[i].Length > 2)
           {
               try{
               string[] dirs_i = dirs[i].Split(';');
               dirs_i[1] = dirs_i[1].Replace("\\\\","!");
               string insertQuery = "INSERT INTO filesystem (file_id, file_name, owner, directory_path, isFolder) VALUES ('"+ next_file_id+"','"+dirs_i[0]+"','"+user_name+"','"+dirs_i[1]+"','1')";
               MySqlCommand cmd1 = new MySqlCommand(insertQuery, connection);
               cmd1.ExecuteNonQuery();
               next_file_id++;
               // Insert into database
               }
               catch(Exception ehluseecksa){
               Response.Write("Error in uploading : " + dirs[i]);
               }
           }
       }
       /////////////////////////////////////////////////Enter file info on database///////////////////////////////////////////////////////////
       ///Files
       string[] files = fileListFolder[0].Split('\n');
       len = files.Length;
       int already_present =0;
       int file_id =0;
       for(int i=0;i<len;i++)
       {
           if(files[i].Length > 2)
           {
               try{
               file_id =0;
               already_present =0;
               string[] file_i = files[i].Split(';');
               ///////////////////////////////////////////Compute MD5 Hash//////////////////////////////////////////////
               //byte[] computedHash = new MD5CryptoServiceProvider().ComputeHash(File.ReadAllBytes(path+"DesktopApp\\TestingDesktopApp\\" + user_name +file_i[0]));
               byte[] computedHash = new MD5CryptoServiceProvider().ComputeHash(File.ReadAllBytes(path+"files\\" + user_name +file_i[0]));
                var sBuilder = new StringBuilder();
                Response.Write("hiiiii\n");
                foreach (byte b in computedHash)
                {
                    sBuilder.Append(b.ToString("x2").ToLower());
                }
               string file_hash = sBuilder.ToString();
               Response.Write(file_hash);
               //////////////////////////////////////////Using File Hash check if file is already present///////////////////////////////////////
                    MySqlCommand cmd2 = new MySqlCommand("SELECT file_id, file_hash, owner FROM filesystem ORDER BY file_id", connection);
                    MySqlDataReader rdr = cmd2.ExecuteReader();        
                    while (rdr.Read())
                    {
                         if(rdr.GetValue(1)==file_hash)
                         {
                                if(rdr.GetValue(2)==user_name)// from where to get the owner...
                                    already_present = 2;                                
                                else 
                                {
                                    already_present=1;
                                    file_id = (int)rdr.GetValue(0);
                                }
                                break;   
                         }
                        file_id = (int)rdr.GetValue(0);
                    }
                    rdr.Close();
                  
                  if(already_present == 0)// if this file was not present in database
                  {
                      file_i[1] = file_i[1].Replace("\\\\","!");
                      string insertQuery = "INSERT INTO filesystem (file_id, file_name, file_hash, owner, directory_path, isFolder) VALUES ('"+ next_file_id+"','"+file_i[0]+"','"+file_hash+"','"+user_name+"','"+file_i[1]+"','0')";
                      MySqlCommand cmd21 = new MySqlCommand(insertQuery, connection);
                      cmd21.ExecuteNonQuery();
                      //insert into database
                      //string[] ext = file_i[0].Split('.');
                      string ext = file_i[0].Substring(file_i[0].LastIndexOf('.')+1);
                      FileInfo fi = new FileInfo(path+"files\\" + user_name +file_i[0]);
                      if (fi.Exists)
                            fi.MoveTo(path+"files\\" + next_file_id.ToString() +"."+ext);
                      //rename this file..
                  }
                  else if(already_present ==1)// if another user has the same file
                  {
                      file_i[1] = file_i[1].Replace("\\\\","!");
                      string insertQuery = "INSERT INTO filesystem (file_id, file_name, file_hash, owner, directory_path, isFolder) VALUES ('"+ file_id+"','"+file_i[0]+"','"+file_hash+"','"+user_name+"','"+file_i[1]+"','0')";
                      MySqlCommand cmd3 = new MySqlCommand(insertQuery, connection);
                      cmd3.ExecuteNonQuery();
                      //insert into database......with same file id as found above
                      if ((System.IO.File.Exists(path+"files\\" + user_name +file_i[0])))
                            System.IO.File.Delete(path+"files\\" + user_name +file_i[0]);
                      // delete file_i[0]
                  }
                  else// if the same user already has this file
                  {
                      if ((System.IO.File.Exists(path+"files\\" + user_name +file_i[0])))
                            System.IO.File.Delete(path+"files\\" + user_name +file_i[0]);
                      // delete file_i[0]
                  }
             
               next_file_id++;
                 }
               catch(Exception ehasjskyoheck){
                  Response.Write("Error in uploading : " + files[i]);
               }
               }
               
           }
           connection.Close();         
}

</Script>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        <form id="form1" runat="server">
        <div>
            AMen!
        </div>
        </form>
    </body>
</html>
