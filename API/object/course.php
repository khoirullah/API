<?php
class Course{
 
    // database connection and table name
    private $conn;
    private $table_name = "tb_syncourse";
 
    // object properties
    public $ID;
    public $courseid;
    public $status;
    public $coorporate;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function readOne(){
 
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE courseid = ? LIMIT 0,1";
     
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
     
        // bind id of product to be updated
        $stmt->bindParam(1, $this->courseid);
     
        // execute query
        $stmt->execute();
     
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        // set values to object properties
        $this->ID = $row['ID'];
        $this->courseid = $row['courseid'];
        $this->status = $row['status'];
        $this->coorporate = $row['coorporate'];
    }
}