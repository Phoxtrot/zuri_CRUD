<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
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
if (isset($_GET["id"])) {    
    $course->id =$_GET["id"];   
    $course->single(); 
}
 if($course->user_id != $_SESSION["id"] ){
     header("location: index.php");     
 }
 else{
    if (isset($_GET["id"])) {    
        $course->id = $_GET["id"];
        $course->delete();
        header("Location: index.php"); 
    }
 }


