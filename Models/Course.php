<?php
class Course
{
    // DB params
    private $conn;
    private $table = "courses";
    // Course Properties
    public $id;
    public $user_id;    
    public $title;
    public $description;    
    //connect with DB
    public function __construct($db){
        $this->conn = $db;
    }
    //function to create Course
    public function create(){
        #query statement
        $query ="INSERT INTO ". $this->table. "
            SET 
                user_id = :user_id,
                title = :title,                
                description = :description";                
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));        
        //bind data
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);        
        //execute query
        if ($stmt->execute()) {
            header("Location: index.php");
        } 
    }
    // function to read all Courses
    public function read()
    {
       $query ="SELECT                 
                *             
                FROM
                ".$this->table." 
                ORDER BY
                id DESC";
        //prepare statement
        $stmt =$this->conn->prepare($query);
        $stmt->execute();
        return $stmt;         
    }
    //function to read single Course
    public function single()
    {
        $query ="SELECT 
                c.id,
                c.title,
                c.description,                
                c.user_id                
                FROM
                ".$this->table." c                
                WHERE c.id = ?
                LIMIT 0,1";
        //prepare statement
        $stmt =$this->conn->prepare($query);
        //bind id
        $stmt->bindParam(1, $this->id);
        //excute
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set properties
        $this->title = $row["title"];
        $this->description = $row["description"];
        $this->user_id = $row["user_id"];       
        
    } 
    // function to update Course    
    public function update(){
        #query statement
        $query ="UPDATE ". $this->table. "
            SET 
                title = :title,
                description = :description                
            WHERE
                id = :id";
                
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));        
        //bind data
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description); 
        $stmt->bindParam(":id", $this->id);       
        //execute query
        if ($stmt->execute()) {
            return true;
        }
    } 
      //function to delete course
      public function delete(){
        //build query
        $query = "DELETE FROM ". $this->table. " WHERE id=:id";
        //prepare statement
        $stmt = $this->conn->prepare($query);
        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        //bind params
        $stmt->bindparam(":id", $this->id);
        //execute query
        if ($stmt->execute()) {
            return true;
        }        
    }                     
}    