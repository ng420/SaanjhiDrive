<?php


    $source = $_POST['source'];
    $name = explode(".",$source);
    $dest =  $name['0'] ;
    $ext = $name['1'];
    echo $source;
    
    if(!($ext == "pdf" || $ext == "pptx")){
        //$query = '"D:\Program Files <x86>\LibreOffice' . $space .'4\program\python" cgi-bin\\DocumentConverter.py '.$source.' files/lol.swf';
        //echo '"" cgi-bin\DocumentConverter.py files\12.pdf files\12.swf';
        $query = '"C:\Program Files (x86)\LibreOffice 4\program\\python" cgi-bin\DocumentConverter.py '.$source.' '.$dest.'.pdf';
        //echo $query;
        $result = exec($query);
        $source = $dest . '.pdf';
    }
    $dest = $dest . '.swf';
    $query = '"C:\Program Files (x86)\LibreOffice 4\program\python" cgi-bin\DocumentConverter.py '.$source.' '.$dest;
    echo $query;
    $result = exec($query);

    //echo  " ".$result;
    /*if(!$result)
    {
        echo "Libre Office not Installed";
    }*/
?>

