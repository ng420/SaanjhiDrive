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
   
    echo '<div class="tables">';
    echo '<table border="1px" width="100%">';
    echo '<tr>
        <td>File Name</td>
        <td>Type</td>
        <td>Date Modified</td>
    </tr>';
    while($row = mysqli_fetch_array($result))
    {
        $temp = explode(".", $row['file_name']);
        $ext = end($temp);
        echo '<tr><td width="50%">'; 
        echo "<a href='files/".$row['file_id'].".".$ext."'>".$row['file_name']."</a><br>";
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

?>