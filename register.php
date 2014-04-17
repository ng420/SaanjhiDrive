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
    
    if($con1)
    {
        //echo "Connection established.\n";
        $result = mysqli_query($con1, $query);
        if(!$result)
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Unable to perform query.\n".$query."\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);  
        } 
        else 
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Query performed successfuly.\n".$query."\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
    }  
    else 
    {
        $log_file_name = "log.txt";
        $file_handle = fopen($log_file_name, 'a') or 
        $string_data = "Unable to connect to backup database.\n$query\n";
        fwrite($file_handle, $string_data);
        fclose($file_handle); 
    }
    mysqli_close($con1); 
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