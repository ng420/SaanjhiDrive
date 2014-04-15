<%@ Page Language="C#" autoeventwireup="False" Debug="true" %> 
<%@ import Namespace="System.Data" %> 
<%@ import Namespace="MySql.Data.MySqlClient" %> 
<script runat="server"> 

protected void Page_load(Object Source, EventArgs E) 
{ 
MySql.Data.MySqlClient.MySqlConnection conn; 
// string myConnectionString; 

string myConnectionString = "server=localhost;uid=root;" + 
"pwd=r00tpass;database=mysql_db;"; 

try 
{ 
conn = new MySql.Data.MySqlClient.MySqlConnection(myConnectionString); 
conn.Open(); 
} 
catch (MySql.Data.MySqlClient.MySqlException ex) 
{ 
switch (ex.Number) 
{ 
case 0: 
//MessageBox.text = "Cannot connect to server. Contact Administrator: Ray"); 
case 1045: 
//MessageBox.text = "Invalid username/password, please try again"); 
} 
} 

} 

</script> 
<html> 
<head> 
<title>Getting Connection to Database</title> <style>BODY { 
FONT: 100% Verdana 
} 
</style> 
</head> 
<body> 
<p align="center"> 
All records in the 'Room'table: 
</p> 
<p align="left"> 
</p> 
<asp:DataGrid id="dgrAllNames" Runat="server" CellPadding="3" HorizontalAlign="Center"></asp:DataGrid> 
<p align="left"> 
<asp:Label id="MessageBox" runat="server" text="Connection"></asp:Label> 
</p> 
</body> 
</html> 