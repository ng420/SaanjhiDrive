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
        include 'FileList.php';
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';
    
?>