


<?php
    session_start();
    $user = $_SESSION['user'];
    $con=mysqli_connect("localhost","root","r00tpass","mysql_db");
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
       $filename =$_POST['filename'] ;
    $currDir = $_POST['current_dir'];
        //echo $currDir;
       $query = "SELECT * FROM filesystem WHERE file_name = '$filename' AND owner='$user' AND directory_path = '$currDir'  ";
    //echo $query;
   if($result = mysqli_query($con, $query)){
        //echo 'lol';
        //$count = 0;
        while($row = mysqli_fetch_array($result)){
          //  $count = $count + 1;
            $id = $row['file_id'];
        }
    	$temp = explode(".", $filename);
        $ext = end($temp);
        $filename = 'files/'.$id.'.'.$ext;
        //echo $filename;
		$fh = fopen($filename, 'r') or die("Can't open file");
		$data = fread($fh, filesize($filename));
		}
    echo '<table>
	<tr>
		<td width="70%">
			<textarea id = "lol" style="border-style:none;font-size:16px;padding:20px;" rows = \'30\' cols = \'50\' name=\'text\' form=\'text\' >'.$data.'</textarea>
		</td>
		<td width="30%" style="padding-left:5%;">
			<form style="align:center;" id="text" method="post">
			<div style="padding-left:40px;">
			<input onclick="save(\''.$filename.'\')" type="submit" name="submit" value="Save">
			</div>
			</form>
			<div style="padding-top:10px;">
			<button onclick="back()">Cancel</button>
			</div>
		</td>
	</tr>
</table>';
?>
