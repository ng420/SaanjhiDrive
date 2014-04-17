<?php
    session_start();
    $path = $_POST['finalPath'];
    $user = $_SESSION['user'];
    $filename = $_POST['filename'];
    //$filename = "dwalin".$filename;
    $initPath = $_POST['initialPath'];
    //$initPath = substr_replace(" / ","!",$initPath);
    //if($initPath == "Home"){
      //  $initPath ="!";
   // }
    //else{
      //  $initPath = substr(4,$initPath);
    //}
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    
    if (mysqli_connect_errno())
    {
        //Unable to establish connection.
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    else 
    {

        $query = "UPDATE filesystem SET directory_path = '$path' WHERE owner='$user' AND file_name='$filename' AND directory_path ='$initPath' ";
        //echo $query;
        if($result = mysqli_query($con, $query))
        {
            echo 'File Moved Successfully.';
            include 'backup_failure.php';
            write_log($query);
        }
    }
?>
