<?php
    echo '<link rel="stylesheet" href="css/dropdown.css" type="text/css">';
    session_start();
    $user = $_SESSION['user'];
    $query = "SELECT * FROM filesystem WHERE owner='$user'";
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($con, $query);
    if(!$result)
    {
        echo "Unable to access database.<br>";
    }
    echo '<div style="margin-top:-10px">';
    echo '<div class="tablehead">';
    echo '
        <table width="100%" cellpadding="8px" class="uphead">
            <tr>
                <td width="20%">Share</td>
                <td width="20%">Download</td> 
                <td width="20%">Delete</td>
                <td width="20%">Rename</td>
                <td width="20%">Move</td>
            </tr>
        </table> 
    ';
    echo '
        <table width="100%" cellpadding="8px">
            <tr class="border_bottom">
            <td width="54%">File Name</td>
            <td width="20%">Type</td>
            <td >Date Modified</td>
            <tr>
        </table><br>
    ';
    echo '</div>';
    echo '<div class="tables">';
    echo '<table width="100%"  cellpadding="10px" class="table">';
    while($row = mysqli_fetch_array($result))
    {
        $temp = explode(".", $row['file_name']);
        $ext = end($temp);
        echo '<tr class="border_bottom"><td width="5%" class="data">';
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
        echo '<td width="50%">';
        echo "<a class='contents' href='files/".$row['file_id'].".".$ext."'>".$row['file_name']."</a><br>";
        echo "</td>";
        echo'<td width="20%" class="data">';
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
        echo '<td width="25%" class="data">';
        echo "04-04-2014";
        echo"</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo '</div>';
    echo '</div>';

?>