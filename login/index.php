<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>Class Project 2017</title>  
	<link rel="stylesheet" href="../css/bootstrap.css"> 
	<link rel="stylesheet" href="../css/loginstyle.css">
</head>

<body>
<?php require_once("../layout/header.php");
require_once("../unsecure/processunsecure.php");
 ?>
	<div class="container">  
		<form id="contact" action="" method="POST" name="Loginform" onsubmit=" return validateLogin()">
			<center><h2>Login</h2></center>

            <!--########### USERNAME #################-->
			<fieldset>
				<input placeholder="Username" type="text" name="username" id="nm"  required autofocus> 
				 <span style="color: red"> <?php if(isset($GLOBALS['loginnameError'])){ echo $GLOBALS['loginnameError']; }?></span>

				<!--javascript validation error message-->
				<span id="nameError" style="color: blue"></span>
			</fieldset>

            <!--########### PASSWORD #################-->
			<fieldset>
				<input placeholder="Password" type="password" name="password" id="pswd" required>
				<span style="color: red"> <?php if(isset($GLOBALS['loginpwordError'])){ echo $GLOBALS['loginpwordError']; }?></span>

				<!--javascript validation error message-->
				<span id="pwdError" style="color: blue"></span>
			</fieldset>
			
			<!--########### SUBMIT BUTTON #################-->
			<fieldset>
				<button name="login" type="submit" id="loginSubmit">Submit</button>
			</fieldset>
			<span style="color: red"> <?php if(isset($GLOBALS['loginError'])){ echo $GLOBALS['loginError']; }?></span>
           <center><a href="../register/register.php" class="btn btn-success">Back to Signup</a></center>
		</form>
	</div>
	<script type="text/javascript" src="../js/validation.js"></script>
</body>
</html>
