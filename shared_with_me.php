<?php
    
    //Start session to access session variables.
    session_start();

    echo '<link rel="stylesheet" href="css/dropdown.css" type="text/css">';
    $count = 0;
    //Set variables to perform database query.
    $user = $_SESSION['user'];

    //Establish connection.
    $query = "SELECT * FROM filesystem WHERE owner='$user' AND shared_by != '' AND isFolder = '0' ";
    
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
    echo '<div id = "options"></div>';

    //File parameter table.
    echo '
        <table width="84%" cellpadding="8px" class="heading">
            <tr id="row_id" class="border_bottom">
            <td width="55%">File Name</td>
            <td width="20%">Type</td>
            <td >Shared By</td>
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

        //Perform these operations for specific file types.

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
            echo '<td width="50%"><a class="go" id ="fo" href="files/'.$row['file_id'].'.'.$ext.'" data-lightbox="example-1">'.$row['file_name']."</a>";
        }
        else
        {
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

    echo '</div>';
    echo '</div>';
    
?>