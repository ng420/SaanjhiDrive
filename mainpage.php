<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome Page</title>
    <!-- Add custom CSS here -->
    <link href="css/dropdown.css" rel="stylesheet">
	<link href="css/simple-sidebar.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <script>
        var current_folder = '!';
    </script>

	</head>

<body onload="getFiles('!')" >
    <?php
        session_start();
        $_SESSION['user']=$_POST['usrname'];
    ?>
    <div id="wrapper">

        <!-- Sidebar--> 
         <div id="sidebar-wrapper">
			<img class="logo" src="images/sanjhalogo.jpg" width="50" height="50" alt="logo">
            <ul class="sidebar-nav">
				<li>
                <form action="" name="uploadForm" method="post" enctype="multipart/form-data" id="form">
                <input type="file" name="file" onchange="callUpload()" id="file" style="visibility: hidden; width: 1px; height: 1px" multiple><br>
                <li><a class="upload" href="#" onclick="document.getElementById('file').click(); return false" >Upload </a> </li>
                </form>
               
				<li><a href="#">MyDrive</a>
                </li>
                <li><a href="#">Recent</a>
                </li>
                <li><a href="#">Shared With Me</a>
                </li>
                <li><a href="#">Install For desktop</a>
                </li>
            </ul>
        </div>
        <script type="text/javascript">
            function callUpload() {
                var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
                var dir_path = "";
                for (var i in cells) {
                    dir_path += cells[i].innerHTML;
                    if(dir_path[dir_path.length-1]==" "){
                        dir_path = dir_path.substr(0,dir_path.length-1);
                    }
                }
                dir_path = dir_path.replace('Home', '');
                while ((dir_path.indexOf('&gt;') != -1)) {
                    dir_path = dir_path.replace('&gt;', '!');

                }
                
                dir_path = dir_path.concat('!');
                //alert(dir_path);
                var xmlhttp;
                //alert('in callUpload()');
                var form = document.getElementById('form');
                var fileSelect = document.getElementById('file');
                var files = fileSelect.files;
                var formData = new FormData();
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];

                    // Add the file to the request.
                    formData.append('file', file, file.name);
                }
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    //alert("sdfasdfsda");
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        alert(xmlhttp.responseText);
                        getFiles(dir_path);
                    }
                }
                xmlhttp.open("POST", "upload_file.php", true);
                formData.append("directory_path", dir_path);
                xmlhttp.send(formData);
            }
            function getFiles(path) {
                var xmlHttp;
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlHttp = new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlHttp.open("POST", "populate.php", true);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.send("folder=" + path);
                xmlHttp.onreadystatechange = function () {
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                        //alert('in getFiles()');
                        document.getElementById('files').innerHTML = xmlHttp.responseText;
                        var res = path.split("!");

                        division = "<table><td onclick=\"getFiles(\'!\')\">Home </td>";
                        for (i = 1; i < res.length - 1; i++) {
                            division += "  <td onclick=\"getFiles(\'";
                            for (j = 0; j <= i; j++) {
                                division += res[j] + '!';
                            }
                            division += "\')\">>" + res[i] + " </td>  ";
                        }
                        division += "</table>";
                        document.getElementById('path').innerHTML = division;
                    }
                }


            }
            function showopt() {
                var lTable = document.getElementById("uphead1");
                lTable.style.display = (lTable.style.display == "table") ? "none" : "table";
            }

            function displayIFrame(source) {
                document.getElementById('preview').src = source;
                //alert('sad');
            }
            function displayOther(source) {
                var xmlHttp;
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlHttp = new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlHttp.open("POST", "convert.php", true);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.send("source=" + source);
                xmlHttp.onreadystatechange = function () {
                    //alert(xmlHttp.status);
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {

                        var res = source.split(".");
                        source = res[0] + ".swf";
                        //alert(xmlHttp.responseText);
                        displayIFrame(source);
                        deleteFiles(res[0], res[1]);
                    }
                }
            }

            function deleteFiles(source, ext) {
                var xmlHttp;
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlHttp = new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlHttp.open("POST", "delete.php", true);
                xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlHttp.send("source=" + source + "&extension=" + ext);
                xmlHttp.onreadystatechange = function () {
                    //alert(xmlHttp.status);
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                        ;
                        //alert(xmlHttp.responseText);
                    }
                }
            }
       </script>
    </div>
	<ul class="menuH decor1">
		
		<li><a class="arrow"><?php echo $_POST['usrname']; ?></a>
			<ul>
				<li><a class="arrow">Home</a>
				</li>
				<li><a class="arrow">Logout</a>
				</li>
				<li><a class="arrow">Help</a>
				</li>
			</ul>
		</li>
		<li><img src="images/notification.png" style="float:left; margin-right:40px; margin-top:4px;"></li>
	</ul><br>
	<div class="name">SaanjhiDrive</div>
	<!-- JavaScript --
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>
    <div class="path" id="path">
        Home
    </div>
    <div id="files">
    
    </div>
</body>

</html>
