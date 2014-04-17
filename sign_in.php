<?php

// Grab User submitted information
$name = $_POST["usrname"];
$pass = $_POST["usrpwd"];
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
if($row["username"]==$name && $row["password"]==$pass)
    {
        session_start();
        $_SESSION['user']=$name;
        if(isset($_POST["rmbrme"]))
        setcookie("user", $name, time()+7600, "/");
        header("Location: mainpage.php");
    }
else
    $response = 3;
    header("Location: "."index.php?response=3");
?>