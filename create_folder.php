<?php
    session_start();
    if(isset($_POST) && !empty($_POST['folder_name']))
    {
        $owner = $_SESSION['user'];
        $file_id = "";
        $_POST['folder_name'] = str_replace(" ", "_", $_POST['folder_name']);
        $file_name = "dwalin".$_POST['folder_name'];
        $is_folder = 1;
        $directory_path = $_POST['directory_path'];
        $already_present = 0;
        $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
            // Check connection
        if (mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
            die();
        }

        $result = mysqli_query($con,"SELECT file_id, file_hash, owner FROM filesystem ORDER BY file_id");

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
        mysqli_close($con);
    }
    else 
    {
        echo "Unable to process request.";
    }
?>