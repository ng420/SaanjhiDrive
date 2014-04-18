<?php
    
    $URL_REF = (string)$_SERVER['HTTP_REFERER'];
    $temp = explode('/', $URL_REF);
    $referring_page = end($temp);

    if($referring_page=="mainpage.php")
    {
        /*$random = rand(0,15);
        $rand_string = md5($rand_string);
        $file_to_download = "temp/".$rand_string.
        if(copy($_GET['url'],$file_to_download))
        {*/
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
        /*}
        else
        {
            header ("Location: "."index.php?unabletocopy")
        }*/
    }
    else 
    {
        header ("Location: "."index.php");
    }
?>
