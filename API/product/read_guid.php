<?php
header('Access-Control-Allow-Origin: *');
include "../config/database.php";
$sql = "SELECT * FROM `tb_extuser`";	
$res = mysqli_query($link,$sql);
$num = mysqli_num_rows($res);

if ($num>0) {
    $products_arr=array();
    $products_arr["data"]=array();
    $products_arr["count"]= $num;
    while ($row = mysqli_fetch_assoc($res)) {
        extract($row);
        $product_item=array(
            'ID' =>   $row['ID'],
            'guid' =>   $row['guid'],
            'user_login' =>   $row['user_login'],
            'coorporate' =>  $row['coorporate']
        );
        array_push($products_arr["data"], $product_item);
    }
    echo json_encode($products_arr);
    echo json_encode($products_arr['count']);
}
else {
    echo json_encode(array("message" => "data not found"));
}
?>