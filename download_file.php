<?php
    
    //Start session to access session variables.
    session_start();
    
    //Set variables for performing query.
    $owner = $_SESSION['user'];
    $directory_path_initial = $_POST['dir_path'];
    $file_name = $_POST['file_name'];


    //Establish connection.
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    
    if (mysqli_connect_errno())
    {
        //Unable to establish connection.
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    else 
    {
        $get_file_query = mysqli_query($con, "SELECT file_id, file_name FROM filesystem WHERE file_name = '$file_name' AND owner = '$owner' AND directory_path = '$directory_path_initial' AND isFolder = '0'");
                
        //Check if query was successful.
        if($get_file_query)
        {
 
            $row = mysqli_fetch_array($get_file_query);
            $n_file_id = $row['file_id'];
            $temp = explode(".", $row['file_name']);
            $ext = end($temp);
            $n_file_id = "files/".$n_file_id.".".$ext;
          
            if (file_exists($n_file_id)) {
              echo $n_file_id; 
              /*$rand_string = md5($n_file_id);
              $file_to_download = "temp/".$rand_string.
              if(copy($_GET['url'],$file_to_download))
              {
                  echo $file_to_download;  
              }
              else
              {
                  echo $n_file_id;
              }
              //echo "Unable to copy.";*/
            }
            else 
            {
                echo "File not present.";
            }
        }
        else
        {
            echo "Unable to process request. Try again.";
        }
        //Insert into desired user database.
        
        mysqli_close($con);
    } 

?>

