
<?php
    session_start();
    echo '<link rel="stylesheet" href="css/dropdown.css" type="text/css">';

    echo '
            <link href="css/bootstrap.css" rel="stylesheet">
	        <link href="css/bootstrap.min.css" rel="stylesheet">
	        <link href="css/bootstrap-theme.css" rel="stylesheet">
	        <link href="css/bootstrap-theme.min.css" rel="stylesheet">
            <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

            <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
            <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.js"></script>
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
            <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>

    ';


    $user = $_SESSION['user'];
    $key = $_GET['key'];
    echo $key;
    $query = "SELECT * FROM filesystem WHERE owner='$user' ORDER BY isFolder DESC";
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
        <table width="100%" cellpadding="8px" id="uphead1">
            <tr>
                <td width="20%"><span class="glyphicon glyphicon-link"></span><a class="share" href="#">   Share</a></td>
                <td width="20%"><span class="glyphicon glyphicon-download-alt"></span><a class="download" href="#">   Download</a></td> 
                <td width="20%"><span class="glyphicon glyphicon-trash"></span><a class="delete" href="#">   Delete</a></td>
                <td width="20%"><span class="glyphicon glyphicon-edit"></span><a class="rename" href="#">   Rename</a></td>
                <td width="20%"><span class="glyphicon glyphicon-share"></span><a class="move" href="#">   Move</a></td>
            </tr>
        </table> 
    ';
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
    while($row = mysqli_fetch_array($result))
    {
        
        //echo $key;
        $cond1 = $cond2  = FALSE;
        $name = strtolower($row['file_name']);
        $key = strtolower($key);
        if((substr($name, 0, 6) == "dwalin"))
            $name = substr($name, 6);
        //echo $name;
        $cond1 = strpos($name,$key);
        if($cond1 !== FALSE)
          $cond1 = TRUE;
        $temp = explode(".", $row['file_name']);
            $ext = count($temp) == 2? end($temp):'bla';
        if($ext=='txt'){
            //echo 'files/'.$row['file_id'].'.txt';
            $cond2 = search('files/'.$row['file_id'].'.txt',$key);
        }
        $name = $row['file_name'];
        if($cond1 === TRUE or $cond2 === TRUE ){
            if(!(substr($name, 0, 6) == "dwalin")) 
            {
                $temp = explode(".", $row['file_name']);
                $ext = end($temp);
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
                if($ext=="png"||$ext=="jpg"||$ext=="jpeg"||$ext=="gif")
                    echo '<td width="50%" onclick="displayIFrame(\'files/'.$row['file_id'].'.'.$ext.'\')">';
                else{
                    echo '<td width="50%" onclick="displayOther(\'files/'.$row['file_id'].'.'.$ext.'\')">';
                }
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
                echo '<td class="data">';
                echo "04-04-2014";
                echo"</td>";
                echo "</tr>";
            }
            else{
               $temp = explode(".", $row['file_name']);
                $ext = end($temp);
                echo '<tr class="border_bottom"><td width="5%" class="data"><img src="images/folder.png" /></td><td class="data" width="50%" onclick="getFiles(\''.$folder.substr($name, 6).'!\')">'; 
                echo substr($name, 6)."<br>";
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
    }
    echo "</table>";
    echo '<iframe style="height:auto; width:auto;border:0;" id = "preview"></iframe>';
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

