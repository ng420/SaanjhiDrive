<?php
    
    //Start session to access session variables.
    session_start();

    //Check if input is received.
    if(isset($_POST) && !empty($_POST['folder_name']))
    {
        //Set variables for updating database.
        $owner = $_SESSION['user'];
        $file_id = "";
        $_POST['folder_name'] = str_replace(" ", "_", $_POST['folder_name']);
        $file_name = "dwalin".$_POST['folder_name'];
        $is_folder = 1;
        $directory_path = $_POST['directory_path'];
        $already_present = 0;

        //Establish connection to MySQL database.
        $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
            // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $result = mysqli_query($con,"SELECT file_id, file_hash, owner FROM filesystem ORDER BY file_id"); //Query to perform.

        /*if($result)
        {
            while($row = mysqli_fetch_array($result))
            {
                if($row['owner']==$owner && $row['directory_path']==$directory_path)
                {
                    $already_present = 1;
                    break;
                }    
                $file_id = $row['file_id'];
            }
            if($already_present==1)
            {
                echo "Folder already present.";
                die();
            }
            else
            {
                $file_id += 1;
                $insert_query = 'INSERT INTO filesystem (file_id, file_name, owner, directory_path, isFolder) VALUES '. "('$file_id', '$file_name', '$owner', '$directory_path', '1')";
                $insert_result = mysqli_query($con, $insert_query);
                if($insert_result)
                {
                    echo "Folder created successfully.";
                }
                else
                {
                    echo "Unable to insert.";    
                }
            }
        }
        else 
        {
            echo "Unable to connect to database."
        }*/

        //Traverse through result.
        while($row = mysqli_fetch_array($result))
        {
            //Check if same user has same file at same directory path.
            if($row['owner']==$owner && $row['directory_path']==$directory_path)
            {
                $already_present = 1;
                break;
            }    
            $file_id = $row['file_id'];
        }

        //If user has same folder at same directory path.
        if($already_present==1)
        {
            echo "Folder already present.";
            die();
        }
        
        //Create Folder
        else
        {
            $file_id += 1; //Increment file_id.

            //Perform Query.
            $insert_query = 'INSERT INTO filesystem (file_id, file_name, owner, directory_path, isFolder) VALUES '. "('$file_id', '$file_name', '$owner', '$directory_path', '1')";
            $insert_result = mysqli_query($con, $insert_query);

            //If query is performed successfully.
            if($insert_result)
            {
                echo "Folder created successfully.";
                mysqli_close($con);
                $con1 = mysqli_connect("172.16.25.62", "root", "r00tpass", "mysql_db_backup");
    
                if($con1)
                {
                    //echo "Connection established.\n";
                    $backup_result = mysqli_query($con1, $insert_query);
                    if(!$backup_result)
                    {
                        $log_file_name = "log.txt";
                        $file_handle = fopen($log_file_name, 'a') or die();
                        $string_data = "Unable to perform query.\n$insert_query\n";
                        fwrite($file_handle, $string_data);
                        fclose($file_handle);  
                        echo "Unable to perform query.";
                    } 
                    else 
                    {
                        $log_file_name = "log.txt";
                        $file_handle = fopen($log_file_name, 'a') or die();
                        $string_data = "Query performed successfuly.\n$insert_query\n";
                        fwrite($file_handle, $string_data);
                        fclose($file_handle);
                        echo "Query performed successfully.";
                    }
                }  
                else 
                {
                    $log_file_name = "log.txt";
                    $file_handle = fopen($log_file_name, 'a') or 
                    $string_data = "Unable to connect to backup database.\n$insert_query\n";
                    fwrite($file_handle, $string_data);
                    fclose($file_handle); 
                    echo "Unable to connect to backup database.";
                }
                mysqli_close($con1);
            }
            else
            {
                echo "Unable to insert.";    
            }

        }
        
    }
    else 
    {
        echo "Unable to process request.";
    }
?>