<?php
    
    session_start(); //Session started for accessing session variables.

    if (!empty($_FILES))  // Check if input was provided.
    { $count=count($_FILES['file']['name']);
         for($i=0; $i<$count; $i++)
      {echo $_FILES["file"]["name"][$i].": ";
        if ($_FILES["file"]["error"][$i] > 0)
        {
           
            echo 'Return Code: '.$_FILES["file"]["error"][$i] ;
        }
        else
        {
            //Define variables to access tables.
            if($_FILES["file"]["size"][$i]/(1024*1024)>10){
                echo 'File size exceeds 10 MB';
            }
            else{
            
            $already_present=0;
            $file_id = 0;
            $file_name = "";
            $owner = $_SESSION['user'];
            $shared_with = "";
            $file_hash = md5_file ($_FILES["file"]["tmp_name"][$i]); //File hashed
            
            //Establish connection.
            $query = "SELECT file_hash FROM filesystem";
            $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
            // Check connection
            
            if (mysqli_connect_errno())
                {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error(); //Terminate if connectin not established.
                }

            $result = mysqli_query($con,"SELECT file_id, file_hash, owner FROM filesystem WHERE isFolder <> '2' ORDER BY file_id"); // Perform query.

            if($result)
            {
                //Traverse through each row.
                while($row = mysqli_fetch_array($result))
                    {
                        //Check if same file exists or not.
                        if($row['file_hash']==$file_hash)
                        {
                            //Check if same user has it or not.
                            if($row['owner']==$owner)
                            {
                                
                                $already_present = 2;
                                
                            }
                            else 
                            {
                                
                                $already_present=1;
                                $file_id = $row['file_id']; 
                            }
                            break;   
                        };
                        
                        $file_id = $row['file_id']; //Set file_id
                    }

                
                if($already_present==0)
                {
                    $file_id += 1;
                }

                //Perform manipulation on file name to store.
                $temp = explode(".", $_FILES["file"]["name"][$i]);
                $ext = end($temp);
                $file_name = $_FILES["file"]["name"][$i] ;
                $file_id_ext = $file_id.".".$ext;
  
                //File is new.
                if($already_present==0 )
                {
                    $directory_to_upload = $_POST['directory_path'];
                    
                    $result_new = mysqli_query($con,"SELECT * FROM filesystem WHERE owner = '$owner' AND directory_path = '$directory_to_upload' ORDER BY file_name");
                    if($result_new)
                    {
                      
                        
                        while($row1=mysqli_fetch_array($result_new))
                        {
                            //Check if file of same name is present at same directory.
                            if($row1['file_name']==$file_name && $row1['directory_path']==$directory_to_upload)
                            {
                                echo "File of same name already present.";
                                die();
                            }
                        }

                    }

                    //Insert entry.
                    $query = 'INSERT INTO filesystem (file_id, file_name, owner, file_hash, directory_path, isFolder) VALUES '. "('$file_id', '$file_name', '$owner', '$file_hash', '$directory_to_upload', '0')";
                    $retval = mysqli_query($con, $query);
                    if(! $retval )
                    {
                        echo mysqli_connect_error();
                        die();
                    }

                    //Move file
                    move_uploaded_file($_FILES["file"]["tmp_name"][$i], "files/" . $file_id_ext);
                    echo 'Uploaded Successfully';
                    //include 'backup_file.php';
                    //write_log($query);
                }

                
                elseif($already_present==1)
                {
                    $directory_to_upload = $_POST['directory_path'];
                    $result_new = mysqli_query($con,"SELECT * FROM filesystem WHERE file_hash='$file_hash' ORDER BY owner");
                    if($result_new)
                    {
                      
                        //Check if same user has same file at same directory path.
                        while($row1=mysqli_fetch_array($result_new))
                        {
                            if($row1['owner']==$owner && $row1['directory_path']==$directory_to_upload)
                            {
                                echo "File already present.";
                                die();
                            }
                        }
                    }
   
                    //Insert file entry into database.
                    $query = 'INSERT INTO filesystem (file_id, file_name, owner, file_hash, directory_path, isFolder) VALUES '. "('$file_id', '$file_name', '$owner', '$file_hash', '$directory_to_upload', '0')";
                    $retval = mysqli_query($con, $query);
                    if(! $retval )
                    {
                        echo "Some error occured with file uploading. Try again.";
                        echo mysqli_connect_error();
                        die();
                    }
                    echo 'Uploaded Successfuly.';
                    mysqli_close($con);
                    //include 'backup_failure.php';
                    //write_log($query);
                    
                }

                //If same user has same file.
                elseif($already_present==2)
                {
                    echo 'File already present.';
                }
                else
                {
                    echo 'Unknown error occured.';
                 }
                
                
            }

            //Unable to establish connection.
            else
            {
                echo 'Unable to establish connection with database.';
            }
            
        }
        }
        echo '<br>';
    }
    }
?>
