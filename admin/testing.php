<?php

require_once "classes/Property.php";
require_once "classes/Auth.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");


header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("WWW-Authenticate: Basic realm='My Realm'");


if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    http_response_code(400);
   $response= ["status" => "failed",
                     "message" => "Username and password are required",
                     "data" => []
                    ];
    echo json_encode($response);
    exit();
}


$auth = new Auth();
$rsp = $auth->verify_merchant($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']);

if ($rsp === false) {
    http_response_code(401);
    echo json_encode(["status" => "failed",
                     "message" => "Authentication failed",
                    "data" => []]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["status" => "failed",
                     "message" => "This endpoint only supports POST method",
                      "data" => []]);
    exit();
}

$data = file_get_contents("php://input");
$da = json_decode($data);


if (!isset($da->name) || !isset($da->contact) || !isset($da->filename) || !isset($da->price)) {
    http_response_code(400);
    echo json_encode(["status" => "failed",
                        "message" => "Name, contact, price, and filename are required",
                        "data" => []
                    ]);
    exit();
}


if (empty($da->name) || empty($da->contact) || empty($da->filename) || empty($da->price)) {
    http_response_code(400);
    echo json_encode(["status" => "failed",
                     "message" => "Fields cannot be empty",
                    "data" => []
                ]);
    exit();
}


$pro = new Property();
$property = $pro->insert_new_property($da->contact, $da->filename, $da->price, $da->name);

if ($property) {
    http_response_code(201);
    echo json_encode(["status" => "success",
                     "message" => "Property successfully added",
                     "data" => []
                    ]);
} else {
    http_response_code(500);
    echo json_encode(["status" => "failed",
                     "message" => "Failed to insert property",
                      "data" => []
                    ]);
}

?>