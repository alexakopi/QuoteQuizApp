<?php
class Question{

	// database connection and table name
	private $conn;
	private $question_table = "questions";
	private $answers_table = "answers";

	// object properties
	public $id;
	public $question;
	public $answers;

	// constructor with $db as database connection
	public function __construct($db){
		$this->conn = $db;
	}

	// read questions
	public function read(){

		// select all query
		$query = "SELECT 
				  q.*,a.id as `answer_id`,a.is_right,a.answer 
				  FROM `".$this->question_table."` as q
				  INNER JOIN `".$this->answers_table."` AS a ON a.question_id = q.id";

		// prepare query statement
		$qdata = $this->conn->prepare($query);

		// execute query
		$qdata->execute();

		return $qdata;
	}

	// update the question
	public function update(){

		$this->id=htmlspecialchars(strip_tags($this->id));

		foreach ($this->answers as $answer){
			if( boolval( $answer->is_right ) ){
				// update query 1
				$query = "UPDATE
                " . $this->answers_table . "
                SET
                    is_right = 0
                WHERE
                    question_id = :id";
				// prepare query statement
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(':id', $this->id);
				$stmt->execute();

				// update query 2
				$query = "UPDATE
                " . $this->answers_table . "
                SET
                    is_right = 1
                WHERE
                    id = :id";
				// prepare query statement
				$stmt = $this->conn->prepare($query);
				$stmt->bindParam(':id', $answer->id);
				$stmt->execute();
				// execute the query
				if($stmt->execute()){
					return true;
				}
			}
		}
		return false;
	}

	// check  question
	public function check($answer){

		$this->id=htmlspecialchars(strip_tags($this->id));

		// select query
		$query = "SELECT 
				  is_right 
				  FROM `".$this->answers_table."`
				  WHERE question_id =".$this->id." AND id =" . $answer;

		// prepare query statement
		$qdata = $this->conn->prepare($query);

		// execute query
		$qdata->execute();

		return $qdata;
	}

}
?>