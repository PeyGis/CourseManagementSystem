<?php  
/**
*@author Isaac Coffie
*@version 1.0
**/

//include the database class
require_once("../database/dbconnectclass.php");

class ManageCourses extends Dbconnection{

//properties

/**
*@param userid
*@param majorid
*@param courses
**/

//student unregistered courses

function unregisteredcourses(){
	//sql
	$sql = "SELECT * FROM allcourses";
	return $this->query($sql);
}

function allcourses(){
	//sql
	$sql = "SELECT * FROM allcourses ORDER BY courseid DESC";
	return $this->query($sql);
}
// unregistered courses under major
//course registration
//delete user course registration
//course registered id

/**
 STUDENT REGISTER COURSE
*/
function registercourse($id){
	$sql = "DELETE FROM allcourses WHERE courseid ='$id' ";
	return $this->query($sql);

}

/**
 ADMIN MANAGE COURSE FUNCTIONALITIES
*/
 function addcourses($coursecode, $coursename, $courseyear){
	$sql = "INSERT INTO allcourses(coursecode, coursename, courseyear) VALUES('$coursecode', '$coursename','$courseyear')";
	return $this->query($sql);

}

function deletecourse($id){
	$sql = "DELETE FROM allcourses WHERE courseid ='$id' ";
	return $this->query($sql);

}

function getcourse($course_id)
{
  $sql = "SELECT * FROM allcourses WHERE courseid = '$course_id'";
	return $this->query($sql);
}

function editcourse($course_id, $course_code, $course_name, $course_year)
{
	$sql = "UPDATE allcourses SET coursename = '$course_name', coursecode ='$course_code', courseyear = '$course_year'  WHERE courseid = '$course_id'";
	return $this->query($sql);
}

}



?>