<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<meta charset="UTF-8"> 
	 
	<link rel="stylesheet" href="../css/bootstrap.css"> 
	<link rel="stylesheet" href="../css/loginstyle.css">
	
	
</head>


<body>
<?php require_once("../layout/header.php");
require_once("../unsecure/processunsecure.php"); ?>
    <?php //require('../settings/initialization.php');?>
	<div class="container">  
		<form id="contact" action="" method="post" name="RegisterForm" onsubmit=" return validateRegistration()">
			<center><h2>Register</h2></center>
            <!--########### USERNAME #################-->
			<fieldset>
				<input placeholder="Username" type="text" name="uname" value= "<?php if(isset($_POST["uname"]) && !empty($_POST["uname"])) echo $_POST["uname"];?>" required autofocus>	
				<span style="color: red"> <?php if(isset($GLOBALS['nameError'])){ echo $GLOBALS['nameError']; }?></span>
				<span style="color: red"> <?php if(isset($GLOBALS['nameTaken'])){ echo $GLOBALS['nameTaken']; }?></span>
				<!--javascript validation error message-->
				<span id="unameError" style="color: blue"></span>
			</fieldset>
             
             <!--########### PASSWORD #################-->
			<fieldset>
				<input placeholder="Password" type="password" name="pword" required>
				<span style="color: red"> <?php if(isset($GLOBALS['pwordError'])){ echo $GLOBALS['pwordError']; }?></span>	
				<!--javascript validation error message-->
				<span id="pwordError" style="color: blue"></span>
			</fieldset>
             
             <!--########### FIRST NAME #################-->
			<fieldset>
				<input placeholder="First name" type="text" name="fname" value= "<?php if(isset($_POST["fname"]) && !empty($_POST["fname"])) echo $_POST["fname"];?>" required>
				<span style="color: red"> <?php if(isset($GLOBALS['fnameError'])){ echo $GLOBALS['fnameError']; }?></span>
				<!--javascript validation error message-->
				<span id="fnameError" style="color: blue"></span>
			</fieldset>

			<!--########### LAST NAME #################-->
			<fieldset>
				<input placeholder="Last name" type="text" name="lname" value= "<?php if(isset($_POST["lname"]) && !empty($_POST["lname"])) echo $_POST["lname"];?>" required>
				<span style="color: red"> <?php if(isset($GLOBALS['lnameError'])){ echo $GLOBALS['lnameError']; }?></span>
				<!--javascript validation error message-->
				<span id="lnameError" style="color: blue"></span>
			</fieldset>

			<!--########### EMAIL #################-->
			<fieldset>
				<input placeholder="Email" type="email" name="email" value= "<?php if(isset($_POST["email"]) && !empty($_POST["email"])) echo $_POST["email"];?>" required>
				<span style="color: red"> <?php if(isset($GLOBALS['emailError'])){ echo $GLOBALS['emailError']; }?></span>
				<!--javascript validation error message-->
				<span id="emailError" style="color: blue"></span>
			</fieldset>

			<!--########### GENDER #################-->
			<fieldset>
				<select id="genderSelect" name="gender">
					<option value="none">Gender..</option>
					<option value="M" <?php if(isset($_POST["gender"]) && $_POST["gender"]=="M") echo "selected";?>>Male</option>
					<option value="F" <?php if(isset($_POST["gender"]) && $_POST["gender"]=="F") echo "selected";?>>Female</option>
				</select>
				 <span style="color: red"> <?php if(isset($GLOBALS['genderError'])){ echo $GLOBALS['genderError']; }?></span>
				 <span id="genderError" style="color: blue"></span>
			</fieldset>
             
             <!--########### MAJOR #################-->
			<fieldset>
				<select id="majorSelect" name="major">
					<option value="none">Major...</option>
					<!-- Load from database -->
					<?php loadMajor();?>
				</select>
				<span style="color: red"> <?php if(isset($GLOBALS['majorError'])){ echo $GLOBALS['majorError']; }?></span>
				<span id="majorError" style="color: blue"></span>
			</fieldset>
             
             <!--########### REGISTER BUTTON #################-->
			<fieldset>
				<button name="register" type="submit" id="registerSubmit" name="submit" data-submit="...Sending">Submit</button>
			</fieldset>
            <center><a href="../login" class="btn btn-success">Back to Login</a></center>
		</form>
		
	</div>
<script type="text/javascript" src="../js/validation.js"></script>
</body>
	
</html>