<?php
    session_start();

    if (!empty($_FILES))
    {
        if ($_FILES["file"]["error"] > 0)
        {
           
            echo 'Return Code: ".$_FILES["file"]["error"] "';
        }
        else
        {

            $already_present=0;
            $file_id = 0;
            $file_name = "";
            $owner = $_SESSION['user'];
            $shared_with = "";
            $file_hash = md5_file ($_FILES["file"]["tmp_name"]);
            $query = "SELECT file_hash FROM filesystem";
            $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
            // Check connection
            if (mysqli_connect_errno())
                {
                
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

            $result = mysqli_query($con,"SELECT file_id, file_hash, owner FROM filesystem ORDER BY file_id");

            if($result)
            {
                while($row = mysqli_fetch_array($result))
                    {
                        //echo $row['owner'];
                        if($row['file_hash']==$file_hash)
                        {
                            //echo $row['file_hash']."  ".$row['file_id']."   ".$row['owner'];
                            if($row['owner']==$owner)
                            {
                                //echo $row['owner'];
                                $already_present = 2;
                                
                            }
                            else 
                            {
                                //echo $row['owner'];
                                $already_present=1;
                                $file_id = $row['file_id']; 
                            }
                            break;   
                        };
                        $file_id = $row['file_id'];
                    }
                //echo $already_present;
                if($already_present==0)
                {
                    $file_id += 1;
                }

                $temp = explode(".", $_FILES["file"]["name"]);
                $ext = end($temp);
                $file_name = $_FILES["file"]["name"] ;
                $file_id_ext = $file_id.".".$ext;
  
                if($already_present==0 )
                {
                    $directory_to_upload = $_POST['directory_path'];
                    $query = 'INSERT INTO filesystem (file_id, file_name, owner, file_hash, directory_path, isFolder) VALUES '. "('$file_id', '$file_name', '$owner', '$file_hash', '$directory_to_upload', '0')";
                    $retval = mysqli_query($con, $query);
                    if(! $retval )
                    {
                        echo mysqli_connect_error();
                        die();
                    }
                    move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $file_id_ext);
             
                    echo 'Uploaded Successfully';
                }
                elseif($already_present==1)
                {
                    $directory_to_upload = $_POST['directory_path'];
                    $result_new = mysqli_query($con,"SELECT * FROM filesystem WHERE file_hash='$file_hash' ORDER BY owner");
                    if($result_new)
                    {
                      
                        echo $row1['file_id']."   ".$row1['owner']."   ".$row1['directory_path'];
                        while($row1=mysqli_fetch_array($result_new))
                        {
                            if($row1['owner']==$owner && $row1['directory_path']==$directory_to_upload)
                            {
                                echo "File already present.";
                                die();
                            }
                        }
                    }
   
                    $query = 'INSERT INTO filesystem (file_id, file_name, owner, file_hash, directory_path, isFolder) VALUES '. "('$file_id', '$file_name', '$owner', '$file_hash', '$directory_to_upload', '0')";
                    $retval = mysqli_query($con, $query);
                    if(! $retval )
                    {
                        echo "Some error occured with file uploading. Try again.";
                        echo mysqli_connect_error();
                        die();
                    }
                    echo 'Uploaded Successfuly.';
                    
                }
                elseif($already_present==2)
                {
                    echo 'File already present.';
                }
                else
                {
                    echo 'Unknown error occured.';
                 }
                #echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
                mysqli_close($con);
            }
            else
            {
                echo 'Unable to establish connection with database.';
            }
        }
    }
?>
