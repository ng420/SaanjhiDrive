<?php
    if(isset($_GET) && !(empty($_GET['failure_code'])))
    {
        if($_GET['failure_code']==1)
        {
            $log_file_name = "log.txt";
            $file_handle = fopen($log_file_name, 'a') or die();
            $string_data = "Unable to connect to backup database.";
            fwrite($file_handle, $string_data);
            fclose($file_handle);
        }
    }
    else die();
?>


