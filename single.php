<?php
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
//get ID
$course->id = isset($_GET["id"]) ? $_GET["id"]:die();
//read the course with that particular id
$course->single();

$id = $course->id;
$user_id = $course->user_id;
$title = $course->title;
$description = $course->description;
define('CSSPATH', 'views/'); //define css path
$cssItem = 'style.css'; //css item to display 
include "views/single.view.php";
  ?>