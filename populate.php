<?php
        
    session_start();
    $user = $_SESSION['user'];
    $query = "SELECT * FROM filesystem WHERE owner='$user'";
    $con=mysqli_connect("localhost","root","uM6bTL55","mysql_db");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($con, $query);
    if(!$result)
    {
        echo "Unable to access database.<br>";
    }
    while($row = mysqli_fetch_array($result))
    {
        $temp = explode(".", $row['file_name']);
        $ext = end($temp);
        echo "<a href='files/'".$row['file_id'].$ext.">".$row['file_name']."</a><br>";
    }

?>