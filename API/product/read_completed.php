<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../object/completed.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$product = new Completed($db);
 
// query products
$stmt = $product->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
    $products_arr["count"]= $num;
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        //Print_r($row);
        extract($row);
 
        $product_item=array(
            "courseAverageRating" => (int)$courseAverageRating,
            "courseId" => $courseId,  
            "guid" => $guid,
            "timestamp" => $timestamp,
            "userComment" => $userComment,  
            "userRating" => (int)$userRating
        );
        array_push($products_arr["records"], $product_item);
    }
    echo json_encode($products_arr);
    echo json_encode($products_arr["counts"]);
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
}
?>