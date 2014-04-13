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


	</head>

<body onload="getFiles()" >
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
                        getFiles();
                    }
                }
                xmlhttp.open("POST", "upload_file.php", true);
                xmlhttp.send(formData);
            }
            function getFiles() {
                var xmlHttp;
                
                if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlHttp = new XMLHttpRequest();
                }
                else {// code for IE6, IE5
                    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlHttp.open("POST", "populate.php", true);
                xmlHttp.send();
                xmlHttp.onreadystatechange = function () {
                    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                        //alert('in getFiles()');
                        document.getElementById('files').innerHTML = xmlHttp.responseText;
                    }
                }
               
                
            }


       </script>

        <!-- Page content 
        <div id="page-content-wrapper">
            <div class="content-header">
                <h1>
                    <a id="menu-toggle" href="#" class="btn btn-default"><i class="icon-reorder"></i></a>
                    Simple Sidebar
                </h1>
            </div>
            <!-- Keep all page content within the page-content inset div! 
            <div class="page-content inset">
                <div class="row">
                    <div class="col-md-12">
                        <p class="lead">This simple sidebar template has a hint of JavaScript to make the template responsive. It also includes Font Awesome icon fonts.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="well">The template still uses the default Bootstrap rows and columns.</p>
                    </div>
                    <div class="col-md-6">
                        <p class="well">But the full-width layout means that you wont be using containers.</p>
                    </div>
                    <div class="col-md-4">
                        <p class="well">Three Column Example</p>
                    </div>
                    <div class="col-md-4">
                        <p class="well">Three Column Example</p>
                    </div>
                    <div class="col-md-4">
                        <p class="well">You get the idea! Do whatever you want in the page content area!</p>
                    </div>
                </div>
            </div>
        </div> -->

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
	<input name="srch" type="text" class="search" placeholder="Search">
    <!-- JavaScript -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.js"></script>

    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>
    <div id="files">
    
    </div>
</body>

</html>
