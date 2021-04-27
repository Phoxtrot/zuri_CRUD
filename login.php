<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
include_once "config/Database.php";
include_once "Models/User.php";

//New Database
$database = new Database();
$db = $database->connect();
// instantiate new user
$user = new User($db);

// Define variables and initialize with empty values
$user->username = $user->password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $user->username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $user->password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        $user->login();
    }
  }
define('CSSPATH', 'views/'); //define css path
$cssItem = 'style.css'; //css item to display 
include "views/login.view.php";
  ?>
  