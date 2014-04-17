<?php

// Grab User submitted information
$name = $_POST["regusrname"];
$pass = $_POST["regusrpwd"];
$email = $_POST["regemail"];


// Connect to the database
$con = mysql_connect("localhost","root","r00tpass");
$con1 = mysqli_connect("172.16.25.62", "root", "r00tpass");
// Make sure we connected succesfully
if(! $con)
{
    die('Connection Failed'.mysql_error());
}

//Code for backup database
$backup_connection_established = 0;
if(! $con1)
{
    $backup_connection_established = 1;
}
else 
{
    include 'backup_failure.php?failure_code=1';
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
 if($data) 
 {
    echo "You have been registered successfully."; 
    if($backup_connection_established)
    {
        $result = mysqli_query($con1, $query);
        if(!$result) include 'backup_failure.php?failure_code=2';
    }    
 }
 }
?>