<?php


    $name = $row['file_name'];

        //Perform these operations for files only.
        if(!(substr($name, 0, 6) == "dwalin")) 
        {
          $temp = explode(".", $row['file_name']);
            $ext = end($temp);  //Extension of file obtained.
            $ext = strtolower($ext);
            echo '<tr class="br" id="'.$row['file_name'].'" onclick="showopt(\''.$row['file_name'].'\')"><td width="5%" class="data">';
            if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
                echo '<span class="glyphicon glyphicon-picture"></span>';
             elseif($ext=="doc"|| $ext == "txt" || $ext=="pdf"||$ext=="PDF"||$ext=="ppt"||$ext=="pps"||$ext=="pptx"||$ext=="sdf"||$ext=="dat"||$ext=="docx"||$ext=="log"||$ext=="msg"||$ext=="odt"||$ext=="pages"||$ext=="rtf"||$ext=="tex"||$ext=="txt"||$ext=="wpd"||$ext=="wps")
                 echo '<span class="glyphicon glyphicon-file"></span>';
             elseif($ext=="exe"||$ext=="exe.config")
                 echo '<span class="glyphicon glyphicon-credit-card"></span>';
             elseif($ext=="tar"||$ext=="zip"||$ext=="tar2012"||$ext=="7z"||$ext=="rar")
                echo '<span class="glyphicon glyphicon-compressed"></span>';
                elseif($ext=="mp3")
                echo '<span class="glyphicon glyphicon-music"></span>';
                elseif($ext=="mp4"||$ext=="flv"||$ext=="mkv"||$ext=="avi"||$ext=="wmv"||$ext=="webm")
                echo '<span class="glyphicon glyphicon-film"></span>';
                else
                  echo '<span class="glyphicon glyphicon-exclamation-sign"></span>';
            echo"</td>";
            
            //Provide preview.
           if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
            {
                echo '<td width="50%"><a class="go" href="files/'.$row['file_id'].'.'.$ext.'" data-lightbox="example-2" data-title="'.$row['file_name'].'.'.$ext.'");">'.$row['file_name']."</a>";
            }
            elseif($ext == "mp4" || $ext == "ogg" || $ext == "webm"){
                 echo '<td width="50%"><a class="go"   href="#" onclick="displayVideo(\'files/'.$row['file_id'].'.'.$ext.'\');">'.$row['file_name']."</a>";    
            }
            elseif($ext == "mp3" || $ext == "ogg" || $ext == "wav"){
                 echo '<td width="50%"><a class="go"   href="#" onclick="displayAudio(\'files/'.$row['file_id'].'.'.$ext.'\');">'.$row['file_name']."</a>";
            }
            elseif($ext == "txt"){
                echo '<td width="50%"><a  class="go" onclick="displayIFrame(\'files/'.$row['file_id'].'.'.$ext.'\');" >'.$row['file_name']."</a>";
            }
            elseif($ext == "doc"||$ext == "docx"||$ext == "xls"||$ext == "xlsx"||$ext == "rtf"||$ext == "csv"||$ext == "ods"||$ext == "odp"||$ext =="ppt"||$ext=="pptx"||$ext=="pdf"){
                 echo '<td width="50%"><a  class="go" onclick="displayOther(\'files/'.$row['file_id'].'.'.$ext.'\');" >'.$row['file_name']."</a>";
            }
            else{
                 echo '<td width="50%">'.$row['file_name'];               
            }

            echo "</td>";
            echo'<td width="20%" class="data">';
            
            //Show file types.
            if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
                echo 'Image';
            elseif($ext=="doc"||$ext == "txt"||$ext=="pdf"||$ext=="PDF"||$ext=="ppt"||$ext=="pps"||$ext=="pptx"||$ext=="sdf"||$ext=="dat"||$ext=="docx"||$ext=="log"||$ext=="msg"||$ext=="odt"||$ext=="pages"||$ext=="rtf"||$ext=="tex"||$ext=="txt"||$ext=="wpd"||$ext=="wps")
                echo 'Document';
            elseif($ext=="exe"||$ext=="exe.config")
                echo 'Executable';
            elseif($ext=="tar"||$ext=="zip"||$ext=="tar2012"||$ext=="7z"||$ext=="rar")
                echo 'Compressed';
            elseif($ext=="mp3")
                echo "Audio";
            elseif($ext=="mp4"||$ext=="flv"||$ext=="mkv"||$ext=="avi"||$ext == "wmv"||$ext=="webm")
               echo "Video";
            else
                echo 'Miscellaneous';
            echo"</td >";
            echo'<td width="25%" class="data">';
            if($row['shared_by'])
            {
                echo $row['shared_by'];
            }
            else 
            {
                echo "--";
            }
            echo"</td>";
            echo "</tr>";
        }

        //For folders.
        else{
           $temp = explode(".", $row['file_name']);
            $ext = end($temp);
            $folder_name = substr($name, 6) ; //Remove dwalin tag.
            $folder_name = str_replace("_", " ", $folder_name); //Replace underscore by blank spaces.
            echo '<tr class="border_bottom"><td width="5%" class="data"><span class="glyphicon glyphicon-folder-open"></span></td>';
            echo '<td "width="50%">'; 
            echo '<a class="data" onclick="getFiles(\''.$folder.substr($name, 6).'!\')">'.$folder_name.'</a>';
            echo '</td>';
            echo'<td class="data" width="20%">';
            echo "Folder";
            echo"</td >";
            echo '<td class="data" width="25%">';
            if($row['shared_by'])
            {
                echo $row['shared_by'];
            }
            else 
            {
                echo "--";
            }
            echo"</td>";
            echo "</tr>";
        }
        $count = $count+1;
?>


