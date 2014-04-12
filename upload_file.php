<?php
           
      $allowedExts = array("gif", "jpeg", "jpg", "png","txt","pdf","docx","doc","xlsx","xls","csv","rar","zip","tar","mp3","MP4","html","php","css","cshtml","aspx");
        $temp = explode(".", $_FILES["file"]["name"]);
        $extension = end($temp);
        if (in_array(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), $allowedExts) && ($_FILES["file"]["size"] < 5000000))
 /*
        if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/jpg")
        || ($_FILES["file"]["type"] == "image/pjpeg")
        || ($_FILES["file"]["type"] == "image/x-png")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "application/pdf")
        || ($_FILES["file"]["type"] == "application/doc")
        || ($_FILES["file"]["type"] == "application/docx")
        || ($_FILES["file"]["type"] == "application/xls")
        || ($_FILES["file"]["type"] == "application/xlsx")
        || ($_FILES["file"]["type"] == "text/csv")
        || (($_FILES["file"]["type"] == "application/zip")
        || ($_FILES["file"]["type"] == "application/x-zip-compressed")
        || ($_FILES["file"]["type"] == "multipart/x-zip")
        || ($_FILES["file"]["type"] == "application/x-compressed")
        || ($_FILES["file"]["type"] == "application/octet-stream"))
        && ($_FILES["file"]["size"] < 20000000)
        && in_array($extension, $allowedExts))
          */{
          if ($_FILES["file"]["error"] > 0)
            {
                echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
            }
          else
            {
            echo "Upload: " . $_FILES["file"]["name"] . "<br>";
            echo "Type: " . $_FILES["file"]["type"] . "<br>";
            echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

            if (file_exists("upload/" . $_FILES["file"]["name"]))
              {
              echo $_FILES["file"]["name"] . " already exists. ";
              }
            else
              {
              move_uploaded_file($_FILES["file"]["tmp_name"],
              "upload/" . $_FILES["file"]["name"]);
              echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
              }
            }
          }
        else
          {
                echo "Invalid file";
          }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title></title>
    </head>
    <body>
        
    </body>
</html>
