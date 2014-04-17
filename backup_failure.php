<?php
    function write_log($failure_code)
        if($failure_code==1)
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Unable to connect to backup database.\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
        elseif($failure_code==0)
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Query performed successfuly.\n";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
        elseif($failure_code==2)
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
    
 ?>


