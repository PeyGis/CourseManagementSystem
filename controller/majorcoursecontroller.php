<?php
/**
*@author Isaac Coffie
*@version 1.0
**/

//call the class
require_once('../classes/majorcoursesclass.php');
require_once('../classes/studentregistrationclass.php');

if(isset($_SESSION)){
//get user details
	$userid = $_SESSION["userid"];
	$userid = $_SESSION["majorid"];
}
/**
*ASSIGN NEW COURSE TO A MAJOR
*/
if(isset($_POST['addmajorcourse']))
 {   $ok = true;
	if(isset($_POST["major"]) && ($_POST["major"] != "none"))
	{   
		$majorid = htmlspecialchars($_POST["major"]);
	}else {
		$ok = false;
	} 
	if(isset($_POST["course"]) && ($_POST["course"] != "none"))
	{   
		$courseid = htmlspecialchars($_POST["course"]);
	}else {
		$ok = false;
	}

	if($ok){
		addMajorCourse($majorid, $courseid);
	}
	 else {
		global $status;
		$status = 3;
	}
}


/**
*enroll a student in a course
*/
if(isset($_POST['enrolstudent']))
 {   $ok = true;
	if(isset($_POST["major"]) && ($_POST["major"] != "none"))
	{   
		$majorid = htmlspecialchars($_POST["major"]);
	}else {
		$ok = false;
	} 
	if(isset($_POST["course"]) && ($_POST["course"] != "none"))
	{   
		$courseid = htmlspecialchars($_POST["course"]);
	}else {
		$ok = false;
	}

	if(isset($_POST["studid"]) && ($_POST["studid"] != ""))
	{   
		$studentid = htmlspecialchars($_POST["studid"]);
	}else {
		$ok = false;
	}

	if($ok){
		enrolstudent($studentid, $majorid, $courseid);
	}
	 else {
		global $status;
		$status = 3;
	}
}
/**
*DELETE MAJOR COURSE
*/
if(isset($_POST['delmajorcourse']))
 {
 	$majorcourseid = htmlspecialchars($_POST['delmajorcourse']);
 	//echo $majorcourseid;
 	deleteMajorCourse($majorcourseid);
 }

function listallcourses()
{
	$course = new MajorCourses();
	$queryResult = $course->listAllCourses();
	if($queryResult)
	{
		while ($row = $course->fetch()) {
			echo '<option value = "'.$row['courseid'].'">'.$row['coursename'].'</option>';
		}
	}
}

function listallmajors()
{
	$major = new MajorCourses();
	$queryResult = $major->listAllMajors();
	if($queryResult)
	{
		while ($row = $major->fetch()) {
			echo '<option value = "'.$row['majorid'].'">'.$row['majorname'].'</option>';
		}
	}
}

function addMajorCourse($majorid, $courseid){
	global $status;
	$major = new MajorCourses();
	$queryResult = $major->addmajorcourse($majorid, $courseid);
	if($queryResult)
	{
		$status = 1;
    } else{
    	$status = 2;

    }
}

function deleteMajorCourse($mc_id){
	global $status;
	$majorcourse = new MajorCourses();
	$queryResult = $majorcourse->deletemajorcourse($mc_id);
	if($queryResult)
	{
		$status = 1;
    } else{
    	$status = 2;

    }
}

function listallmajorcourse(){
      
	//create a new instance of class
	$majorcourse = new MajorCourses();
	$queryResult = $majorcourse->listallmajorcourses();
	if($queryResult){
		echo "<table>";
		echo "<tr> <th> Major Name </th> <th> Course Name </th> <th> Action </th></tr>";
		while ($row = $majorcourse->fetch()) {
			$id = $row['majorcourseid'];
			echo "<tr><td>";
			echo $row['majorname'];
			echo "</td><td>";
			echo $row['coursename'];
			echo "</td><td>";
			echo '<form action="" method="POST" style="background-color: transparent;">';
		    echo '<input type="hidden" name="majorcourseid" value="'.$id.'">';
	        echo '<button type="submit" class="btn btn-danger" name="delmajorcourse" value="'.$id.'">Delete</button>'. ' ';
	        echo '<button type="submit" class="btn btn-primary" name="editmajorcourse" value="'.$id.'">Edit</button></form>';
			echo "</td></tr>";
		}
		echo "</table>";
	}
}

function enrolstudent($studentid, $majorid, $courseid){
	global $status;
	$regcourse = new Registration;
	$queryResult = $regcourse->registercourse($studentid, $courseid, $majorid);
	if($queryResult){
		$status = 1;
     }
     else{
     	$status = 2;
     }
}

function listallenrolledstudent(){
      
	//create a new instance of class
	$regcourse = new Registration;
	$queryResult = $regcourse->listallmajorcourses();
	if($queryResult){
		echo "<table>";
		echo "<tr> <th> Student Name </th> <th> Course Name </th> <th> Major Name </th><th> Action </th></tr>";
		while ($row = $regcourse->fetch()) {
			$id = $row['majorcourseid'];
			echo "<tr><td>";
			echo $row['majorname'];
			echo "</td><td>";
			echo $row['coursename'];
			echo "</td><td>";
			echo '<form action="" method="POST" style="background-color: transparent;">';
		    echo '<input type="hidden" name="majorcourseid" value="'.$id.'">';
	        echo '<button type="submit" class="btn btn-danger" name="delmajorcourse" value="'.$id.'">Delete</button>'. ' ';
	        echo '<button type="submit" class="btn btn-primary" name="editmajorcourse" value="'.$id.'">Edit</button></form>';
			echo "</td></tr>";
		}
		echo "</table>";
	}
}

function operationstatus()
         {
            if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 1) {
            	echo "<h3 style='color:green; background-color:#f9f9f9; margin: 15px'>Successful Operation: 1 Row Affected</h3>";	
            }
            else if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 2) {
                echo "<h3 style='color:red; background-color:#f9f9f9; margin: 15px'> Unsuccessful Operation. Try Again</h3>" ;
            }
            else if (!empty($GLOBALS['status']) && $GLOBALS['status'] == 3) {
                echo "<h3 style='color:red; background-color:#f9f9f9; margin: 15px'> Vaildation Not Successful. Please Provide the right Data</h3>" ;
            }
            
  }    
?>