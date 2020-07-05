<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/setting.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$setting = new Setting($db);

// read products

// query products
$qdata = $setting->read();
$num = $qdata->rowCount();

if($num>0){

	// questions array
	$questions_arr["setting"] = [];

	while ($row = $qdata->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		$questions_arr["settings"] []=[
			"id" => $id,
			"name" => $name,
			"value" => $value,
		];
	}

	// set response code - 200 OK
	http_response_code(200);

	// show questions data in json format
	echo json_encode($questions_arr);
}
else{

	// set response code - 404 Not found
	http_response_code(404);

	// tell the user no questions found
	echo json_encode(
		array("message" => "No questions found.")
	);
}