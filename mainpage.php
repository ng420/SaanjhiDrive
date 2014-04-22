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
    <link rel="stylesheet" href="css/lightbox.css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <script>
        var current_folder = '!';
    </script>

	</head>

<body onload="getFiles('!')" >
    <?php
        session_start();
        if(!(isset($_SESSION)) || (empty($_SESSION['user'])))
        {
            header('Location: '. "index.php" );
        }
        //_SESSION['user']=$_POST['usrname'];
    ?>

    <div id="wrapper">

        <!-- Sidebar--> 
         <div id="sidebar-wrapper">
			<!--<img class="logo" src="images/sanjhalogo.jpg" width="50" height="50" alt="logo">-->
            <ul class="sidebar-nav">
				<li>
                <form action="" name="uploadForm" method="post" enctype="multipart/form-data" id="form">
                <input type="file" name="file[]" onchange="callUpload()" id="file" style="visibility: hidden; width: 1px; height: 1px" multiple><br>
                <li><a class="upload" href="#" onclick="document.getElementById('file').click(); return false" >Upload </a> </li>
                </form>
               
				<li><a href="#" onclick="getFiles('!');">MyDrive</a>
                </li>
                <li><a href="#" onclick="shared_with_me();">Shared With Me</a>
                </li>
                <li><a href="#" onclick="upload_folder()">Create Folder</a>
                </li>
                <li><a href="setup/setup.exe">Install For desktop</a>
                </li>
                <li>
<!--                    <div id="drag_drop">
                        <a href="#">Drag Files here</a>
                    </div>-->
                </li>
            </ul>
        </div>
        
    </div>
	<ul class="menuH decor1">
		
		<li><a class="arrow"><?php echo $_SESSION['user']; ?></a>
			<ul>
				<li><a class="arrow" onclick="getFiles('!');">Home</a>
				</li>
				<li><a class="arrow" href="logout.php">Logout</a>
				</li>
				<li><a class="help" href="img/demopage/image-1.jpg" data-lightbox="example-1">Help</a>
			    </li>
			</ul>
		</li>
			<!--<li><span class="glyphicon glyphicon-bell" style="margin-top: 10px; margin-right: 30px;"></span></li>-->
	</ul><br>
    <div class="sanjhacontainer">
	<div class="name">SaanjhiDrive</div> 
	    <div class="input-group">
            <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>       
            <input type="text" onkeyup="search()" id ="search" class="form-control" placeholder="Search here..">
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
            $("#register").show();
        }
     
    </script> 

  

    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
    <script src="js/bootminjs.js"></script>
    <script src="js/bootbox.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
    <script type="text/javascript" src="js/dropzone.js"></script>
    <script src="js/lightbox2.js"></script>
	<script src="js/lightbox.js"></script>

	<script>
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-2196019-1']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
	</script>

    <script type="text/javascript">
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
        var myDropzone = new Dropzone("div#drag_drop", { url: "upload_file.php" });
        //myDropzone.uploadMultiple = true;
    </script>

</body>
</html>
