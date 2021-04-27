<?php
session_start();
//include views
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
include_once "config/Database.php";
include_once "Models/Course.php";

//New Database
$database = new Database();
$db = $database->connect();

// instantiate new post
$course = new Course($db);

//read all post
$result = $course->read();
//get row count
$row = $result->rowCount();
//fetch data
if ($row>0) {
    //load index views    
    include "views/index.view.php";          
    
} else {
    include "views/index2.view.php";
}


define('CSSPATH', 'views/'); //define css path
$cssItem = 'style.css'; //css item to display

?>