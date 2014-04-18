<!DOCTYPE html>
<html lang="en">
  <head>
    <?php
        session_start();
        if(isset($_SESSION) && !(empty($_SESSION['user'])))
        {
            header('Location: '."mainpage.php");
        }
        elseif(isset($_COOKIE['user']))
        {
            $_SESSION['user']=$_COOKIE['user'];
            header('Location: '."mainpage.php");
        }
    ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content=""> 
    <title>SaanjhiDrive</title>
	    <link href="css/signin.css" rel="stylesheet">
	<link rel="shortcut icon" href="images/icon.ico">
	<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="js/jquery.leanModal.min.js"></script>
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />
	<link type="text/css" rel="stylesheet" href="css/style.css" />

  </head>

  <body>

    <div class="panel-heading">
            <h2 class="panel-title">Welcome To SaanjhiDrive</h2>
			<h3 class="panel-subtitle">Saaddi drive, tuhada data!</h3>
    </div>
	<div class="all">
	<!--login_container class contains all the elements defined in the main page-->
	<div class="login_container">
		<div class="row">
			<div class="col-sm-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<form action="sign_in.php" name="signinform" class="form-signin" role="form" method="POST" >
						<h2 class="form-signin-heading">Sign in</h2><br>
						<input id = "a" name="usrname" type="text" class="form-control" placeholder="Username"><br><div class="br1"></div>
						<input id = "b" name="usrpwd" type="password" class="form-control" placeholder="Password" ><div class="br2"></div>
						<label class="checkbox">
							<input name="rmbrme" type="checkbox" value="remember-me"> Remember me<br><div class="br1"></div>
						</label>
						<a class="forgotpwd" id="modal_trigger" href="#modal"><div style="text-align:left; color:white; text-decoration: none;">Forgot Password?</div></a><br>
						
						<button class="btn_signin" type="submit" onclick="signin()">Sign in</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br>
	<div class="container">
		<a id="modal_trigger1" href="#modal1" class="btn">Create account</a>

		<!--class: popupContainer pops out when "Create new account clicked"--->
		<div id="modal" class="popupContainer1" style="display:none;">
			<header class="popupHeader">
				<span class="header_title">Having Trouble in sign-in !!</span>
				<span class="modal_close"><i class="fa fa-times"></i></span>
			</header>
			<!--main popup form that appears-->
			<section class="popupBody">
				<div class="user_register">
					<form name="signup_form" role="form" id="my_form">
						<input id= "regemail1" name="regemail1" type="email" class="regform-control" placeholder="Email address" required>
						<br />
						<div class="action_btns">
							<button class="forgot_btn" type="submit" onclick="check_userregemail()">Send Password</button>
						</div>
					</form>
				</div>
			</section>
		</div>
		<div id="modal1" class="popupContainer" style="display:none;">
			<header class="popupHeader">
				<span class="header_title">Register</span>
				<span class="modal_close"><i class="fa fa-times"></i></span>
			</header>
			<!--main popup form that appears-->
			<section class="popupBody">
				<div class="user_register">
					<form action="register.php" name="signup_form" role="form" id="my_form" method="POST" >
						<input id= "rega" name="regusrname" type="text" class="regform-control" placeholder="Username" onkeyup="check_username()" required>
                        <br/>
                        <input id= "regemail" name="regemail" type="email" class="regform-control" placeholder="Email address" required>
						<br />
						<input id = "regb" name="regusrpwd" type="password" class="regform-control" placeholder="Password" required onkeyup="check_userpwd()">
						<br />
						<input id = "regreb" name="regreusrpwd" type="password" class="regform-control" placeholder="Re-Enter Password" required onkeyup="check_userrepwd()"><div class="br2"></div>
						<br><br>
						<div class="action_btns">
							<button class="register_btn" type="submit" onclick="check_userrepwd()">Register</button>
						</div>
					</form>
				</div>
			</section>
		</div>
	</div>
        </div>	
<!--below code to show the signup_form-->
      <?php
          if(isset($_GET) && !empty($_GET['response']))
          {
              if($_GET['response']==1){
                  echo '<script language="javascript">';
                  echo 'alert("User name already taken.")'; 
                  echo '</script>';
              }
              elseif($_GET['response']==2){
                  echo '<script language="javascript">';
                  echo 'alert("Unable to connect to database.")';
                  echo '</script>';
              }
              elseif($_GET['response']==3){
                  echo '<script language="javascript">';
                  echo 'alert("Username-Password combination was incorrect.")';
                  echo '</script>';
              }
          }
      ?>
<script type="text/javascript">
	$("#modal_trigger").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
	$(function(){
		// Calling Register Form
		$("#modal_trigger").click(function(){
			$(".user_register").show();
			return false;
		});
	})
	$("#modal_trigger1").leanModal({top : 200, overlay : 0.6, closeButton: ".modal_close" });
	$(function(){
		// Calling Register Form
		$("#modal_trigger1").click(function(){
			$(".user_register").show();
			return false;
		});
	})
</script>
      	<script type="text/javascript">

           //checking validation of username and userpassword of form : signinform 
           function signin() {
               var uname = document.getElementById("a").value;
               var upwd = document.getElementById("b").value;
               if (uname == null || uname == "") {
                   document.getElementById("a").required = true;
               }
               else if (upwd == null || upwd == "") {
                   document.getElementById("b").required = true;
               }

           }
           //checking validation of username, emailid, password(both) of signup_form.
           function check_username() {
               var reguname = document.getElementById('rega').value;
               if (reguname == null || reguname == "") {
                   document.getElementById("rega").setCustomValidity('Please fill out this field') = true;
               }
               else if (!reguname.match(/^[a-zA-Z0-9_]+$/) || reguname.length < 5 || reguname > 12) {
                   document.getElementById("rega").setCustomValidity('You can only enter _ or (a-z) or (A-Z) and number of characters should be between 5-12 !!') = true;
               }
               else {
                   document.getElementById("rega").setCustomValidity('') = true;
               }
           }
           //checking validation of password of signup_form.
           function check_userpwd() {
               var regupwd = document.getElementById('regb').value;
               if (regupwd == null || regupwd == "") {
                   document.getElementById("regb").setCustomValidity('Please fill out this field') = true;
               }
               else if (regupwd.length < 8 || regupwd.length > 12) {
                   document.getElementById("regb").setCustomValidity('You password lenght should be between 8-12 !!') = true;
               }
               else {
                   document.getElementById("regb").setCustomValidity('') = true;
               }

           }
           //checking validation of both the passwords of signup_form.
           function check_userrepwd() {
               var regupwd = document.getElementById('regb').value;
               var regreupwd = document.getElementById('regreb').value;
               if (regupwd != regreupwd) {
                   document.getElementById("regreb").setCustomValidity('This does not match with your password!') = true;
                   return false;
               }
               else {
                   document.getElementById("regreb").setCustomValidity('') = true;
                   return true;
               }
           }

	</script>
 </body>
</html>
