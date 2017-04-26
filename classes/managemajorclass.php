<?php  
/**
*@author Isaac Coffie
*@version 1.0
**/

//include the database class
require_once("../database/dbconnectclass.php");

/**
 ADMIN MAJOR FUNCTIONALITIES
*/
class ManageMajor extends Dbconnection{

//properties

/** 
*add new major function
*@param majorname major name
*@return true if successful and false otherwise
*/

function addmajor($majorname)
{
	$sql = "INSERT INTO allmajor(majorname) VALUES( '$majorname')";
	return $this->query($sql);
}

function deletemajor($major_id)
{
	$sql = "DELETE FROM allmajor WHERE majorid = '$major_id'";
	return $this->query($sql);
}

function editmajor($major_id, $major_name)
{
	$sql = "UPDATE allmajor SET majorname = '$major_name' WHERE majorid = '$major_id'";
	return $this->query($sql);
}

function listAllMajor()
{
	$sql = "SELECT * FROM allmajor ORDER BY majorid desc";
	return $this->query($sql);
}

function getMajor($major_id)
{
  $sql = "SELECT * FROM allmajor WHERE majorid = '$major_id'";
	return $this->query($sql);
}
}