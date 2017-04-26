<!DOCTYPE html>
<html>
<head>
	<title>manage major courses</title>
	<link href="../css/bootstrap.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<style type="text/css">
		table {
    	border-collapse: collapse;
    	width: 54%;
    	float: left;
    	margin: 1%;
    	float: left;
		}

		td, th {
    	border: 0.5px solid gray;
    	text-align: center;
    	padding: 1%;
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
require_once(dirname(__FILE__).'/../controller/majorcoursecontroller.php');
verifyuserlogin();
getuserpermission(2);
?>

<br><br>
<h3 class="text-success text-center">MANAGE ALL MAJOR COURSES</h3>
<div class="container1">
<?php operationstatus(); ?>
<div class="boxer">
<div class="editbox">
	<legend style="color: #fff">Assign Courses to Majors</legend>
<form method="post" action="">
	<fieldset>
		<div class="form-group">
		<label style="color: #fff">Course Name</label>
        <select name="course" class="form-control">
        <option value="none">...select course...</option>
        	<?php listallcourses(); ?>
        </select>	
		</div>

		<div class="form-group">
		<label style="color: #fff">Assign to Major Name</label>
        <select name="major" class="form-control">
        <option value="none">...select major...</option>
        	<?php listallmajors(); ?>
        </select>	
		</div>

		<button type="submit" class="btn btn-success" name="addmajorcourse">Save</button>
       <button type="submit" class="btn btn-danger" name="cancel" value="CANCEL">Cancel</button>
	</fieldset>
</form>
</div>
</div>
<?php listallmajorcourse(); ?>
</div>
</body>
</html>
