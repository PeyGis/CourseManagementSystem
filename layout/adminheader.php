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
			<li><a href="pages/registerstudent.php">Register Student</a></li>
			<li><a href="pages/managecourse.php">Manage Courses</a></li>
			<li><a href="pages/managemajor.php">Manage Major</a></li>
			<li><a href="pages/majorcourses.php">Major Courses</a></li>
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
			<li><a href="../pages/registerstudent.php">Register Student</a></li>
			<li><a href="../pages/managecourse.php">Manage Courses</a></li>
			<li><a href="../pages/managemajor.php">Manage Major</a></li>
			<li><a href="../pages/majorcourses.php">Major Courses</a></li>
			<li><a href="../login/logout.php">Logout</a></li>
			</ul>
	</div>
	
	</div> <br><br>';
       } 
      
       ?>  

</body>
</html>