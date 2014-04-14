<%@ Page Language="C#" %>
<%@ Import Namespace="System"%>
<%@ Import Namespace="System.IO"%>
<%@ Import Namespace="System.Net"%>
<%@ Import NameSpace="System.Web"%>

<Script  runat=server>
void Page_Load(object sender, EventArgs e) {

   var dataFile = Server.MapPath("/filesToDeleteFromServer.txt");
   Array userData = File.ReadAllLines(dataFile);
   foreach (string fileName in userData) 
    {
        // Extract filename from this and add users directory etc to it wrt the server directory system...........
        if ((System.IO.File.Exists(fileName)))
        System.IO.File.Delete(fileName);
    }
}
    // We have not checked if it works or not....... :P
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
            
        </div>
        </form>
    </body>
</html>
