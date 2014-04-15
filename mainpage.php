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

    <script>
        var current_folder = '!';
    </script>

	</head>

<body onload="getFiles('!')" >
    <?php
        session_start();
        //_SESSION['user']=$_POST['usrname'];
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
                <li><a href="#" onclick="upload_folder()">Create Folder</a>
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
                    if (dir_path[dir_path.length - 1] == " ") {
                        dir_path = dir_path.substr(0, dir_path.length - 1);
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
            function upload_folder() {
                var folder_name = "";
                while (folder_name.length == 0) {
                    folder_name = prompt("Enter folder name?");
                }
                var cells = Array.prototype.slice.call(document.getElementById("path").getElementsByTagName("td"));
                var dir_path = "";
                for (var i in cells) {
                    dir_path += cells[i].innerHTML;
                    if (dir_path[dir_path.length - 1] == " ") {
                        dir_path = dir_path.substr(0, dir_path.length - 1);
                    }
                }
                dir_path = dir_path.replace('Home', '');
                while ((dir_path.indexOf('&gt;') != -1)) {
                    dir_path = dir_path.replace('&gt;', '!');

                }

                dir_path = dir_path.concat('!');
                //alert(dir_path);
                var xmlhttp;
                var form_data = new FormData();
                //alert('in callUpload()');
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
                    //alert(xmlhttp.status);
                }
                xmlhttp.open("POST", "create_folder.php", true);
                //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                form_data.append("folder_name", folder_name);
                form_data.append("directory_path", dir_path);
                xmlhttp.send(form_data);
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
                        for (i = 1; i < res.length - 1; i++) {
                            res[i] = res[i].replace(/_/g, " ");
                        }
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
            /*function showopt() {
                var lTable = document.getElementById("uphead1");
                lTable.style.display = (lTable.style.display == "table") ? "none" : "table";
            }
            */

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
            function search() {
                var xmlHttp;
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlHttp = new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                var keyword = document.getElementById('search').value;
                //alert(keyword);
                if (keyword == "") {
                    getFiles("!");
                }
                else {
                    xmlHttp.open("GET", "search.php?key=" + keyword, true);
                    //xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlHttp.send();
                    xmlHttp.onreadystatechange = function () {
                        //alert(xmlHttp.status);
                        if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                            //alert('in getFiles()');
                            //alert('asdas');
                            document.getElementById('files').innerHTML = xmlHttp.responseText;
                            //var res = path.split("!");

                            /*division = "<table><td onclick=\"getFiles(\'!\')\">Home </td>";
                            for (i = 1; i < res.length - 1; i++) {
                            division += "  <td onclick=\"getFiles(\'";
                            for (j = 0; j <= i; j++) {
                            division += res[j] + '!';
                            }
                            division += "\')\">>" + res[i] + " </td>  ";
                            }
                            division += "</table>";
                            document.getElementById('path').innerHTML = division;*/
                        }
                    }
                }
            }
       </script>
    </div>
	<ul class="menuH decor1">
		
		<li><a class="arrow"><?php echo $_SESSION['user']; ?></a>
			<ul>
				<li><a class="arrow">Home</a>
				</li>
				<li><a class="arrow">Logout</a>
				</li>
				<li><a class="arrow">Help</a>
				</li>
			</ul>
		</li>
		<li><img src="images/notification.png" style="float:left; margin-right:40px; margin-top:4px; margin-left: "></li>
	</ul><br>
    <div class="sanjhacontainer">
	<div class="name">SaanjhiDrive</div> 
	    <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>       
            <input type="text" onkeyup="search()" id ="search" class="form-control">
        </div>
    </div>
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
    <script>
            function run_leanmodal(source) {
                $(".go").leanModal({ top: 150, overlay: 0.6, closeButton: ".modal_close" });
                document.getElementById("ifrm").src = source;

            }
            function run_leanmodalOther(source) {
                $(".go").leanModal({ top: 150, overlay: 0.6, closeButton: ".modal_close" });
            }
        </script> 

    <div id="register">
        <iframe  id="ifrm" width="800px" height="600px" frameborder="0"  scrolling="no"></iframe>
    </div>
</body>

</html>
