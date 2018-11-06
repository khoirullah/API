<?php
class Completed{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "rey_bp_activity";

    // table columns
    public $courseId;
    public $courseAverageRating; 
    public $timestamp;
    public $userComment;
    public $userRating; 
    public $guid;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){
    }
    //R
    public function read(){
        $query = "SELECT (SELECT MAX(CASE WHEN rey_postmeta.meta_key = 'average_rating' THEN rey_postmeta.meta_value END) FROM rey_postmeta WHERE rey_postmeta.post_id= rey_bp_activity.item_id) AS 'courseAverageRating', `item_id` AS 'courseId', (SELECT `user_login` FROM `rey_users` WHERE `rey_users`.`ID` = `rey_bp_activity`.`user_id`) AS 'guid', `date_recorded`AS 'timestamp',`rey_comments`.`comment_content` AS 'userComment', (SELECT MAX(CASE WHEN rey_commentmeta.meta_key = 'review_rating' THEN rey_commentmeta.meta_value END) FROM rey_commentmeta WHERE rey_commentmeta.comment_id = rey_comments.comment_ID)AS 'userRating' FROM `rey_bp_activity` JOIN `rey_comments` ON `rey_comments`.`comment_post_ID` = `rey_bp_activity`.`item_id` WHERE `type` = 'submit_course'";
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