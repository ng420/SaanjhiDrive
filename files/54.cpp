String^ constring=L"datasource=localhost;port=3307;username=root;password=root";
MySqlConnection^ conDataBase=gcnew MySqlConnection(constring);
MySqlCommand^ cmdDataBase=gcnew MySqlCommand("select * from chikitsalaya.login_users;",conDataBase);
MySqlDataReader^ myReader;

try{
  conDataBase->Open();
  myReader=cmdDataBase->ExecuteReader();

}catch(Exception^ex){
  MessageBox::Show(ex->Message);
}



//#include "stdAfx.h"
//#include "Form2.h"
//connection code
string^ constring=L"datasource=localhost;port:80;username=root;password='';";
MySqlConnection^ conDatabase=gcnew MySqlConnection(constring);
MySqlCommand^ cmd=gcnew MySqlCommand("select * from eventor.user",conDatabase);
MySqlDataReader^ myreader;
try
{
conDatabase->Open();
myreader=cmd->ExecuteReader();
}
 catch(Exception^ ex)
{
 MessageBox::Show(ex->Message);
 

 NOTES:

 #include "mysql_connection.h"
 create obj mysql_con_obj;