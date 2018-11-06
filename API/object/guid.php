<?php
class Payment{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "rey_woocomerce_order_items";

    // table columns
    public $courseid;
    public $course_name;
    public $course_price;
    public $paid_status;
    public $guid;
    public $paid_date;

    public function __construct($connection){
        $this->connection = $connection;
    }

    //C
    public function create(){  }
    //R
    public function read(){
        $query = "SELECT 
        (SELECT ID FROM `rey_posts` WHERE `post_title` = `rey_woocommerce_order_items`.`order_item_name` AND `post_type` = 'course') AS courseid,
        `order_item_name`AS 'course_name', 
                (SELECT `post_status` FROM `rey_posts` WHERE `rey_posts`.`ID` = `rey_woocommerce_order_items`.`order_id`)AS 'paid_status',
                (SELECT MAX(CASE WHEN rey_postmeta.meta_key = '_billing_email' THEN (SELECT user_login FROM rey_users WHERE rey_users.user_email = rey_postmeta.meta_value) END) FROM rey_postmeta WHERE rey_postmeta.post_id= rey_woocommerce_order_items.order_id ORDER BY rey_postmeta.post_id) AS 'guid',
                (SELECT MAX(CASE WHEN rey_postmeta.meta_key = '_paid_date' THEN rey_postmeta.meta_value END) FROM rey_postmeta WHERE rey_postmeta.post_id= rey_woocommerce_order_items.order_id ORDER BY rey_postmeta.post_id) AS 'paid_date',
                (SELECT MAX(CASE WHEN rey_postmeta.meta_key = '_price' THEN rey_postmeta.meta_value END) FROM rey_postmeta WHERE rey_postmeta.post_id IN (SELECT ID FROM rey_posts WHERE rey_posts.post_title = rey_woocommerce_order_items.order_item_name) ORDER BY rey_postmeta.post_id) AS 'course_price'
                FROM `rey_woocommerce_order_items`
                WHERE (SELECT `ID` FROM `rey_posts` WHERE `rey_posts`.`post_title` = `rey_woocommerce_order_items`.`order_item_name` AND `rey_posts`.`post_type` = 'course') IS NOT NULL AND (SELECT `post_status` FROM `rey_posts` WHERE `rey_posts`.`ID` = `rey_woocommerce_order_items`.`order_id`) = 'wc-completed' AND (SELECT MAX(CASE WHEN rey_postmeta.meta_key = '_billing_email' THEN (SELECT user_login FROM rey_users WHERE rey_users.user_email = rey_postmeta.meta_value) END) FROM rey_postmeta WHERE rey_postmeta.post_id= rey_woocommerce_order_items.order_id ORDER BY rey_postmeta.post_id)IS NOT NULL";

        $stmt = $this->connection->prepare($query);

        $stmt->execute();

        return $stmt;
    }
    //U
    public function update(){}
    //D
    public function delete(){}
}