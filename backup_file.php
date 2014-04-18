<?php
    if(file_exists("temp/log.txt"))
    {
        echo "ASDFADS";
    }
    else
    {
        copy("log.txt", "temp/log.txt");    
    }
    
?>

