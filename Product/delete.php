<?php 
    header("Access-Control-Allow-Origin:*");
    header("Access-Control-Allow-Methods:DELETE");
    header("Access-Control-Max-Age:3600");
    header("Content-Type:application/json");
    header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

    include_once "../config/Database.php";
    include_once "../objects/Product.php";

    $database = new Database();
    $db = $database->getConnection();
    $product = new Product($db);

    $data = json_decode(file_get_contents("php://input"));
    $product->id = $data->id;
    if($product->delete()){
        http_response_code(200);
        echo json_encode(array("message"=>"Delete Success!"));
    }else{
        http_response_code(503);
        echo json_encode(array("message"=>"Delete Failed!"));
    }

?>