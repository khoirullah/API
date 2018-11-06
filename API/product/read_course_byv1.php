<?php
header('Access-Control-Allow-Origin: *');
include "../config/database.php";
$courseid = $_REQUEST['courseid'];

$sql = "SELECT * FROM `tb_syncourse` WHERE `courseid` = '$courseid'";	
$res = mysqli_query($link,$sql);
$num = mysqli_num_rows($res);
$row = mysqli_fetch_assoc($res);

if ($num>0) {
    $products_arr=array();
    $products_arr["data"]=array();
    $products_arr["length"]= $num;
    while ($row = mysqli_fetch_assoc($res)) {
        extract($row);
        $product_item=array(
            'ID' =>   $row['ID'],
            'courseid' =>   $row['courseid'],
            'status' =>   $row['status'],
            'coorporate' =>  $row['coorporate']
        );
        array_push($products_arr["data"], $product_item);
    }
    echo json_encode($products_arr);
    echo json_encode($products_arr['length']);
}
else {
    echo json_encode(array("message" => "data not found"));
}
?>