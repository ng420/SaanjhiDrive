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
    //string user_name = Session["username"];
    string user_name = "abhishek";
    foreach(string f in Request.Files.AllKeys) {
        HttpPostedFile file = Request.Files[f];
       file.SaveAs("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + user_name + file.FileName); 
       } 
       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
       try{
       using (StreamReader streamReader = File.OpenText("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\xtrafiles2beadded2server.txt"))
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
       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
               // Insert into database
               }
               catch(Exception ehluseecksa){
               Response.Write("Error in uploading : " + dirs[i]);
               }
           }
       }
       /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
               //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               byte[] computedHash = new MD5CryptoServiceProvider().ComputeHash(File.ReadAllBytes("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + user_name +file_i[0]));
                var sBuilder = new StringBuilder();
                Response.Write("hiiiii\n");
                foreach (byte b in computedHash)
                {
                    sBuilder.Append(b.ToString("x2").ToLower());
                }
               string file_hash = sBuilder.ToString();
               Response.Write(file_hash);
               //string file_hash = "ifoi498h34ty9ut438vn" + file_i[1] ;
               //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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
                  
                  if(already_present == 0)
                  {
                      file_i[1] = file_i[1].Replace("\\\\","!");
                      string insertQuery = "INSERT INTO filesystem (file_id, file_name, file_hash, owner, directory_path, isFolder) VALUES ('"+ next_file_id+"','"+file_i[0]+"','"+file_hash+"','"+user_name+"','"+file_i[1]+"','0')";
                      MySqlCommand cmd21 = new MySqlCommand(insertQuery, connection);
                      cmd21.ExecuteNonQuery();
                      //insert into database
                      string[] ext = file_i[0].Split('.');
                      FileInfo fi = new FileInfo("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + user_name +file_i[0]);
                      if (fi.Exists)
                            fi.MoveTo("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + next_file_id.ToString() +"."+ext[1]);
                      //rename this file..
                  }
                  else if(already_present ==1)
                  {
                      file_i[1] = file_i[1].Replace("\\\\","!");
                      string insertQuery = "INSERT INTO filesystem (file_id, file_name, file_hash, owner, directory_path, isFolder) VALUES ('"+ file_id+"','"+file_i[0]+"','"+file_hash+"','"+user_name+"','"+file_i[1]+"','0')";
                      MySqlCommand cmd3 = new MySqlCommand(insertQuery, connection);
                      cmd3.ExecuteNonQuery();
                      //insert into database......with same file id as found above
                      if ((System.IO.File.Exists("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + user_name +file_i[0])))
                            System.IO.File.Delete("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + user_name +file_i[0]);
                      // delete file_i[0]
                  }
                  else
                  {
                      if ((System.IO.File.Exists("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + user_name +file_i[0])))
                            System.IO.File.Delete("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + user_name +file_i[0]);
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
            <p> hey it is test phase  </p>
        </div>
        </form>
    </body>
</html>
