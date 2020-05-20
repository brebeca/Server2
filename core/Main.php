<?php
spl_autoload_register('spl_autoload', false);
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
require_once 'AddUser.php';
require_once 'get/AddProduct.php';

class Main
{

    public function __construct(){

        $session=get_session();
        if($session==false)
        {

            return;
        }else {
            $request = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                {
                    if (isset($request[0])) {
                        if (strpos($request[0], 'AddProduct') == 0) {
                            AddProduct::add($session);
                        }
                    } else {
                        http_response_code(400);
                        echo json_encode(array("Error" => "Unrecognized path."));
                        return;
                    }
                    break;
                }
                case 'POST':
                {
                    $data = json_decode(file_get_contents('php://input'), true);
                    if (isset($request[0])) {
                        if (strpos($request[0], 'AddUser') == 0) {
                            AddUser::add($data['Session']);
                        }
                    } else {
                        http_response_code(400);
                        echo json_encode(array("Error" => "Unrecognized path."));
                        return;
                    }
                    break;
                }
                default:
                {
                    http_response_code(400);
                    echo json_encode(array("Error" => "Unrecognized path."));
                    return;
                    break;
                }
            }
        }
    }

}
 function get_session(){
    $headers = array();
    foreach($_SERVER as $key => $value) {
        if (substr($key, 0, 5) <> 'HTTP_') {
            continue;
        }
        $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
        $headers[$header] = $value;
    }
    if(!isset($headers['Session']))
    {
        http_response_code(400); // bad request
        echo json_encode(array("Error" => "Session not valid."));
        return false;
    }
    $db = new DBManagement();
    if($db->verify_session($headers['Session'])==false) {
        http_response_code(400); // bad request
        echo json_encode(array("Error" => "Session not valid.","session"=>$headers['Session']));
        return false;
    }
    return $headers['Session'];
}



