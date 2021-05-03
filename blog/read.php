<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/blog.php';

$database = new Database();
$db = $database->getConnection();
  
$blog = new Blog($db);

$stmt = $blog->read();
$num = $stmt->rowCount();
  
if($num>0){
    $blogs_arr=array();
    $blogs_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $blog_item=array(
            "id" => $id,
            "title" => $title,
            "author" => $author,
            "date" => $date,
            "message" => $message
        );
  
        array_push($blogs_arr["records"], $blog_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($blogs_arr);
}
  
else{
  
    http_response_code(404);

    echo json_encode(
        array("message" => "No products found.")
    );
}