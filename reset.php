<?php
// Initialize the session
session_start();
if (isset($_POST['submit'])) {
    $errorname = $errormessage= $errorpassword= $errorconfirmpassword="";
    $username  = $password= $confirmpassword= "" ;
    //validate username
    if(strlen(trim($_POST["username"]))<6){
        $errorname = "Username should be atleast 6 characters ";
    }
    else{
        $username = trim($_POST["username"]);        
    }
    //validate password
    if(strlen(trim($_POST["password"]))<6){
        $errorpassword = "Password should be atleast 6 characters ";
    }
    else {
        $password = trim($_POST["password"]);
    }
    //validate confirm password    
    if((trim($_POST["confirm_password"]))!= trim($_POST["password"])){
        $errorpassword = "Password does not match";
        $errorconfirmpassword = "Password does not match";
    }
    else {
        $confirmpassword = $_POST["confirm_password"];
    }
    if (empty($errorname) && empty($errorpassword) && empty($errorconfirmpassword)) {
        if(file_exists('database/'.$username.'.json')){
            $userdata = json_decode(file_get_contents('database/'.$username.'.json'));
            $userdata->password = $password;
            file_put_contents('database/'.$userdata->name.'.json', json_encode($userdata));
            header("location: login.php");            
          }
          else{
            $errormessage = 'Sorry this user does not exist. Please register ';
          } 
    }
     
   
}

//include views
define('CSSPATH', 'views/'); //define css path
$cssItem = 'style.css'; //css item to display
include "views/reset.view.php";
?>