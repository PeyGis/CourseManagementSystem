<!DOCTYPE html>
<html>
<head>
	<title>manage major</title>
	<link href="../css/bootstrap.css" type="text/css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<style type="text/css">
		table {
    	border-collapse: collapse;
    	width: 60%;
    	float: left;
    	margin: 1%;
    	float: left;
		}

		td, th {
    	border: 0.5px solid gray;
    	text-align: center;
    	padding: 1%;
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
require_once(dirname(__FILE__).'/../controller/managemajorcontroller.php');
verifyuserlogin();
getuserpermission(2);
?>
<br><br>
<h3 class="text-success text-center">MANAGE ALL MAJORS</h3>
<div class="container1">
<?php operationstatus(); ?>

<?php listallmajor(); ?>
	<div class="boxer">
	<?php 
      if(isset($_POST['editmajor']))
       {
	  $majorId = isset($_POST["majorid"]) ? $_POST["majorid"] : 0;
      displayEditMajorDailog($majorId);
     }
	 ?>
	  <legend style="color: #fff">Add New Major</legend>
	<form method="post" action="">
	<fieldset>
    <div class="form-group ">
    <label style="color: #fff">Major ID </label>                        
     <input name="majorid" class="form-control" type="text" disabled placeholder=" major id not allowed">                          
     </div>

    <div class="form-group ">
    <label style="color: #fff">Major Name <span class="required">*</span></label>
    <input name="majorname" class="form-control" type="text">
    </div>
                                
    <button type="submit" class="btn btn-success" name="addmajor">Add Major</button>
    <button type="submit" class="btn btn-danger" name="action" value="CANCEL">Cancel</button>
    </fieldset>
	</form>	<br>

	
	</div>	
</div>

                              
</body>
</html>

