<?php

    $newName =  $_POST['input'];
    $oldName = $_POST['filename'];
    $currDir = $_POST['current_dir'];
    session_start();
    $user = $_SESSION['user'];
    $query = "UPDATE filesystem SET file_name = '$newName' WHERE owner='$user' AND directory_path = '$currDir' AND file_name = '$oldName'";
    //echo $query;
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    if($result = mysqli_query($con, $query)){
        echo "Success";
    }
    else {
        echo 'Fail';
    }
 
?>