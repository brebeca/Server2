<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$data = json_decode(file_get_contents("php://input"));
if(
!empty($data->session)
){
    $db=new DBManagement();
    $document=[
        'session'=>$data->session
    ];
     $db->insert_users($document);

    http_response_code(200);
    echo json_encode(array("message" => "Contact added.POST"));
}
else{

    http_response_code(400); // bad request
    echo json_encode(array("message" => "Unable to create contact POST"));

}
