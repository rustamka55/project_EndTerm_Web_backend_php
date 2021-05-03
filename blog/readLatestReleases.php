<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/latestrelease.php';

$database = new Database();
$db = $database->getConnection();
  
$lr = new Lr($db);

$stmt = $lr->read();
$num = $stmt->rowCount();
  
if($num>0){
    $lr_arr=array();
    $lr_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $lr_item=array(
            "id" => $id,
            "artists" => $artists,
            "songname" => $songname
        );
  
        array_push($lr_arr["records"], $lr_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($lr_arr);
}
  
else{
  
    http_response_code(404);

    echo json_encode(
        array("message" => "No products found.")
    );
}