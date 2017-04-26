<!DOCTYPE html>
<html>
<head>
	<title>student register courses</title>
	<link href="../css/bootstrap.css" type="text/css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="../css/style.css">
			<style type="text/css">
		table {
    	border-collapse: collapse;
    	width: 75%;
    	margin: 2% auto;
		}

		td, th {
    	border: 0.5px solid gray;
    	text-align: center;
    	padding: 1.5%;
    	word-wrap:break-word;
		}
		th{
			background-color: #fff;
			color: #141E30;
		}
		form{
			background-color: transparent;
		}

	</style>
</head>
<body>
<?php require_once(dirname(__FILE__).'/../settings/initialization.php');
require_once(dirname(__FILE__).'/../controller/studentregistrationcontroller.php');
verifyuserlogin();
getuserpermission(2);
?>
<br><br>
<h3 class="text-success text-center">REGISTER YOUR COURSES</h3>
<div class="container1">
<?php operationstatus(); ?>
<?php listunregisteredcourse();?>
</div>
	
</body>
</html>