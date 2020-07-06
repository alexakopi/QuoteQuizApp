<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

	// include database and object files
	include_once '../config/database.php';
	include_once '../objects/questions.php';

// database and product object
	$database = new Database();
	$db = $database->getConnection();

// initialize object
	$question = new Question($db);

	$question->id = isset($_GET['id']) ? $_GET['id'] : die();

	$answer = isset($_GET['answer']) ? $_GET['answer'] : die();

	$data = $question->check($answer);

	$row ["is_right"]= $data->fetch(PDO::FETCH_ASSOC)["is_right"];

	$data = $question->getCorrect();
	$row ["answer"]= $data->fetch(PDO::FETCH_ASSOC)["answer"];


// set response code - 200 OK
	http_response_code(200);

// show questions data in json format
	echo json_encode($row);