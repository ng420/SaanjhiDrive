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
        
    </div>
	<ul class="menuH decor1">
		
		<li><a class="arrow"><?php echo $_SESSION['user']; ?></a>
			<ul>
				<li><a class="arrow">Home</a>
				</li>
				<li><a class="arrow" href="logout.php">Logout</a>
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

        }
        function run_leanmodalOther(source) {
            $(".go").leanModal({ top: 150, overlay: 0.6, closeButton: ".modal_close" });
        }
    </script> 

    <div id="register">
        <iframe  id="ifrm" width="800px" height="600px" frameborder="0"  scrolling="no" ></iframe>
    </div>

</body>
   
    <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.leanModal.min.js"></script>

</html>
