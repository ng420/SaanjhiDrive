<?php
    function write_log($query) {
        /*$con1 = mysqli_connect("172.16.25.62", "root", "r00tpass", "mysql_db_backup");        //Establishes connection with backup server
    
        if($con1)   //Check whether connection is established or not
        {
            //echo "Connection established.\n";
            $backup_result = mysqli_query($con1, $query);
            if(!$backup_result)     //Write failure into log.txt if unable to perform query.
            {
                $log_file_name = "log.txt";
                $file_handle = fopen($log_file_name, 'a') or die();
                $string_data = "Unable to perform query.\n$query\n";
                fwrite($file_handle, $string_data);
                fclose($file_handle);  
            } 
            else //Write status of query performed.
            {
                $log_file_name = "log.txt";
                $file_handle = fopen($log_file_name, 'a') or die();
                $string_data = "Query performed successfuly.\n$query\n";
                fwrite($file_handle, $string_data);
                fclose($file_handle);
            }
        }  
        else 
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or 
            $string_data = "Unable to connect to backup database.\n$query\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle); 
        }
        mysqli_close($con1);*/
    }
?>


