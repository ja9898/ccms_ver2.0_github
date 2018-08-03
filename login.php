<?php
include('config.php');
if(isset($_SESSION["loggedIn"]) && !isset($_SESSION["ccms"])){
		header('Location:index.php');
}
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
if(isset($_POST['login_submit'])){
$_error=CheckLogin($_POST['name'],$_POST['password']);
if($_error)
{
	header("location:index.php");
	exit;
}
}


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <title>Cloud Campus Login Page</title>
        <link rel="stylesheet" href="css/style_all.css" type="text/css" media="screen" />
        
        
        
        <!-- to choose another color scheme uncomment one of the foloowing stylesheets and wrap styl1.css into a comment -->
        <link rel="stylesheet" href="css/style1.css" type="text/css" media="screen" />
        
        
        
        
        <link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css" media="screen" />
        
        <!--Internet Explorer Trancparency fix-->
        <!--[if IE 6]>
        <script src="js/ie6pngfix.js"></script>
        <script>
          DD_belatedPNG.fix('#head, a, a span, img, .message p, .click_to_close, .ie6fix');
        </script>
        <![endif]--> 
        
        <script type='text/javascript' src='js/jquery.js'></script>
        <script type='text/javascript' src='js/jquery-ui.js'></script>
        <script type='text/javascript' src='js/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='js/custom.js'></script>
		<!--FOLLOWING SCRIPT WILL NOT ALLOW COPY PASTE PASSWORD - REFERENCE LINK IS FOLLOWING with jquery-->
		<!--http://www.sitepoint.com/forums/showthread.php?667704-Disable-copy-paste-with-php-->
			<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
			<script>
			$(document).ready(function(){ 

			$('#password').bind('paste', function(e){ 
				alert('Copy/Pasting Password is not allowed. Please type in.');
				return false;
				});

			});
			</script>
    </head>
    
    <body class="nobackground">
    	
        <div id="login">
        
        	<!--<h1 class="logo">
            	<a href="">flexy - adjustable admin skin</a>
            </h1>-->
            <h2 class="loginheading">Login</h2>
            <div class="icon_login ie6fix"></div>
                
        	<form id="login-form" action="" method="post">
            <p>
            	<label for="name">Username</label>
            	<input class="input-medium" type="text" value="" name="name" id="name"/>
        	</p>
        	<p>
            	<label for="password">Password</label>
            	<input class="input-medium" type="password" value="" name="password" id="password"/>
        	</p>
			
			
			<!--<p class="remember">
				<input type="checkbox" value="1" name="employee_login_checkbox" id="employee_login_checkbox" />
            	<label for="checkbox1" class="inline">Check the box if you are an EMPLOYEE</label>    
        	</p>-->
        
        	<!--<p class="remember">
            	<label for="checkbox1" class="inline">Remember me?</label>
            	<input type="checkbox" value="1" name="checkbox1" id="checkbox1" />
                
                
        	</p>
        	<div class="forgot_pw"><a href="index.html">Forgot password?</a></div>-->
        	<p class="clearboth">
            	<input class="button" name="login_submit" type="submit" value="Login"/>
        	</p>
            </form>
        </div>
        <?php if(isset($_error) && !$_error){ ?>
        <div class="login_message message error">
          <p>Wrong Username or password.</p>
        </div>
        <?php } ?>
    </body>
    
</html>