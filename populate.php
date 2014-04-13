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
        <table width="100%">
            <tr>
            <td width="50%">File Name</td>
            <td width="20%">Type</td>
            <td width="30%">Date Modified</td>
            <tr>
        </table>
    ';
    echo '</div>';
    echo '<div class="tables">';
    echo '<table border="1px" width="100%" cellpadding="10px" class="table">';
    while($row = mysqli_fetch_array($result))
    {
        $temp = explode(".", $row['file_name']);
        $ext = end($temp);
        echo '<tr><td width="50%">'; 
        echo "<a class='contents' href='files/".$row['file_id'].".".$ext."'>".$row['file_name']."</a><br>";
        echo "</td>";
        echo'<td width="20%">';
        echo "image";
        echo"</td >";
        echo '<td width="30%">';
        echo "04-04-2014";
        echo"</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo '</div>';
    echo '</div>';

?>