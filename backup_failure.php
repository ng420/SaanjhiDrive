<?php
    if(isset($_GET) && !(empty($_GET['failure_code'])))
    {
        if($_GET['failure_code']==1)
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Unable to connect to backup database.\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
        elseif($_GET['failure_code']==0)
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Connected with backup database.\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
        elseif($_GET['failure_code']==1)
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Unable to perform query.\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
        else
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Unable error occured.\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
    }
    else die();
?>


