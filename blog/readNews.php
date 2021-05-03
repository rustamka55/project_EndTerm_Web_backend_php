<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/news.php';

$database = new Database();
$db = $database->getConnection();
  
$news = new News($db);

$stmt = $news->read();
$num = $stmt->rowCount();
  
if($num>0){
    $news_arr=array();
    $news_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $news_item=array(
            "id" => $id,
            "title" => $title,
            "author" => $author,
            "date" => $date,
            "message" => $message
        );
  
        array_push($news_arr["records"], $news_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($news_arr);
}
  
else{
  
    http_response_code(404);

    echo json_encode(
        array("message" => "No products found.")
    );
}