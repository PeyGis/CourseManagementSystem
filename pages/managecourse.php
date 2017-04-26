<!DOCTYPE html>
<html>
<head>
	<title>manage courses</title>
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
require_once(dirname(__FILE__).'/../controller/coursemanagementcontroller.php');
verifyuserlogin();
getuserpermission(2);
?>
<br><br>
<h3 class="text-success text-center">MANAGE ALL COURSES</h3>
<div class="container1">
<?php operationstatus(); ?>

<?php listallcourse(); ?>

	<div class="boxer">
    <?php 
      if(isset($_POST['editcourse']))
       {
      $courseid = htmlspecialchars($_POST['editcourse']);
      displayEditCourseDailog($courseid);
      echo "<br>";
     }
     ?>
	<legend style="color: #fff">Add New Course</legend>
	<form method="post" action="">
	<fieldset>

    <div class="form-group ">
    <label style="color: #fff">Course ID <span class="required">*</span></label>
     <input name="cid" class="form-control" type="text" disabled placeholder="course id not allowed">                          
     </div>

    <div class="form-group ">
     <label style="color: #fff">Course Name</label>
     <input name="cname" id = "cname" class="form-control" type="text" required="">
     </div>
                                
     <div class="form-group ">
     <label style="color: #fff">Course Code</label>
     <input name="ccode" id = "ccode" class="form-control" type="text" required>
     </div>

     <div class="form-group ">
     <label style="color: #fff">Course Year</label>
     <input name="cyear" id = "cyear" class="form-control" type="number" required>
     </div>

    <button type="submit" class="btn btn-success" name="addcourse">Add Course</button>
    <button type="submit" class="btn btn-danger" name="cancel" value="CANCEL">Cancel</button>
    </fieldset>
	</form>	
	</div>

	
</div>

                
    <script type="text/javascript">

        function clearcontent(){
            
            alert(document.getElementById("cname").value);
            document.getElementById("ccode").innerHTML = ' ';
            document.getElementById("cyear").innerHTML = ' ';
            
        }
    </script>        
</body>
</html>

