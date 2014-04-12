<?php

    
    if ($_FILES["file"]["error"] > 0)
    {
        echo '<script language="javascript">';
        echo 'alert("Return Code: ".$_FILES["file"]["error"] ")';
        echo '</script>';
    }
    else
    {

        if (file_exists("temp/" . $_FILES["file"]["name"]))
        {
            echo '<script language="javascript">';
            echo 'alert("Try Again")';
            echo '</script>';
        }
        else
        {
            $already_present=0;
            $file_id = 0;
            $file_name = "";
            $owner = "";
            $shared_with = "";
            $file_hash = md5_file ($_FILES["file"]["tmp_name"]);
            $query = "SELECT file_hash FROM filesystem";
            $con=mysqli_connect("localhost","root","pass","mysql_db");
            // Check connection
            if (mysqli_connect_errno())
                {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

            $result = mysqli_query($con,"SELECT file_id, file_hash FROM filesystem");

            while($row = mysqli_fetch_array($result))
                {
                    if($row['file_hash']==$file_hash)
                    {
                        $already_present=1; 
                        break;   
                    };
                   $file_id = $row['file_id'];
                }
            

            $file_id += 1;
            $owner = "abhishek";
            $temp = explode(".", $_FILES["file"]["name"]);
            $ext = end($temp);
            $file_name = $_FILES["file"]["name"] ;
            $file_id_ext = $file_id.".".$ext;
  
            if($already_present==0)
            {

                $query = 'INSERT INTO filesystem (file_id, file_name, owner, file_hash) VALUES '. "('$file_id', '$file_name', '$owner', '$file_hash')";
                $retval = mysqli_query($con, $query);
                if(! $retval )
                {
                  echo 'Could not enter data: ' . mysql_error();
                }
                move_uploaded_file($_FILES["file"]["tmp_name"], "files/" . $file_id_ext);
             
                echo '<script language="javascript">';
                echo 'alert("Uploaded Successfully")';
                echo '</script>';   
            }
            else 
            {
                echo "Already Present";
            }
            #echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
            mysqli_close($con);
        }
    }

?>
