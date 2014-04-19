

<?php

$text = $_POST['text'] ;
$filename = $_POST['filename'];
$file_handle = fopen($filename, 'w');
fwrite($file_handle, $text);
fclose($file_handle);
//session_destroy();

?>