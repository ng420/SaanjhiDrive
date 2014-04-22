<?php
    
    //Start session to access session variables.
    session_start();

    //Set variables for performing query.
    $owner = $_SESSION['user'];
    $user_to_share_with = $_POST['user_to_share_with'];
    $directory_path_initial = $_POST['dir_path'];
    $file_name = $_POST['file_name'];

    if($owner==$user_to_share_with)
    {
        echo "You can't share file with yourselves.";
        die();
    }

    //Establish connection.
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    
    if (mysqli_connect_errno())
    {
        //Unable to establish connection.
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    else 
    {

        $query = "SELECT username FROM users";
        $result = mysqli_query($con, $query);
        
        //Check access to users table.
        if($result)
        {
            $user_present = 0;
            while($row=mysqli_fetch_array($result))
            {
                //Check if user name entered is valid or not.
                if($row['username']==$user_to_share_with)
                {
                    $user_present = 1;
                    break;
                }
                else
                {
                    $user_present = 0 ;
                }
                    
            }

            if($user_present)
            {
                //echo "User present in database.";

                //Process share call.
                $get_file_query = mysqli_query($con, "SELECT * FROM filesystem WHERE file_name = '$file_name' AND owner = '$owner'  AND directory_path = '$directory_path_initial'");
                
                //Check if query was successful.
                if($get_file_query)
                {
                    $row = mysqli_fetch_array($get_file_query);
                    $n_file_id = $row['file_id'];
                    $n_file_hash = $row['file_hash'];

                    //Insert into desired user database.
                    $share_query = 'INSERT INTO filesystem (file_id, file_name, owner, file_hash, directory_path, isFolder, shared_by)  VALUES '. "('$n_file_id', '$file_name', '$user_to_share_with', '$n_file_hash', '!', '0', '$owner')";
                
                    $perform_share = mysqli_query ($con, $share_query);

                    //Check if query was successful.
                    if($perform_share)
                    {
                        echo "Shared successfully.";
                        include 'backup_failure.php';
                        write_log($share_query);
                    }
                    else
                    {
                        echo "Unable to share. Try again.";    
                    }
                }
                else
                {
                    echo "Unable to perform query.";
                }
                //
            }
            else
            {
                echo "No such user present.";
            }
        }
        else
        {
            echo "Unable to access user records.";
        }
        mysqli_close($con);
    } 

?>

