<?php

    //$newName =  $_POST['input'];
    $name = $_POST['filename'];
    $currDir = $_POST['current_dir'];
    session_start();
    $user = $_SESSION['user'];
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
 
    $query = "SELECT * FROM filesystem WHERE file_name = '$name' AND directory_path = '$currDir' ";
    //echo $query;
    $temp = explode(".", $name);
    $ext = end($temp);
    if($result = mysqli_query($con, $query)){
        //echo 'lol';
        $count = 0;
        while($row = mysqli_fetch_array($result)){
            $count = $count + 1;
            $id = $row['file_id'];
        }
        if($count == 1){
            $query = 'DEL files\\'.$id.'.'.$ext;
            echo $query;
            $result = exec($query);
            echo $result;
        }
        $query = "DELETE FROM filesystem  WHERE file_id = '$id' AND owner='$user' AND directory_path = '$currDir' LIMIT 1";
        //echo $query;
        if($result = mysqli_query($con, $query)){
            echo "Success";
            include 'backup_failure.php';
            write_log($query);
        }
        else {
            echo 'Fail';
        }
    }
    else {
        echo 'Fail';
    }

 
?>
