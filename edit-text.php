<!DOCTYPE html>

<html>

<head>

<script type="text/javascript">
	
	function back()
	{
		window.close() ;
	}

</script>

</head>

<body>

<?php

if(!empty($_POST['submit']))
{
	$text = $_POST['text'] ;
	$file_handle = fopen($filename, 'w');
	fwrite($file_handle, $text);
	fclose($file_handle);
	echo '<script language="javascript">';
    echo 'window.close();';
    echo '</script>';
}

?>


<?php
    
    if(isset($_GET) && !(empty($_GET['editedfilename'])))
    {
	    $filename = $_GET['editedfilename'] ;
	    $fh = fopen($filename, 'r') or die("Can't open file");
	    $data = fread($fh, filesize($filename));
    }
    else 
    {
        echo "Some error occured."; //Redirect to mainpage.
    }
?>

<textarea rows = '32' cols = '100' name='text' form='text' ><?php echo $data ?></textarea> 

<form id="text" action="edit-text.php" method="post">
<input type="submit" name="submit" value="Save"> 
</form>

<button onclick="back()">Cancel and go back</button>


</body>

</html>