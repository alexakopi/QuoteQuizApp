<?php
class Setting {

	// database connection and table name
	private $conn;
	private $table = "settings";

	// object properties
	public $id;
	public $name;
	public $value;

	// constructor with $db as database connection
	public function __construct( $db ) {
		$this->conn = $db;
	}

	// read setting
	public function read(){

		// select all query
		$query = "SELECT 
				  *
				  FROM `".$this->table."`";
		// prepare query statement
		$qdata = $this->conn->prepare($query);

		// execute query
		$qdata->execute();

		return $qdata;
	}

	// update the setting
	public function update(){

		$this->id=htmlspecialchars(strip_tags($this->id));
		$this->name=htmlspecialchars(strip_tags($this->name));
		$this->value=htmlspecialchars(strip_tags($this->value));

		if( boolval( $this->id ) ){
			// update query 1
			$query = "UPDATE
            " . $this->table . "
            SET
                value = :value
            WHERE
                id = :id";
			// prepare query statement
			$stmt = $this->conn->prepare($query);
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':value', $this->value);

			// execute the query
			if($stmt->execute()){
				return true;
			}
		}

		return false;
	}
}