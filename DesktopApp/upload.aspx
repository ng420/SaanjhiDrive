﻿<%@ Page Language="C#" %>
<%@ Import Namespace="System"%>
<%@ Import Namespace="System.IO"%>
<%@ Import Namespace="System.Net"%>
<%@ Import NameSpace="System.Web"%>
<%@ Import Namespace = "System.Data" %>
<%@ Import Namespace = "MySql.Data.MySqlClient" %>
<%@ Import Namespace = "System.Security.Cryptography" %>

<Script  runat=server>
void Page_Load(object sender, EventArgs e) {
    //string user_name = Session["username"]; //                                    Change this later !!
    //string user_name = "abhishek";
    string user_name;
    using (StreamReader streamReader = File.OpenText("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\currentUsersUsername.txt"))
        user_name = streamReader.ReadLine();

    foreach(string f in Request.Files.AllKeys) {
        HttpPostedFile file = Request.Files[f];
       file.SaveAs("C:\\Users\\Abhijeet Singh\\Documents\\GitHub\\SaanjhiDrive\\DesktopApp\\TestingDesktopApp\\" + user_name + file.FileName); 
       } // Saving files....
      
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
            <p> hey it is test phase !!  </p>
        </div>
        </form>
    </body>
</html>
