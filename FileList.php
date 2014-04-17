<?php


    $name = $row['file_name'];

        //Perform these operations for files only.
        if(!(substr($name, 0, 6) == "dwalin")) 
        {
            $temp = explode(".", $row['file_name']);
            $ext = end($temp);  //Extension of file obtained.
            $ext = strtolower($ext);
            echo '<tr class="border_bottom" id="'.$row['file_name'].'" onclick="showopt(\''.$row['file_name'].'\')"><td width="5%" class="data">';
            if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
                echo "<img src='images/picture1.png'>";
             elseif($ext=="doc"|| $ext == "txt" || $ext=="pdf"||$ext=="PDF"||$ext=="ppt"||$ext=="pps"||$ext=="pptx"||$ext=="sdf"||$ext=="dat"||$ext=="docx"||$ext=="log"||$ext=="msg"||$ext=="odt"||$ext=="pages"||$ext=="rtf"||$ext=="tex"||$ext=="txt"||$ext=="wpd"||$ext=="wps")
                 echo "<img src='images/document2.png'>";
             elseif($ext=="exe"||$ext=="exe.config")
                 echo "<img src='images/exec1.png'>";
             elseif($ext=="tar"||$ext=="zip"||$ext=="tar2012"||$ext=="7z"||$ext=="rar")
                echo "<img src='images/compressed.png'>";
            else
                 echo "<img src='images/exec1.png'>";
            echo"</td>";
            
            //Provide preview.
           if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
            {
                echo '<td width="50%"><a class="go" id ="fo" href="#register" onclick="run_leanmodal(\'files/'.$row['file_id'].'.'.$ext.'\');">'.$row['file_name']."</a>";
            }
            else{
                 echo '<td width="50%"><a  class="go" id ="fo" href="#register" onclick="run_leanmodalOther(\'files/'.$row['file_id'].'.'.$ext.'\');" >'.$row['file_name']."</a>";
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
            else
                echo 'Miscellaneous';
            echo"</td >";
            echo '<td class="data">';
            echo "04-04-2014";
            echo"</td>";
            echo "</tr>";
        }

        //For folders.
        else{
           $temp = explode(".", $row['file_name']);
            $ext = end($temp);
            $folder_name = substr($name, 6) ; //Remove dwalin tag.
            $folder_name = str_replace("_", " ", $folder_name); //Replace underscore by blank spaces.
            echo '<tr class="border_bottom"><td width="5%" class="data"><img src="images/folder.png" /></td><td class="data" width="50%" onclick="getFiles(\''.$folder.substr($name, 6).'!\')">'; 
            echo $folder_name."<br>";
            echo "</td>";
            echo'<td class="data" width="20%">';
            echo "Folder";
            echo"</td >";
            echo '<td class="data" width="30%">';
            echo "04-04-2014";
            echo"</td>";
            echo "</tr>";
        }
?>


