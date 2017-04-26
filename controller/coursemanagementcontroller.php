<?php
/**
*@author Isaac Coffie
*@version 1.0
**/

//call the class
require_once('../classes/coursemanagementclass.php');

if(isset($_SESSION)){
//get user details
	$userid = $_SESSION["userid"];
	$userid = $_SESSION["majorid"];
}

if(isset($_POST['register'])) {
	$courseId = isset($_POST["courseid"]) ? $_POST["courseid"] : 0;
    $coursename = isset($_POST["coursename"]) ? $_POST["coursename"] : "none";
    echo $courseId . " ".  $coursename. " ";
    //registercourse($courseId, $coursename);
}

if(isset($_POST['delcourse'])) {
	$courseId = isset($_POST["courseid"]) ? $_POST["courseid"] : 0;
    deletecourse($courseId);
}



if(isset($_POST['addcourse'])){
	if(validregister()){
    $ccode = $GLOBALS["ccode"];
	$cname = $GLOBALS["cname"];
	$cyear = $GLOBALS["cyear"]; 
	addNewCourse($ccode,$cname,$cyear);
	} else{
		global $status;
		$status = 3;
	}
}


if(isset($_POST['updatecourse'])){
	if(validregister()){
    $ccode = $GLOBALS["ccode"];
	$cname = $GLOBALS["cname"];
	$cyear = $GLOBALS["cyear"]; 
	$cid = htmlspecialchars($_POST['updatecourse']);
	editCourse($cid, $ccode, $cname, $cyear);
	} else{
		global $status;
		$status = 3;
	}
}
if(isset($_POST['cancel'])) {
	clear();
}
function listunregisteredcourse(){
      
	//create a new instance of class
	$unregisteredList = new ManageCourses;
	$queryResult = $unregisteredList->unregisteredcourses();
	if($queryResult){
		echo "<table>";
		echo "<tr> <th> Course Code </th> <th> Course Name </th> <th> Action </th></tr>";
		while ($row = $unregisteredList->fetch()) {
			$id = $row['courseid'];
			echo "<tr><td>";
			echo $row['coursecode'];
			echo "</td><td>";
			echo $row['coursename'];
			echo "</td><td>";
			echo '<form action="" method="POST" style="background-color: transparent;">';
		    echo '<input type="hidden" name="courseid" value="'.$row['courseid'].'">';
		    echo '<input type="hidden" name="coursename" value="'.$row['coursename'].'">';
		    echo '<input type="hidden" name="coursecode" value="'.$row['coursecode'].'">';
	        echo '<button type="submit" class="btn btn-success" name="register" value="'.$id.'">Register</button></form>';
			echo "</td></tr>";
			//echo '<input type="checkbox" name="username" value="'.$row["courseid"].'">'. $row["coursename"].' <br>';
		}
		echo "</table>";
	}
}

function registercourse($cid, $cname){
	global $status;
	global $coursename;
	$coursename = $cname;

    $regcourse = new ManageCourses;
	$queryResult = $regcourse->registercourse(0);
	if($queryResult){
		$status = 1;
     }
     else{
     	$status = 2;
     }
}

function addNewCourse($code, $name, $year){
	global $status;
      
	//create a new instance of class
	$admin = new ManageCourses;
	$queryResult = $admin->addcourses($code, $name, $year);
	if($queryResult){
		$status = 1;
    } else{
    	$status = 2;
    }
}


function deletecourse($courseId){
	global $status;
	
    $course = new ManageCourses;
	$queryResult = $course->deletecourse($courseId);
	if($queryResult){
		$status = 1;
     }
     else{
     	$status = 2;
     }
}

function editCourse($id, $code, $name, $year)
{
	global $status;
	
    $course = new ManageCourses;
	$queryResult = $course->editcourse($id, $code, $name, $year);
	if($queryResult){
		$status = 1;
     }
     else{
     	$status = 2;
     }

}

function fetchcourse($courseId)
{    
	$course = new ManageCourses;
	$queryResult = $course->getcourse($courseId);
	if($queryResult){
		return $course->fetch();
     }
     else{
     	return null;
     }
}

/**
          *a function to validate user inputs
          *@return true if form was validated and false otherwise
          */
 function validregister(){
    global $cname; global $ccode; global $cyear; 
     $ok = true;
     if (isset($_POST['cname']) && !empty($_POST["cname"])) {
     	$cname = $_POST['cname'];
      } else{
      	  $ok = false;
      }
      if (isset($_POST['ccode']) && !empty($_POST["ccode"])) {
     	$ccode = $_POST['ccode'];
      } else{
      	  $ok = false;
      }
      if (isset($_POST['cyear']) && !empty($_POST["cyear"])) {
     	$cyear = $_POST['cyear'];
      } else{
      	  $ok = false;
      }
    return $ok;                
}

function clear(){
	$_POST['cname'] = "";
	$_POST['ccode'] = "";
	$_POST['cyear'] = "";

}

function operationstatus()
         {
            if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 1) {
            	echo "<h3 style='color:green; background-color:#f9f9f9; margin: 15px'> 1 Row Successfully Affected</h3>";	
            }
            else if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 2) {
                echo "<h3 style='color:red; background-color:#f9f9f9; margin: 15px'> Unsuccessful Operation. Try Again</h3>" ;
            }
            else if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 3) {
                echo "<h3 style='color:red; background-color:#f9f9f9; margin: 15px'> Vaildation Not Successful. Please Provide the right Data</h3>" ;
            }
            
         }

function displayEditCourseDailog($courseId){
	$course = new ManageCourses;
	$queryResult = $course->getcourse($courseId);
	if($queryResult){
		$coursedetails = $course->fetch();
		echo '
         	<div class="editbox">
	<legend style="color: #fff">Edit Course</legend>
	<form method="post" action="">
	<fieldset>

    <div class="form-group ">
    <label style="color: #fff">Course ID</label>
     <input name="cid" class="form-control" type="text" disabled value ="'.$coursedetails["courseid"].'" >                          
     </div>

    <div class="form-group ">
     <label style="color: #fff">Course Name</label>
     <input name="cname" class="form-control" type="text" value ="'.$coursedetails["coursename"].'" required autofocus>
     </div>
                                
     <div class="form-group ">
     <label style="color: #fff">Course Code</label>
     <input name="ccode" class="form-control" type="text" value ="'.$coursedetails["coursecode"].'" required>
     </div>

     <div class="form-group ">
     <label style="color: #fff">Course Year</label>
     <input name="cyear" class="form-control" type="number" value ="'.$coursedetails["courseyear"].'" required >
     </div>

    <button type="submit" class="btn btn-success" name="updatecourse" value ="'.$coursedetails["courseid"].'" >Save Update</button>
    <button type="submit" class="btn btn-danger" name="" value="CANCEL">Cancel</button>
    </fieldset>
	</form>	
	</div> <br><br> <br>
		';

	}	
}



  function listallcourse(){
      
	//create a new instance of class
	$unregisteredList = new ManageCourses;
	$queryResult = $unregisteredList->allcourses();
	if($queryResult){
		echo "<table>";
		echo "<tr> <th> Course Code </th> <th> Course Name </th> <th> Course Year </th><th> Action </th></tr>";
		while ($row = $unregisteredList->fetch()) {
			$id = $row['courseid'];
			echo "<tr><td>";
			echo $row['coursecode'];
			echo "</td><td>";
			echo $row['coursename'];
			echo "</td><td>";
			echo $row['courseyear'];
			echo "</td><td>";
			echo '<form action="" method="POST" style="background-color: transparent;">';
		    echo '<input type="hidden" name="courseid" value="'.$row['courseid'].'">';
		    echo '<input type="hidden" name="coursename" value="'.$row['coursename'].'">';
	        echo '<button type="submit" class="btn btn-danger" name="delcourse" value="'.$row['courseid'].'">Delete</button>'. ' ';
	        echo '<button type="submit" class="btn btn-primary" name="editcourse" value="'.$row['courseid'].'">Edit</button></form>';
			echo "</td></tr>";
			//echo '<input type="checkbox" name="username" value="'.$row["courseid"].'">'. $row["coursename"].' <br>';
		}
		echo "</table>";
	}
}


	 
?>