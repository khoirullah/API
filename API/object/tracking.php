<?php
class Tracking{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "rey_bp_activity";

    // table columns
    public $guid;
    public $course; 
    public $date;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
    }
    //R
    public function read(){
        $query = "SELECT 
        (SELECT 
            (SELECT `guid` FROM `tb_extuser` WHERE `user_login` = `rey_users`.`user_login`) 
        FROM `rey_users` WHERE `rey_users`.`ID` = `rey_bp_activity`.`user_id`)AS guid, 
            `type` AS status, 
            (SELECT `ID` FROM `rey_posts` WHERE `rey_posts`.`ID` = `rey_bp_activity`.`item_id`) AS course, 
            `date_recorded` AS date 
            FROM `rey_bp_activity` 
            WHERE `component` = 'course' AND 
            (SELECT `post_title` FROM `rey_posts` WHERE `rey_posts`.`ID`= `rey_bp_activity`.`item_id`) IS NOT NULL AND 
            (SELECT 
            (SELECT `guid` FROM `tb_extuser` WHERE `user_login` = `rey_users`.`user_login`) 
        FROM `rey_users` WHERE `rey_users`.`ID` = `rey_bp_activity`.`user_id`)IS NOT NULL AND
            (SELECT `post_title` FROM `rey_posts` WHERE `rey_posts`.`ID`= `rey_bp_activity`.`secondary_item_id`) IS NOT NULL AND `type` = 'start_course'";

        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){}
}