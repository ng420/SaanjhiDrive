<?php
    
    $URL_REF = (string)$_SERVER['HTTP_REFERER'];
    $temp = explode('/', $URL_REF);
    $referring_page = end($temp);

    if($referring_page=="mainpage.php")
    {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$_GET['file_name'].'"');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($_GET['url']));
        ob_clean();
        flush();
        readfile($_GET['url']); 
    }
    else 
    {
        header ("Location: "."index.php");
    }
?>
