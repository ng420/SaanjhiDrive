<%@ Page Language="C#" %>
<%@ Import Namespace="System"%>
<%@ Import Namespace="System.IO"%>
<%@ Import Namespace="System.Net"%>
<%@ Import NameSpace="System.Web"%>

<Script  runat=server>
void Page_Load(object sender, EventArgs e) {

    //UPLOAD TEXTFILE FROM CLIENT CONTAINING NAME OF NEW FOLDERS TO BE CREATED

    foreach(string f in Request.Files.AllKeys) {
        HttpPostedFile file = Request.Files[f];  //always a text file
       file.SaveAs("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\" + file.FileName);

        //sql Query for inserting for new folders to database
      
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
        <form id="form1" runat="server">
        <div>
            AMen!
        </div>
        </form>
    </body>
</html>
