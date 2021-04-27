<?php
include_once "config/Database.php";
include_once "Models/User.php";

//New Database
$database = new Database();
$db = $database->connect();

// instantiate new user
$user = new User($db);

// Define variables and initialize with empty values
 $user->username = $user->password = $confirm_password = "";
$username_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    }
    else{  
            $user->username = trim($_POST["username"]);         
    }
    // Validate username
    if(empty(trim($_POST["email"]))){
        $username_err = "Please enter a valid email.";
    }
    else{  
            $user->email = trim($_POST["email"]);         
    }             

         
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    }
    elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    }
    else{
        $user->password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    }
    else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($user->password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){      
        
            $user->register();     
    }
    
  
}
define('CSSPATH', 'views/'); //define css path
$cssItem = 'style.css'; //css item to display
include "views/register.view.php";
?>