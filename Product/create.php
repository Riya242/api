<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset=UTF-8");
header("Access-control-Allow-Methods: POST");
header("Access-control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With");


include_once "../config/Database.php";
include_once "../objects/Product.php";

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$data = json_decode(file_get_contents("php://input"));

if (!empty($data->name) && !empty($data->price) && !empty($data->description) && !empty($data->category_id)) {
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->category_id = $data->category_id;
    $product->created = date('Y-m-d H:i:s');

    if ($product->create()) {
        http_response_code(200);
        echo json_encode(array("message" => "Product Was Created!"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Unable to Create Product!"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Bad Request!"));
}
