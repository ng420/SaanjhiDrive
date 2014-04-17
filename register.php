<?php

//Set response
$response = "";
$user = "";
// Grab User submitted information
$name = $_POST["regusrname"];
$pass = $_POST["regusrpwd"];
$email = $_POST["regemail"];


// Connect to the database
$con = mysqli_connect("localhost","root","r00tpass", "mysql_db");

// Make sure we connected succesfully
if(! $con)
{
    $response = 'Connection Failed'.mysql_error();
}


// Select the database to use
 $query = "SELECT username FROM users WHERE username = \"$name\"";
 $data = mysqli_query ($con, $query) or die(mysqli_connect_error());
 //echo mysqli_num_rows($data)."<br>";
 //echo $name."<br>";
 if(mysqli_num_rows($data)>0) $response = "1";
 else{
 $query = "INSERT INTO users (username, password,email) VALUES ('$name','$pass','$email')";

 $data = mysqli_query ($con, $query)or die(mysqli_connect_error());
 if($data) 
 {
    //echo "You have been registered successfully.";
    $user = $name; 
    mysqli_close($con);

    $con1 = mysqli_connect("172.16.25.62", "root", "r00tpass", "mysql_db_backup");
    include 'backup_file.php';
    write_log($query); 
    $response = "0";
 }
 else 
 {
     $response = "2";
 }
 }
    if($response)  header("Location: "."index.php?response=".$response);
    else {
        session_start();
        $_SESSION['user'] = $name;
        header("Location: "."mainpage.php");
    }
?>