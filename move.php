<?php
    
    //Start session to access session variables.
    session_start();
    $filename = $_POST['filename'];
    $currDir = $_POST['current_dir'];
    echo '<link rel="stylesheet" href="css/dropdown.css" type="text/css">';
    
    //Set variables to perform database query.
    $user = $_SESSION['user'];
    
    //Establish connection.
    $query = "SELECT * FROM filesystem WHERE owner='$user' AND isFolder='1' ORDER BY isFolder DESC";
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
        <table width="79%" cellpadding="8px" class="heading">
            <tr class="border_bottom">
            <td width="59%">Folder Name</td>
            <td >Path</td>
            <tr>
        </table><br>
    ';
    echo '</div>';
    echo '<div class="tables">';
    echo '<table width="80%" cellpadding="10px" class="table">';
    echo '<tr class="border_bottom"><td width="5%" class="data"><span class="glyphicon glyphicon-folder-open"></span></td><td class="data" width="50%" onclick="DestDirMove(\''.$filename.'\',\''.$currDir.'\',\''.'!'.'\')">'; 
    echo "Home<br>";
    echo "</td>";
    echo'<td class="data" width="45%">';
    echo "";
    echo"</td >";
            
    echo "</tr>";
    //Traverse through query results.
    while($row = mysqli_fetch_array($result))
    {   
            $name = $row['file_name'];
            $folder_name = substr($name, 6) ; //Remove dwalin tag.
            $folder_name = str_replace("_", " ", $folder_name); //Replace underscore by blank spaces.
            $path = str_replace('!'," \ ",$row["directory_path"]);
            $path = substr($path,3);
            if($path == ""){
                $path = "Home";
            }
            else{
                $path = "Home ".$path;
            }
            echo '<tr class="border_bottom"><td width="5%" class="data"><span class="glyphicon glyphicon-folder-open"></span></td><td class="data" width="50%" onclick="DestDirMove(\''.$filename.'\',\''.$currDir.'\',\''.$row['directory_path'].$folder_name.'!'.'\')">'; 
            echo $folder_name."<br>";
            echo "</td>";
            echo'<td class="data" width="45%">';
            echo $path;
            echo"</td >";
            
            echo "</tr>";
                

    }
    echo "</table>";
    //echo '<iframe style="height:auto; width:auto;border:0;" id = "preview"></iframe>';
    echo '</div>';
    echo '</div>';

?>