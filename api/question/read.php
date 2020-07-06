<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/question.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$question = new Question($db);

// read products

// query products
$qdata = $question->read();
$num = $qdata->rowCount();

if($num>0){

	// questions array
	$questions_arr["questions"] = [];

	while ($row = $qdata->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		if(array_key_exists($id,$questions_arr["questions"])){
			$questions_arr["questions"] [$id] ["answers"] []= [
				"id" => $answer_id,
				"answer" => html_entity_decode($answer),
			];
		}else{
			$questions_arr["questions"] [$id] = [
				"id" => $id,
				"question" => html_entity_decode($question),
				"answers"=>[
					[
						"id" => $answer_id,
						"answer" => html_entity_decode($answer),
					]
				]
			];
		}
	}

	shuffle($questions_arr["questions"]);
	foreach ($questions_arr["questions"] as $key => $value ){
		$arr = $value["answers"];
		shuffle($arr);
		$questions_arr["questions"][$key]["answers"] = $arr;
		$item["answers"] = $arr;
	}
	$questions_arr["questions"] = array_slice( $questions_arr["questions"],0,10);

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
