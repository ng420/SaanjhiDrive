<?php
session_start();
        if(!(isset($_SESSION)) || (empty($_SESSION['user'])))
        {
            header('Location: '. "index.php" );
        }
// Grab User submitted information
$name = $_POST["usrname"];
$oldpass = $_POST["oldpwd"];
$newpass = $_POST["newpwd"];
// Connect to the database
$con = mysql_connect("localhost","root","r00tpass");
// Make sure we connected successfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysql_select_db("mysql_db",$con);
$query = "SELECT username, password FROM users WHERE username = \"$name\"";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if($row["password"]==$oldpass)
    {
        session_start();
        $query = "UPDATE users SET password=\"$newpass\" WHERE username = \"$name\"";
        $result = mysql_query($query);
    }
else
    echo 'Password Doesn\'t match';
    
?>