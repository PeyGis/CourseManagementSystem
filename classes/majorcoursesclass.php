<?php  
/**
*@author Isaac Coffie
*@version 1.0
**/

//include the database class
require_once("../database/dbconnectclass.php");

/**
 ADMIN MAJOR COURSES FUNCTIONALITIES
*/
class MajorCourses extends Dbconnection{

//properties

/** 
*add new major function
*@param majorname major name
*@return true if successful and false otherwise
*/

function addmajorcourse($majorid, $courseid)
{
	$sql = "INSERT INTO majorcourses(major_id, course_id) VALUES( '$majorid','$courseid')";
	return $this->query($sql);
}

function deletemajorcourse($mc_id)
{
	$sql = "DELETE FROM majorcourses WHERE majorcourseid = '$mc_id'";
	return $this->query($sql);
}

function editmajorcourse($mc_id, $major_id, $course_id)
{
	$sql = "UPDATE majorcourses SET major_id = '$major_id', course_id = '$course_id' WHERE majorcourseid = '$mc_id'";
	return $this->query($sql);
}

function listAllMajors()
{
	$sql = "SELECT * FROM allmajor ORDER BY majorid ASC";
	return $this->query($sql);
}

function listAllCourses()
{
	$sql = "SELECT * FROM allcourses ORDER BY courseid ASC";
	return $this->query($sql);
}

function getMajor($major_id)
{
  $sql = "SELECT * FROM allmajor WHERE majorid = '$major_id'";
	return $this->query($sql);
}

function listallmajorcourses(){
	$sql = "SELECT mc.majorcourseid, m.majorname, c.coursename FROM allmajor AS m, allcourses as c, majorcourses as mc
            WHERE mc.major_id IN (SELECT m.majorid from allmajor) 
            AND mc.course_id IN (SELECT c.courseid from allcourses) ORDER BY mc.majorcourseid DESC";
	return $this->query($sql);
}
}