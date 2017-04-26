<?php
/**
*@author Isaac Coffie
*@version 1.0
**/
/**
* include db credential file
*/

require_once('dbcred.php');

/**
* database connection class
*/
class Dbconnection 
{
	private $conn;
	private $result;


/*
* make connection to database
*@return true or false
*/
public function getConnection(){
$this->conn = mysqli_connect(HOST, USERNAME, PASSWORD, DBNAME);
	if (mysqli_connect_errno()) {
		return false;
		//die("Error". $conn->connect_error);
	}
	else{
		return true;
	}

}
/*
* closes connection to database
*@return null is successful
*/
public function closeConnection(){
	if($this->getConnection())
        mysqli_close($this->conn);


}

/*
* execute query
*@return true or false
*/
public function query($sql){
    if(!$this->getConnection()) {
        return false;
    }

    else{
    	$this->result = mysqli_query($this->conn, $sql);
        if(mysqli_affected_rows($this->conn) > 0){
         return true;
        }
        else{
            return false;
        }
    	
    }
}

/*
* execute prepare statement query
*@return true or false
*/
public function preparequery($sql, $type, $inputs){
    if(!$this->getConnection()) {
        return false;
    }

    else{
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($type);
        $stmt->execute();
        if ($stmt->errno) {
          return false;
        } else {
            $stmt->close();
            return true;
        }

        $this->result = mysqli_query($this->conn, $sql);
    }
}

public function fetch(){
    if ($this->result == false) {
    	return false;
    }
    else {
    return mysqli_fetch_assoc($this->result);
    }
}

public function fetchall(){
    if ($this->result == false) {
        return false;
    }
    else {
    return mysqli_fetch_all($this->result);
    }
}

public function getRow(){
    if ($this->result == false) {
        return 0;
    }
    else {
    return mysqli_num_rows($this->result);
    }
}


public function query_prepared_statement($sql, $types, $params)
    {   /*
        if(!$params){
            $stmt = $this->_conn->prepare($sql);
        }*/

        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);

        if(!$stmt->execute())
         {
           return false; 
         }
        return $stmt->get_result();
}

}

/*
$testdb = new Dbconnection;
$stmt = "insert into allmajor (majorname) values ('?')";

var_dump($testdb->query_prepared_statement($stmt, "s", "myclass"));
//var_dump($testdb->fetch());
*/
?>