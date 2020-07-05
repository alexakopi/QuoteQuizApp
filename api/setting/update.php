<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/setting.php';

$database = new Database();
$db = $database->getConnection();

$setting = new Setting($db);

$data = json_decode(file_get_contents("php://input"));

$setting->id = $data->id;
$setting->name = $data->name;
$setting->value = $data->value;

// update the setting
if($setting->update()){

	// set response code - 200 ok
	http_response_code(200);

	// tell the user
	echo json_encode(array("message" => "Setting was updated."));
}

// if unable to update the question
else{

	// set response code - 503 service unavailable
	http_response_code(503);

	// tell the user
	echo json_encode(array("message" => "Unable to update setting."));
}
?>