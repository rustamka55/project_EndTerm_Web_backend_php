<?php
class Ranking{
    private $conn;
    private $table_name = "ranking";

    public $id;
    public $place;
    public $artists;
    public $songname;
    public function __construct($db){
        $this->conn = $db;
    }
	function read(){
		$query = "SELECT * FROM
					" . $this->table_name;
	
		$stmt = $this->conn->prepare($query);

		$stmt->execute();
  
		return $stmt;
	}
}
?>