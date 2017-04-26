<?php
/**
*@author Isaac Coffie
*@version 1.0
**/


//call the class
require_once('../classes/studentregistrationclass.php');

if(isset($_SESSION)){
//get user details
	$userid = $_SESSION["userid"];
	$majorid = $_SESSION["majorid"];
}

// if user clicks register button
if(isset($_POST['register'])) {
	$courseId = isset($_POST["courseid"]) ? $_POST["courseid"] : 0;
    $coursename = isset($_POST["coursename"]) ? $_POST["coursename"] : "none";
    registercourse($courseId);
}

// if user clicks unregister button
if(isset($_POST['unregister'])) {
	$courseId = isset($_POST["courseid"]) ? $_POST["courseid"] : 0;
    $coursename = isset($_POST["coursename"]) ? $_POST["coursename"] : "none";
    unregistercourse($courseId);
}

// list all unregistered
function listunregisteredcourse(){
      global $majorid;
      global $userid;
      $allcourseids = array();
	//create a new instance of class
	$unregisteredList = new Registration;

	$result = $unregisteredList->allcourseids($userid);
	if($result){
		while ($value = $unregisteredList->fetch()) {
			$allcourseids[] = $value['courseid'];
		}
	}

	$queryResult = $unregisteredList->unregisteredcourses($majorid);

	if($queryResult){
		
		echo "<table>";
		echo "<tr> <th> Course Code </th> <th> Course Name </th> <th> Action </th></tr>";
		while ($row = $unregisteredList->fetch()){
			if (!in_array($row['courseid'], $allcourseids)){
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
			
		}
	}     
		echo "</table>";
	}
}

// register a student from a course
function registercourse($courseid){
	global $status;
	global $userid;
	global $majorid;

    $regcourse = new Registration;
	$queryResult = $regcourse->registercourse($userid, $courseid, $majorid);
	if($queryResult){
		$status = 1;
     }
     else{
     	$status = 2;
     }
}

// unregister a student from a course
function unregistercourse($courseid){
	global $status;
	global $userid;
	global $majorid;

    $regcourse = new Registration;
	$queryResult = $regcourse->unregistercourse($userid, $courseid, $majorid);
	if($queryResult){
		$status = 1;
     }
     else{
     	$status = 2;
     }
}


function fetchcourse($courseId)
{    
	$course = new Registration;
	$queryResult = $course->getcourse($courseId);
	if($queryResult){
		return $course->fetch();
     }
     else{
     	return null;
     }
}

// operation success or error message
function operationstatus()
  {
            if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 1) {
            	echo "<center><h3 style='color:green; background-color:#f9f9f9; margin: 15px'>Successfully Registered ".$GLOBALS['coursename']."</h3></center>";	
            }
            else if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 2) {
                echo "<center><h3 style='color:red; background-color:#f9f9f9; margin: 15px'> Unsuccessful Registration for ".$GLOBALS['coursename']." Try Again</h3></center>" ;
 }
      
            
}

// list all registered
function listregisteredcourse(){
      global $userid;
	//create a new instance of class
	$registeredList = new Registration;
	$queryResult = $registeredList->getregisteredcourse($userid);
	if($queryResult){
		echo "<table>";
		echo "<tr> <th> Course Code </th> <th> Course Name </th> <th> Grade </th> <th> Action </th></tr>";
		while ($row = $registeredList->fetch()) {
			$cid = $row['courseid'];
			echo "<tr><td>";
			echo $row['coursecode'];
			echo "</td><td>";
			echo $row['coursename'];
			echo "</td><td>";
			$grade = $row['grade'];
			if($grade != null){
				echo $grade;
			    echo '</td><td>
			      <button type="button" class="btn btn-danger" disabled>Not Allowed</button>
			     </td></tr>';
			}
			else {
				echo 'Not Graded yet';
				echo '</td><td>
				<form action="" method="POST" style="background-color: transparent;">
				<input type="hidden" name="courseid" value="'.$cid.'">
				<input type="hidden" name="coursename" value="'.$row['coursename'].'">
				<button type="submit" class="btn btn-danger" name="unregister" value="'.$cid.'">Unregister</button>
				</form>
				</td></tr>';
 
			}
		}
		echo "</table>";
	}
}
	 
?>