<?php
/**
*@author Isaac Coffie
*@version 1.0
**/

//call the class
require_once('../classes/managemajorclass.php');

if(isset($_SESSION["majorid"]) && isset($_SESSION["userid"])){
//get user details
	$userid = $_SESSION["userid"];
	$majorid = $_SESSION["majorid"];
}
/**
*ADD NEW MAJOR
*/
if(isset($_POST['addmajor']))
 {
	if(isset($_POST["majorname"]) && !empty($_POST["majorname"]))
	{
		addNewMajor(htmlspecialchars($_POST["majorname"]));
	} else {
		global $status;
		$status = 3;
	}
}
/**
*DELETE MAJOR
*/
if(isset($_POST['delmajor']))
 {
	$majorId = isset($_POST["majorid"]) ? $_POST["majorid"] : 0;
    deleteMajor($majorId);
}

/**
*EDIT MAJOR
*/
if(isset($_POST['editmajor']))
 {
 	$majorid = htmlspecialchars($_POST['editmajor']);
	if(isset($_POST["newmajorname"]) && !empty($_POST["newmajorname"]))
	{
		$newmajorname = htmlspecialchars($_POST["newmajorname"]);
		editMajor($majorid, $newmajorname);
	}    
}



function addNewMajor($majorname){
	global $status; // holds status of an operation, success or not
      
	//create a new instance of class
	$major = new ManageMajor;
	$queryResult = $major->addmajor($majorname);
	if($queryResult){
		$status = 1;
    } else{
    	$status = 2;
    }
}

function deleteMajor($majorid){
     global $status; // holds status of an operation, success or not
	//create a new instance of class
	$major = new ManageMajor;
	$queryResult = $major->deletemajor($majorid);
	if($queryResult){
		$status = 1;
    } else{
    	$status = 2;
    }
}

function editMajor($majorid, $newmajorname){
	global $status; // holds status of an operation, success or not
	$major = new ManageMajor;
	$queryResult = $major->editmajor($majorid, $newmajorname);
	if($queryResult)
	{
       $status = 1;
	}else{
    	$status = 2;
    }
}

function listallmajor(){
      
	//create a new instance of class
	$allmajor = new ManageMajor;
	$queryResult = $allmajor->listAllMajor();
	if($queryResult){
		echo "<table>";
		echo "<tr> <th> Major ID </th> <th> Major Name </th><th> Action </th></tr>";
		while ($row = $allmajor->fetch()) {
			$id = $row['majorid'];
			$name = $row['majorname'];
			echo "<tr><td>";
			echo $id;
			echo "</td><td>";
			echo $name;
			echo "</td><td>";
			echo '<form action="" method="POST" style="background-color: transparent;">';
		    echo '<input type="hidden" name="majorid" value="'.$id.'">';
		    echo '<input type="hidden" name="majorname" value="'.$name.'">';
	        echo '<button type="submit" class="btn btn-danger" name="delmajor" value="'.$id.'">Delete</button>'. ' ';
	        echo '<button type="submit" class="btn btn-primary" name="editmajor" value="'.$id.'">Edit</button></form>';
			echo "</td></tr>";
			
		}
		echo "</table>";
	}
}

function displayEditMajorDailog($majorid){
	$major = new ManageMajor;
	$queryResult = $major->getMajor($majorid);
	if($queryResult)
	{
		$majordetails = $major->fetch(); 
		echo '
         <div class="editbox">
	  <legend style="color: #fff">Edit Major</legend>
	<form method="post" action="">
	<fieldset>
    <div class="form-group ">
    <label style="color: #fff">Major ID</label>   
    <input name="majorid" class="form-control" type="text" disabled value ="'.$majordetails["majorid"].'" >                          
     </div>

    <div class="form-group ">
    <label style="color: #fff">Major Name</label>
    <input name="newmajorname" class="form-control" type="text" value ="'.$majordetails["majorname"].'" required autofocus>
    </div>
                                
    <button type="submit" class="btn btn-success" name="editmajor" value ="'.$majordetails["majorid"].'">Save Update</button>
    <button type="submit" class="btn btn-danger" value="CANCEL">Cancel</button>
    </fieldset>
	</form>	
	</div> <br>
		';

	}	
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

?>