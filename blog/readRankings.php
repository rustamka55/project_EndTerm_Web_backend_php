<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/ranking.php';

$database = new Database();
$db = $database->getConnection();
  
$ranking = new Ranking($db);

$stmt = $ranking->read();
$num = $stmt->rowCount();
  
if($num>0){
    $rankings_arr=array();
    $rankings_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $ranking_item=array(
            "id" => $id,
            "place" => $place,
            "artists" => $artists,
            "songname" => $songname
        );
  
        array_push($rankings_arr["records"], $ranking_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($rankings_arr);
}
  
else{
  
    http_response_code(404);

    echo json_encode(
        array("message" => "No products found.")
    );
}