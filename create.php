<?php
include_once "config/Database.php";
include_once "Models/Course.php";

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
//New Database
$database = new Database();
$db = $database->connect();

// instantiate new post
$course = new Course($db);

//validation
$err = array('title' =>"", 'description' =>"", );
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course->user_id = $_SESSION["id"];

    if (!empty($_POST["title"])) {
        $course->title = $_POST["title"];
    } else {
        $err['title']= 'The title field is necessary';
    }
    if (!empty($_POST["description"])) {
        $course->description = $_POST["description"];
    } else {
        $err['description']= 'This field is necessary';
    }
    
    if (array_filter($err)) {
        echo "Fix error";
    } else {
        $course->create();
    }
}    
define('CSSPATH', 'views/'); //define css path
$cssItem = 'style.css'; //css item to display 
include "views/create.view.php";
  ?>
  