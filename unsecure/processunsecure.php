<?php 
         /*
          name: isaac coffie
          web tech project
          date: april 4, 2017
         */
         // include database connection class
        include("../database/dbconnectclass.php");
      
        /*
          if login button is clicked, call the validlogin function
          */
        if (isset($_POST['login'])) {
           validlogin();     
        }

         /*
          if register button is clicked, call the validregister function
          */
        else if (isset($_POST['register'])) {
            validregister();

        }


         /*
          a function to load all majors from database
          */
        function loadMajor() {
            $loadmajor = new Dbconnection;
            $statement = "SELECT * FROM allmajor ORDER BY majorname ASC";
            $allmajor = $loadmajor->query($statement);

            if($allmajor){

                while ($value = $loadmajor->fetch()) {
                    echo '<option value ='.$value['majorid'].'>'. $value['majorname']. '</option>';
                }
            }

        }

        /*
          a function to validate user inputs
          */
         function validlogin(){
            
            $name; $pword;
            $ok = true;
            if (!isset($_POST['username']) || $_POST['username'] === '') {
                $GLOBALS['loginnameError'] = "username is empty";
                $ok = false; 
            } else {
                $name = $_POST['username'];
            }

            if (!isset($_POST['password']) || $_POST['password'] === '') {
                $GLOBALS['loginpwordError'] = "password is empty";
                $ok = false;
            } else {
                $pword = $_POST['password'];
            }
              // if all is okay
            if($ok){
             verifylogin($name, $pword); 
            }


         }
          
          /*
          a function to verify that login details of a user is okay to login
          */
        function verifylogin($name, $pword){
            $userdb = new Dbconnection;
            $sql = "SELECT * FROM useraccount WHERE username = '$name'";
            $dbexecute =  $userdb->query($sql);

            if($dbexecute){
                $record = $userdb->fetch();
                if(password_verify($pword, $record['pwd'])){
                    //assign user details to session
                    session_start();
                         $_SESSION['username'] = $record['username'];
                         $_SESSION['userid'] = $record['userid'];
                         $_SESSION['perid'] = $record['per_id'];
                         $_SESSION['majorid'] = $record['major_id'];                                        
                    header("location:../index.php"); 
                }
                else{
                    $GLOBALS['loginError'] = "passowrd or username invalid";
                echo "<center><h3 style='color:red'>Login unsuccessful "."</h3></center>" ;
                }
            }

        }
          
          /*
          a function to validate user inputs
          */
        function validregister() {
               
                 $name; $pword; $gender; $fname; $lname; $major; $email;
                $ok = true;

                //validate username
                if (isset($_POST['uname']) && !empty($_POST["uname"])) {
                    if((1 === preg_match('~[0-9]~', $_POST["uname"])) ||
                     (1 === preg_match('~[^A-Za-z0-9]~', $_POST["uname"]))){                        
                     
                       $GLOBALS['nameError'] = "name must not contain numbers or symbols";
                    
                       $ok = false;
                    }
                    else {
                    $name = $_POST['uname'];                   
                    
                     }
                } 
                else{
                   $ok = false; 
                }
                
                
                //validate gender
                if (isset($_POST['gender']) && !empty($_POST["gender"])) {
                    if($_POST["gender"] == "none"){
                     
                     $GLOBALS['genderError'] = "Kindly select gender";
                     $ok = false;
                    }
                    else {
                    $gender = $_POST['gender'];
                     }
                } 
                else{
                   $ok = false; 
                }

                //validate password
                if (isset($_POST['pword']) && !empty($_POST["pword"])) {
                    if (!preg_match("/^(?=.*\d)(?=.*\W)(?=.*[A-Z]).{6,16}$/", $_POST['pword'])){
                     $GLOBALS['pwordError'] = "Must contain at least one upper case, symbol,number and more than 6 characters";
                     $ok = false;
                    }
                    else {
                    $pword = $_POST['pword'];
                     }
                } 
                else{
                   $ok = false; 
                }

                //validate first name
                if (isset($_POST['fname']) && !empty($_POST["fname"])) {
                    if(1 === preg_match('~[0-9]~', $_POST["fname"]) || 
                        1 === preg_match('~[^A-Za-z0-9]~', $_POST["fname"])){
                     
                      $GLOBALS['fnameError'] = "fname must not contain numbers or symbols";
                    }
                    else {
                    $fname = $_POST['fname'];
                     }
                } 
                else{
                   $ok = false; 
                }

                //validate last name
                if (isset($_POST['lname']) && !empty($_POST["lname"])) {
                    if(1 === preg_match('~[0-9]~', $_POST["lname"]) || 
                        1 === preg_match('~[^A-Za-z0-9]~', $_POST["lname"])){
                    
                      $GLOBALS['lnameError'] = "name must not contain numbers or symbols";
                     $ok = false;
                    }
                    else {
                    $lname = $_POST['lname'];
                     }
                } 
                else{
                   $ok = false; 
                }
                   

                //validate email
                if (isset($_POST['email']) && !empty($_POST["email"])) {
                    if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $_POST['email'])){
                     $GLOBALS['emailError'] = "invalid email";
                     $ok = false;
                    }
                    else {
                    $email = $_POST['email'];
                     }
                } 
                else{
                   $ok = false; 
                }

                //validate major
                if (isset($_POST['major']) && !empty($_POST["major"])) {
                    if($_POST["major"] == "none"){
                     
                      $GLOBALS['majorError'] = "Kindly select major";
                     $ok = false;
                    }
                    else {
                    $major = $_POST['major'];
                     }
                } 
                else{
                   $ok = false; 
                }
                
                //if all validations has been checked
                if ($ok) {
                    // check if username exists in database
                    if(checkusername($name) == false) {
                        //finally add new user
                   addNewUser($name, $pword, $fname, $lname, $email, $gender, $major);
                     }
                 }
           
        }
         
         /*
          a function to add new user into user account table
         */
        function addNewUser($name, $pword, $fname, $lname, $email, $gender, $major){
             
             //create an instance of DB connection        
            $useraccount = new Dbconnection;
            //hash password for security purpose
            $pword = password_hash($pword, PASSWORD_DEFAULT);
            //write query statement
            $queryStatement = "INSERT INTO useraccount (username, pwd, fname, lname, email, gender, major_id, userstatus, per_id) VALUES ('$name', '$pword', '$fname', '$lname', '$email', '$gender', '$major', 'ACTIVE',2)";
            // execute query
            $useraccount = $useraccount->query($queryStatement);
             
             //if query was successful
            if($useraccount){
                echo "<center><h3 style='color:green'>Insertion Successful "."</h3></center>" ;
                header("location:../login/");
            }
            // if query wasnt successful
            else {
                 echo "<center><h3 style='color:red'> Insertion Unsuccessful ". "</h3></center>" ;
            }
       }

        /*
          a function to validate username
          it checks if username exists in database
          it returns true if yes and false otherwise
         */
       function checkusername($name){
            $success = false;  
            $userdb = new Dbconnection; 
            $queryStatement = "SELECT * FROM useraccount"; 
            $alluseraccount = $userdb->query($queryStatement);

            if($alluseraccount){
                    while ($value = $userdb->fetch()) {
                        if($value['username'] == $name){
                           $success = true;                      
                          $GLOBALS['nameTaken'] = "username already exist";     
                        }                            
                    }
            }            
             return $success;
       }

    

 ?>
