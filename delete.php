<?php

function deleteIfExists($file)
{
    $file = str_replace("/","\\",$file);
    $query = 'DEL '.$file;
    echo $query;
$result = exec($query);

}
$source = $_POST['source'];
$ext = $_POST['extension'];
deleteIfExists($source . '.swf');
if(!($ext == "pdf"))
deleteIfExists($source . '.pdf');
?>

