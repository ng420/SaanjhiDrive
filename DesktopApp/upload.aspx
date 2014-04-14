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
       file.SaveAs("C:\\Users\\Abhishek Sen\\Documents\\GitHub\\SaanjhiDrive\\upload\\" + file.FileName);
      
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
