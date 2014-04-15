<?php
    
    //Start session to access session variables.
    session_start();

    echo '<link rel="stylesheet" href="css/dropdown.css" type="text/css">';
    
    //Set variables to perform database query.
    $user = $_SESSION['user'];
    $folder = $_POST['folder'];

    //Establish connection.
    $query = "SELECT * FROM filesystem WHERE owner='$user' AND directory_path = '$folder' ORDER BY isFolder DESC";
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    if (mysqli_connect_errno())
    {
        //Unable to establish connection.
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //Perform query.
    $result = mysqli_query($con, $query);
    
    //If query is performed unsuccessfully.
    if(!$result)
    {
        echo "Unable to access database.<br>";
    }

    //Create options table.
    echo '<div style="margin-top:-10px">';
    echo '<div class="tablehead">';
    echo '
        <table width="100%" cellpadding="8px" id="uphead1">
            <tr>
                <td width="20%"><a class="share" href="#">Share</a></td>
                <td width="20%"><a class="download" href="#">Download</a></td> 
                <td width="20%"><a class="delete" href="#">Delete</a></td>
                <td width="20%"><a class="rename" href="#">Rename</a></td>
                <td width="20%"><a class="move" href="#">Move</a></td>
            </tr>
        </table> 
    ';

    //File parameter table.
    echo '
        <table width="79%" cellpadding="8px">
            <tr class="border_bottom">
            <td width="55%">File Name</td>
            <td width="20%">Type</td>
            <td >Date Modified</td>
            <tr>
        </table><br>
    ';
    echo '</div>';
    echo '<div class="tables">';
    echo '<table width="80%" cellpadding="10px" class="table">';

    //Traverse through query results.
    while($row = mysqli_fetch_array($result))
    {
        $name = $row['file_name'];

        //Perform these operations for files only.
        if(!(substr($name, 0, 6) == "dwalin")) 
        {
            $temp = explode(".", $row['file_name']);
            $ext = end($temp);  //Extension of file obtained.
            echo '<tr class="border_bottom" onclick="showopt()"><td width="5%" class="data">';
            if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
                echo "<img src='images/picture1.png'>";
             elseif($ext=="doc"||$ext=="pdf"||$ext=="PDF"||$ext=="ppt"||$ext=="pps"||$ext=="pptx"||$ext=="sdf"||$ext=="dat"||$ext=="docx"||$ext=="log"||$ext=="msg"||$ext=="odt"||$ext=="pages"||$ext=="rtf"||$ext=="tex"||$ext=="txt"||$ext=="wpd"||$ext=="wps")
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
                echo '<td width="50%"><a class="contents" onclick="displayIFrame(\'files/'.$row['file_id'].'.'.$ext.'\');">'.$row['file_name']."</a>";
            else{
                echo '<td width="50%"><a class="contents" onclick="displayOther(\'files/'.$row['file_id'].'.'.$ext.'\');">'.$row['file_name']."</a>";
            }

            echo "</td>";
            echo'<td width="20%" class="data">';
            
            //Show file types.
            if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
                echo 'Image';
            elseif($ext=="doc"||$ext=="pdf"||$ext=="PDF"||$ext=="ppt"||$ext=="pps"||$ext=="pptx"||$ext=="sdf"||$ext=="dat"||$ext=="docx"||$ext=="log"||$ext=="msg"||$ext=="odt"||$ext=="pages"||$ext=="rtf"||$ext=="tex"||$ext=="txt"||$ext=="wpd"||$ext=="wps")
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
    }
    echo "</table>";
    echo '<iframe style="height:auto; width:auto;border:0;" id = "preview"></iframe>';
    echo '</div>';
    echo '</div>';

?>