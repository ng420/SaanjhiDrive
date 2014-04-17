<%@ Page Language="C#" %>


<%@ Import Namespace="System"%>
<%@ Import Namespace="System.IO"%>
<%@ Import Namespace="System.Net"%>
<%@ Import NameSpace="System.Web"%>
<%@ Import Namespace = "System.Data" %>
<%@ Import Namespace = "MySql.Data.MySqlClient" %>

<Script  runat=server>
void Page_Load(object sender, EventArgs e) {

    foreach(string f in Request.Files.AllKeys) {
        HttpPostedFile file = Request.Files[f];
       file.SaveAs("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + file.FileName);      
    }   // save status files..
    
    string status;
    string inputString;
    using (StreamReader streamReader = File.OpenText("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\status.txt"))
        inputString = streamReader.ReadLine();
    string[] words = inputString.Split(';');
	status = words[0];
    string user_name = words[1];
    string password = words[2];
    using (StreamWriter outfile1 = new StreamWriter("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\currentUsersUsername.txt"))    
        {
            outfile1.Write(user_name);
        }
    Session["username"] = user_name; 

    // Check Username and password.....

    try{
        MySqlConnection connection = new MySqlConnection("Server=localhost;Database=mysql_db;Uid=root;Pwd=r00tpass;");
        connection.Open();
        MySqlCommand cmd = new MySqlCommand("SELECT * FROM filesystem WHERE owner='"+user_name+"' ORDER BY isFolder DESC", connection); // use PRIORITY with file_id to remove a bug
        MySqlDataReader rdr = cmd.ExecuteReader();
        using (StreamWriter outfile = new StreamWriter("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\currentStatus.txt"))    
        {
            while (rdr.Read())
            {
                outfile.Write(rdr.GetValue(0).ToString()+";"+rdr.GetValue(1)+";"+rdr.GetValue(5)+";"+rdr.GetValue(6).ToString()+"\n");
            }
        }
        using (StreamWriter outfile1 = new StreamWriter("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\status.txt"))    
        {
            outfile1.Write("ReadyToDownload");
        }
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
