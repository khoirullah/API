<?php
header('Access-Control-Allow-Origin: *');
include "../config/database.php";
$guid = $_REQUEST['guid'];
$user_login = $_REQUEST['user_login'];
$coorporate = $_REQUEST['coorporate'];

$data = array(
    "guid" => $guid, 
    "user_login" => $user_login, 
    "coorporate" => $coorporate
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

$sql = "INSERT INTO `tb_extuser`(`ID`, `guid`, `user_login`, `coorporate`) VALUES ('','$guid','$user_login','$coorporate')";	
$res = mysqli_query($link,$sql);

if($res){
    echo json_encode($success);
}
 
// if unable to create the product, tell the user
else{
    echo json_encode($error);
}
?>