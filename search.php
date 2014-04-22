<?php
    
    //Start session to access session variables.
    session_start();

    echo '<link rel="stylesheet" href="css/dropdown.css" type="text/css">';
    
    //Set variables to perform database query.
    $user = $_SESSION['user'];
    $key = $_GET['key'];

    //Establish connection.
    $query = "SELECT * FROM filesystem WHERE owner='$user' ORDER BY isFolder DESC";
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
        
        $cond1 = FALSE;
        $name = strtolower($row['file_name']);
        $key = strtolower($key);
        if((substr($name, 0, 6) == "dwalin"))
            $name = substr($name, 6);
        //echo $name;
        $cond1 = strpos($name,$key);
        if($cond1 !== FALSE)
          $cond1 = TRUE;
        if($cond1 === TRUE){
            include 'FileList.php';
        }
    }
    $query = "SELECT * FROM filesystem WHERE owner='$user'  ORDER BY isFolder DESC";


    //Perform query.
    $result = mysqli_query($con, $query);
    
    //If query is performed unsuccessfully.
    if(!$result)
    {
        echo "Unable to access database.<br>";
    }
    while($row = mysqli_fetch_array($result))
    {
        
        $cond2  = FALSE;
        //$name = strtolower($row['file_name']);
        $key = strtolower($key);
        //if((substr($name, 0, 6) == "dwalin"))
          //  $name = substr($name, 6);
        //echo $name;
        //$cond1 = strpos($name,$key);
        //if($cond1 !== FALSE)
          //$cond1 = TRUE;
        $temp = explode(".", $row['file_name']);
            $ext = count($temp) == 2? end($temp):'bla';
        if($ext=='txt'){
            //echo 'files/'.$row['file_id'].'.txt';
            $cond2 = search('files/'.$row['file_id'].'.txt',$key);
        }
        if($cond2 === TRUE){
            include 'FileList.php';
        }        

    }
    echo "</table>";
    //echo '<iframe style="height:auto; width:auto;border:0;" id = "preview"></iframe>';
    echo '</div>';
    echo '</div>';
     function search($Filename , $keyword){
	        //echo $Filename;
    		$x = FALSE ;
            $data = strtolower(file_get_contents($Filename));
            //echo $data.$keyword;
            //$keyword = strtolower($keyword);
			//$fh = fopen($FileName, 'r') or die("Can't open file");
			//$data = fread($fh, filesize($FileName));
			$Pos = strpos($data,$keyword);
            
            if($Pos !== FALSE){
				$x = TRUE ;
    		}
			return $x ;
           // return TRUE;
	}

?>