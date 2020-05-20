<?php

spl_autoload_register('spl_autoload', false);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
class AddUser
{
    public static  function add($session){
        $db=new DBManagement();
        $document=[
            'session'=>$session
        ];
        $db->insert_users($document);

        http_response_code(200);
        echo json_encode(array("message" => "Contact added.POST"));
    }

}