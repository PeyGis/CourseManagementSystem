<?php

//session start
session_start();

//destroy session
session_destroy();

//redirect to login
header("location:index.php");

?>