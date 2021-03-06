<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/question.php';

$database = new Database();
$db = $database->getConnection();

$question = new Question($db);

$data = json_decode(file_get_contents("php://input"));

// set ID property of question to be edited
$question->id = $data->id;

// set question property values
$question->question = $data->question;
$question->answers = $data->answers;


// update the question
if($question->update()){

	// set response code - 200 ok
	http_response_code(200);

	// tell the user
	echo json_encode(array("message" => "Question was updated."));
}

// if unable to update the question
else{

	// set response code - 503 service unavailable
	http_response_code(503);

	// tell the user
	echo json_encode(array("message" => "Unable to update question."));
}
?>