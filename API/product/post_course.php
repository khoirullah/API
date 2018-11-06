<?php
header('Access-Control-Allow-Origin: *');
include "../config/database.php";
$courseid = json_decode($_REQUEST['courseid']);
$status = json_decode($_REQUEST['status']);
$coorporate = json_decode($_REQUEST['coorporate']);

$data = array(
    "courseid" => $courseid, 
    "status" => $status, 
    "coorporate"=> $coorporate
);
$success = array(
    "data" => $data,
        "message" => "Data has been created"
);
$error = array(
    "error" =>array(
        "code"=>400,
        "message"=>"Failed to create data"
    )
);
$sql = "INSERT INTO `tb_syncourse`(`ID`, `courseid`, `status`, `coorporate`) VALUES ('','$courseid','$status','$coorporate')";	
$res = mysqli_query($link,$sql);

if($res){
    echo json_encode($success['data']);
    echo json_encode($success['message']);
}
 
// if unable to create the product, tell the user
else{
    echo json_encode($error);
}
?>