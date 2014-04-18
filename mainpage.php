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
                <li><a href="#">Install For desktop</a>
                </li>
                <li>
                    <div id="drag_drop">
                        <a href="#">Drag Files here</a>
                    </div>
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
			<li><span class="glyphicon glyphicon-bell" style="margin-top: 10px; margin-right: 30px;"></span></li>
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
        function run_leanmodalOther(source) {
            var res = source.split(".");
            var ext = res[1];
            //var ext = extension.tolower();
            document.write(source);
            if (ext == 'pdf') {
                document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == "txt") {
                document.write('<object data="' + source + '" type=text/plain width=800 style=height: 470px >' + '</object>');
                // document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == "mp4") {
                //document.write('<embed src="files/a.mp4" "' + source + '" width="200" height="200">');
                document.write('<video width="320" height="240" controls autoplay>' +
             '<source src="' + source + '" type="video/mp4">' +
             'Your browser does not support video' +
             '</video>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == "png" || ext == "jpg" || ext == "jpeg" || ext == "gif") {
                document.write('<img src="' + source + '" alt=" lkhjds" style="position:relative ;"/>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            }
            else if (ext == 'doc' || ext == 'docx') {
                document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
                // 
                //  document.write('<iframe src="'+source+'" width=100% height=700px></iframe>');
            }
            else if (ext == 'ppt') {
                document.write('<embed src = "' + source + '" width = 800px height = 450px>');
                document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
                // 
            }

            document.write(source);
            document.write('<input type="submit" value="X" id="closebut" style="position: absolute; left: 1280px; top: 0px; " onclick="location.reload()">');
            // 

            /*document.write ('<video width="320" height="240" controls autoplay>'+
            '<source src="files/a.mp4" type="video/mp4">'+
            '<object data="movie.mp4" width="320" height="240">'+
            '<embed width="320" height="240" src="movie.swf">'
            +'</object>'+
            '</video>');*/
            /* document.write('<img src=" files/10.jpg" alt=" lkhjds"style="position:relative ;"/>');
            document.write('<body>' + '<div style=" width: 100%; height: 100px; overflow:hidden;" class="fakewindowcontain"id="e">'
            + '<div class="ui-overlay" id="a"><div class="ui-widget-overlay" id="c">kjgg THIS IS THE BACKGROUNDgkgkg</div><div class="ui-widget-shadow ui-corner-all" style="width: 0px; height: 0px; position: absolute; left: 50px; top: 30px;"id="d"></div></div> '
            + '<div style="position: absolute; width: 00px; height:0px;left: 50px; top: 30px; padding: 0px;" style="background-color :#d92525;" class="ui-widget ui-widget-content ui-corner-all" id="b">'
            + '<div class="ui-dialog-content ui-widget-content" style="background-color :#d92525; border: 0;">' + '</body>');
            document.write(source);
            document.write(' <embed src = source width = 800px height = 450px> ' + '<object data=files/8.txt type=text/plain width=800 style=height: 470px >' + ' <a href=source>No Support?</a> ' + '</object>');
            //document.write("<object data=files/8.txt type=text/plain width=800 style=height: 470px > ");
            //  document.write("  <a href=source>No Support?</a> ");
            //  document.write("</object>");

            /* var video = '<button onclick="playVid()" type="button">Play Video</button>';

            video += ' <button onclick="pauseVid()" type="button">Pause Video</button>';
            video += ' <br>';
            video += ' <span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">';
            video += ' <video id="video1">';
            video += '  <source src="files/a.mp4" type="video/mp4" style="position: absolute; width: 800px; height:755px;left: 10px; top: 10px; padding: 0px;">';
            video += '  Your browser does not support HTML5 video. </video>';
            video += '</span></span></span></span></span></span><br>';

            video += '   var myVideo=document.getElementById("video1"); ';

            video += '  function playVid()';
            video += '   { ';
            video += '  myVideo.play(); ';
            video += '  } ';

            video += ' function pauseVid()';
            video += ' { myVideo.pause(); } ';
            document.getElementById("ifrm").innerHTML = video;*/

            /*   var html_text = '<button onclick="playVid()" type="button">Play Video</button>';
            html_text.concat('<button onclick="pauseVid()" type="button">Pause Video</button><br>');
            html_text.concat('<span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;"><span class="ui-dialog-content ui-widget-content" style="background: none; border: 0;">');
            html_text.concat(' <video id="video1">');
            html_text.concat('<source src="files/a.mp4" type="video/mp4" style="position: absolute; width: 800px; height:755px;left: 10px; top: 10px; padding: 0px;">');
            html_text.concat('Your browser does not support HTML5 video. </video>');
            html_text.concat('</span></span></span></span></span></span><br>');
            html_text.concat('<script> ');
            html_text.concat('var myVideo=document.getElementById("video1");');
            html_text.concat(' function playVid()');
            html_text.concat(' { myVideo.play(); } ');
            html_text.concat('function pauseVid()');
            html_text.concat('{ myVideo.pause(); }');

            document.getElementById("video1").innerHTML = html_text;

            var myVideo = document.getElementById("video1");


            function playVid() {
            myVideo.play();
            }

            function pauseVid() {
            myVideo.pause();
            }
            /* var keyword;
            var srctxt;
            var srctxtarray;

            keyword = "archery";
            srctxt = "hellow blah blah blah archery <img src= files/10.jpg>hello test archery";

            srctxtarray = srctxt.split(" ");
            for (var i = 0; i < srctxtarray.length; i++) {
            if (srctxtarray[i] != keyword) {
            document.write(srctxtarray[i]);
            }
            else {
            document.write("<b class=\"red\">");
            document.write(srctxtarray[i]);
            document.write("</b>");
            }
            }*/
            // $(".go").leanModal({ top: 150, overlay: 0.6, closeButton: ".modal_close" });
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
        myDropzone.uploadMultiple = true;
    </script>

</body>
</html>
