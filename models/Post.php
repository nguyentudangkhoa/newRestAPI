<?php
class Post
{
    private $conn;
    public $id;
    public $username;
    public $password;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function read()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    //Get Single Post
    public function read_single(){
        $sql = "SELECT * FROM users where id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->id]);
        $row = $stmt->fetch();
        //set properties
        $this->username = $row['username'];
        $this->password = $row['password'];
    }
    //create post
    public function create(){
        $sql = "INSERT INTO users SET username = ?, password = ?";
        $stmt = $this->conn->prepare($sql);
        //clean data
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        //execute
        if($stmt->execute([$this->username,$this->password])){
            return true;
        }
        //print error
        printf("Error: %s.\n",$stmt->error);
        return false;
    }
    //update
    public function update(){
        $sql = "UPDATE users SET username = ?, password = ? where id = ?";
        $stmt = $this->conn->prepare($sql);
        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        //execute
        if($stmt->execute([$this->username,$this->password,$this->id])){
            return true;
        }
        //print error
        printf("Error: %s.\n",$stmt->error);
        return false;
    }
    //delete
    public function delete(){
        $sql = "DELETE FROM users where id = ?";
        $stmt = $this->conn->prepare($sql);
        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));
        //execute
        if($stmt->execute([$this->id])){
            return true;
        }
        //print error
        printf("Error: %s.\n",$stmt->error);
        return false;
    }
}
