<?php  
/**
*@author Isaac Coffie
*@version 1.0
**/

//include the database class
require_once("../database/dbconnectclass.php");

class Registration extends Dbconnection{


/**
*student unregistered courses
*@param major_id major id
**/

function unregisteredcourses($major_id){
	//sql
	$sql = "SELECT ac.courseid, ac.coursecode, ac.coursename, ac.courseyear 
	FROM allcourses AS ac 
	INNER JOIN majorcourses AS mc
	 ON ac.courseid = mc.course_id 
	 WHERE mc.major_id = '$major_id' ";
	 return $this->query($sql);

}


/**
* REGISTER a COURSE
*@param userid
*@param major_id major id
*@param courses
**/
function registercourse($userid, $courseid, $majorid){
	$majorcourse = $this->getmajorcourseid($courseid, $majorid);
	$mcid = '';

	if($majorcourse){
      $mcid = $this->fetch();
      $mcid = $mcid['majorcourseid'];
	}

	$sql = "INSERT INTO usercourses (user_id, majorcourse_id, grade) 
	        VALUES ('$userid', '$mcid', '')";

	return $this->query($sql);
}

/**
* UNREGISTER a COURSE
*@param userid
*@param major_id major id
*@param courses
**/
function unregistercourse($userid, $courseid, $majorid){
	$majorcourse = $this->getmajorcourseid($courseid, $majorid);

	if($majorcourse){
      $mcid = $this->fetch();
      $mcid = $mcid['majorcourseid'];
	}

	$sql = "DELETE FROM usercourses WHERE majorcourse_id = '$mcid' AND user_id = '$userid'";
	return $this->query($sql);
}

/**
*STUDENT REGISTER COURSE
*@param major_id major id
*@param courses
**/

function getmajorcourseid($courseid, $majorid)
{
  $sql = "SELECT  majorcourseid FROM majorcourses 
  WHERE course_id = '$courseid'
   AND major_id = '$majorid'";
	return $this->query($sql);
}
/**
*STUDENT REGISTER COURSE
*@param userid
**/
function getregisteredcourse($userid){

	$sql = "SELECT uc.user_id, uc.grade, ac.courseid, ac.coursename, ac.coursecode
	 FROM usercourses AS uc
	  INNER JOIN majorcourses as mc ON uc.majorcourse_id = mc.majorcourseid
	   INNER JOIN allcourses as ac ON ac.courseid = mc.course_id
	    WHERE user_id = '$userid'";

	return $this->query($sql);
	
}

function allcourseids($userid){

	$sql = "SELECT  ac.courseid
	 FROM usercourses AS uc
	  INNER JOIN majorcourses as mc 
	  ON uc.majorcourse_id = mc.majorcourseid
	   INNER JOIN allcourses as ac 
	   ON ac.courseid = mc.course_id
	    WHERE user_id = '$userid'";

	return $this->query($sql);
	

}

function allcourses(){
	$sql = "SELECT  ac.coursename, ua.username, am.majorname
	 FROM allcourses AS ac
	  INNER JOIN majorcourses as mc 
	  ON mc.major_id IN (SELECT majorid FROM allmajor as am WHERE am.majorid IN (SELECT major_id FROM useraccount AS ua WHERE ua.userid IN (SELECT user_id FROM usercourses)))";

}

}
//$ob = new Registration;
//$ob->allcourseids(3);

?>