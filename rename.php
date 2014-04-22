<?php

    $newName =  $_POST['input'];
    $oldName = $_POST['filename'];
    $currDir = $_POST['current_dir'];
    $shared = $_POST['shared'];
    $user = $_SESSION['user'];
    
    if($shared="--"){
        $query = "UPDATE filesystem SET file_name = '$newName' WHERE owner='$user' AND directory_path = '$currDir' AND file_name = '$oldName' AND shared_by is NULL";
    }
    else {
        $query = "UPDATE filesystem SET file_name = '$newName' WHERE owner='$user' AND directory_path = '$currDir' AND file_name = '$oldName' AND shared_by='$shared'";
    }
    echo $query;
    session_start();
    $user = $_SESSION['user'];
    $query = "UPDATE filesystem SET file_name = '$newName' WHERE owner='$user' AND directory_path = '$currDir' AND file_name = '$oldName'";
    //echo $query;
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    if (mysqli_connect_errno())
    {
        ;//echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    if($result = mysqli_query($con, $query)){
        $query = "SELECT * FROM filesystem  WHERE owner='$user' AND directory_path = '$currDir' AND file_name = '$newName'  ";
        
        if($result = mysqli_query($con, $query)){
            while($row = mysqli_fetch_array($result)){ 
                echo $row['file_id'];
            }
        }
        include 'backup_failure.php';
        write_log($query);
    
    }
    else {
        ;//echo 'Fail';
    }
 
?>
