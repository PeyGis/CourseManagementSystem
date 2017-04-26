<!DOCTYPE html>
<html>
<head>
	<title>main menu</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">

</head>
<body>
<?php 
       function indexpage(){
       	 echo '
         <div class="container1" >
	     <div class="menu" >
			<ul>
			<li><a href="pages/studentregister.php">Register</a></li>
			<li><a href="pages/manageregisteredcourses.php">Manage Registered Courses</a></li>
			<li><a href="login/logout.php">Logout</a></li>
			</ul>
	     </div>
	
	    </div><br><br>';
       } 

       function otherpages(){
       	 echo '
         <div class="container1" >
	     <div class="menu" >
			<ul>
			<li><a href="../pages/studentregister.php">Register</a></li>
			<li><a href="../pages/manageregisteredcourses.php">Manage Registered Courses</a></li>
			<li><a href="../login/logout.php">Logout</a></li>
			</ul>
	     </div>
	
	    </div><br><br>';
       } 

	?>
	<br> <br>

</body>
</html>