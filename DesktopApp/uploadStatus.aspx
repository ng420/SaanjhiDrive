<%@ Page Language="C#" %>
<%@ Import Namespace="System"%>
<%@ Import Namespace="System.IO"%>
<%@ Import Namespace="System.Net"%>
<%@ Import NameSpace="System.Web"%>
<%@ Import Namespace = "System.Data" %>
<%@ Import Namespace = "MySql.Data.MySqlClient" %>

<Script  runat=server>
void Page_Load(object sender, EventArgs e) {
    string path = Server.MapPath("/");
    foreach(string f in Request.Files.AllKeys) {
        HttpPostedFile file = Request.Files[f];
       file.SaveAs(path+"DesktopApp\\" + file.FileName);      
    }   // save status files..
    
    string status;
    string inputString;
    using (StreamReader streamReader = File.OpenText(path+"DesktopApp\\status.txt"))
        inputString = streamReader.ReadLine();// read username and password
    string[] words = inputString.Split(';');
	status = words[0];
    string user_name = words[1];
    string password = words[2];
 
    using (StreamWriter outfile1 = new StreamWriter(path+"DesktopApp\\currentUsersUsername.txt"))    
        {
            outfile1.Write(user_name);// save current user username
        }
    Session["username"] = user_name; 

    // Check Username and password.....




    int i = -1;
    try{
        MySqlConnection connection = new MySqlConnection("Server=localhost;Database=mysql_db;Uid=root;Pwd=r00tpass;");
       // connection.Open();
        // MySqlCommand cmd1 = new MySqlCommand("SELECT count(*)  FROM mysql_db.users where username = '"+user_name+"' and '"+password+"' = "qaz";",connection);
         //MySqlDataReader rdr1 = cmd1.ExecuteReader();///


         using (MySqlCommand cmd1 = new MySqlCommand("SELECT count(*)  FROM mysql_db.users where username = '"+user_name+"' and password = '"+password+"';",connection))
{
    connection.Open();
     i= Convert.ToInt32(cmd1.ExecuteScalar());
}
    if(i==1)//only one user

    {
         MySqlCommand cmd = new MySqlCommand("SELECT * FROM filesystem WHERE owner='"+user_name+"' ORDER BY isFolder DESC", connection); // use PRIORITY with file_id to remove a bug
        MySqlDataReader rdr = cmd.ExecuteReader();
        using (StreamWriter outfile = new StreamWriter(path+"DesktopApp\\currentStatus.txt"))    
        {
            while (rdr.Read())// write the files owned by this user in the "currentStatus.txt"
            {
                outfile.Write(rdr.GetValue(0).ToString()+";"+rdr.GetValue(1)+";"+rdr.GetValue(5)+";"+rdr.GetValue(6).ToString()+"\n");
            }
        }
        using (StreamWriter outfile1 = new StreamWriter(path+"DesktopApp\\status.txt"))    
        {
            outfile1.Write("ReadyToDownload");// signal for desktop application that username and password matched and filelist has been written
        }
    
    }
    else
    {
       using (StreamWriter outfile1 = new StreamWriter(path+"DesktopApp\\status.txt"))    
        {
            outfile1.Write("failed");// if username and password didnt match
        }


      }//else
    }
    catch(Exception eee){
        Response.Write("Error in database operations or reading!");
    }
}

</Script>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        dsfjkl
        sdaklf
        sadf
        <form id="form1" runat="server">
        <div>
            <p> Upload complete.  </p>
        </div>
        </form>
    </body>
</html>
