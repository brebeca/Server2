<?php

spl_autoload_register('spl_autoload', false);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
class  AddProduct
{
    public static function add($session)
    {
        if (
            isset($_GET['title'])
           && isset($_GET['link']) && isset($_GET['img_link'])
            && isset($_GET['details']) && isset($_GET['category']) && isset($_GET['source'])
        ) {

            $db = new DBManagement();
            $key_word = "no_key_word";
            if (isset($_GET['keyWord']))
                $key_word = $_GET['keyWord'];
            $details = explode(',', $_GET['details']);
            $document = ['category' => $_GET['category'],
                'key_word' => $key_word,
                'title' => $_GET['title'],
                'link' => $_GET['link'],
                'img_link' => $_GET['img_link'],
                'source' => $_GET['source'],
                'details' => $details,
                'owner' => $session
            ];
            $db->insert_products($document);

            http_response_code(200);
            echo json_encode(array("message" => "Product added.GET"));
        } else {

            http_response_code(400); // bad request
            echo json_encode(array("Error" => "Need more data . GET"));

        }
    }
}