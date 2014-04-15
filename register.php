<?php

// Grab User submitted information
$name = $_POST["regusrname"];
$pass = $_POST["regusrpwd"];
$email = $_POST["regemail"];


// Connect to the database
$con = mysql_connect("localhost","root","r00tpass");
// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

// Select the database to use
mysql_select_db("mysql_db",$con);
 $query = "SELECT username FROM users WHERE username = \"$name\"";
 $data = mysql_query ($query)or die(mysql_error());
 echo mysql_num_rows($data)."<br>";
 echo $name."<br>";
 if(mysql_num_rows($data)>0) echo "Given username is already in use.";
 else{
 $query = "INSERT INTO users (username, password,email) VALUES ('$name','$pass','$email')";
 $data = mysql_query ($query)or die(mysql_error());
 if($data) echo "You have been registered successfully."; 
 }
?>