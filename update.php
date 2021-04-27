<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// if($post->user_id != $_SESSION["id"] ){
//     header("location: index.php");
//     exit;
// }

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
    
$err = array('title' =>"", 'description' =>"");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $course->id = $_POST["id"];
    
    if (array_filter($err)) {
        echo "Fix error";
    } else {
            $course->update();        
            header("Location: index.php");        
    }      
}    
define('CSSPATH', 'views/'); //define css path
$cssItem = 'style.css'; //css item to display 
include "views/update.view.php";
?>