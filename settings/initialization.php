<?php
session_start();
define ("URL_ROOT", "http://localhost/Classproject2017/"); 

function verifyuserlogin(){
	if(isset($_SESSION["username"]) && !empty($_SESSION["userid"])){

		// do something
		echo 'welcome '. $_SESSION["username"];
		
	}
	else{
		header("location:login/");
	}

}

function getuserpermission($index){
	if(isset($_SESSION["perid"]) && $_SESSION["perid"] == 2 ) {
			if($index == 1){
			require_once('layout/standardheader.php');
			//require_once((dirname(__FILE__)).'/../layout/adminheader.php');
			indexpage();
		}
       else if ($index == 2){	
       	require_once((dirname(__FILE__)).'/../layout/standardheader.php');	
       	//require_once((dirname(__FILE__)).'/../layout/adminheader.php');	
       	otherpages();	
	}

	}

	else if(isset($_SESSION["perid"]) && $_SESSION["perid"] == 1 ) {
		if($index == 1){
			require_once('layout/adminheader.php');
			//require_once((dirname(__FILE__)).'/../layout/adminheader.php');
			indexpage();
		}
       else if ($index == 2){	
       	require_once((dirname(__FILE__)).'/../layout/adminheader.php');	
       	//require_once((dirname(__FILE__)).'/../layout/adminheader.php');	
       	otherpages();	
	}
       }
}
?>