<?php
class Database
{
    //Database parameters
    private $host = "localhost";
    private $dbname = "crud";
    private $user = "root";
    private $password = "";
    private $conn; 

    //function to connect to database using PDO
    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,
             $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (PDOException $e) {
            echo "Connection unsucessful". $e->getmessage();
        }
        return $this->conn;
    }

}