<?php
class User
{
    // DB params
    public $conn;
    public $table = "users";
    // User Properties
    public $id;    
    public $username;
    public $email;    
    public $password;    
    //connect with DB
    public function __construct($db){
        $this->conn = $db;
    }
    //create a new user
    public function register()
    {
       // Prepare an insert statement
       $sql = "INSERT INTO " . $this->table.
                 " SET 
                 username = :username,
                 email = :email,
                 password = :password";
         
       $stmt = $this->conn->prepare($sql);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT); // Creates a password hash           
        // Bind variables to the prepared statement as parameters
           $stmt->bindParam(":username", $this->username);
           $stmt->bindParam(":email", $this->email);
           $stmt->bindParam(":password", $this->password);         
           // Set parameters         
           // Attempt to execute the prepared statement
           if($stmt->execute()){
               // Redirect to login page
               header("location: login.php");
            }
            else{
                echo "Oops! Something went wrong. Please try again later.";
            }
    }
    //Login User
    public function login()
    {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM " .$this->table . " WHERE
         username = :username";
        
        if($stmt = $this->conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $this->username, PDO::PARAM_STR);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        $password = $_POST["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    
    }      
