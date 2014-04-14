<%@ Page Language="C#" %>


<%@ Import Namespace="System"%>
<%@ Import Namespace="System.IO"%>
<%@ Import Namespace="System.Net"%>
<%@ Import NameSpace="System.Web"%>


<Script  runat=server>
void Page_Load(object sender, EventArgs e) {

    foreach(string f in Request.Files.AllKeys) {
        HttpPostedFile file = Request.Files[f];
       // file.SaveAs(Server.MapPath("~/Uploads/" + file.FileName));
       file.SaveAs("C:\\Users\\Abhishek Sen\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + file.FileName);      
    }   

    string status;
    string inputString;
    using (StreamReader streamReader = File.OpenText("C:\\Users\\Abhishek Sen\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\status.txt"))
        inputString = streamReader.ReadLine();
    string[] words = inputString.Split(':');
	status = words[0];
    string username = words[1];
    string password = words[2];
    // check if username and password matches........
    //<%@ Import NameSpace="MySql.Data.MySqlClient"%>
    /*try{
        MySqlConnection connection = new MySqlConnection("localhost","root","r00tpass","mysql_db");
        connection.Open();
        MySqlCommand cmd = new MySqlCommand("SELECT * FROM filesystem WHERE owner='"+username+"' ORDER BY isFolder DESC", connection); // use PRIORITY with file_id to remove a bug
        MySqlDataReader rdr = cmd.ExecuteReader();
        using (StreamWriter outfile = new StreamWriter("C:\\Users\\Abhishek Sen\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\currentStatus.txt"))    
        {
            while (rdr.Read())
            {
                outfile.Write(rdr.GetValue(0).ToString()+";"+rdr.GetValue(1)+";"+rdr.GetValue(5)+";"+rdr.GetValue(6).ToString());
            }
        }
        using (StreamWriter outfile1 = new StreamWriter("C:\\Users\\Abhishek Sen\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\status.txt"))    
        {
            outfile1.Write("ReadyToDownload");
        }
    }
    catch(Exception e){
        echo "Error";
    }*/
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
