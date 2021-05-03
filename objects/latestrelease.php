<?php
class Lr{
    private $conn;
    private $table_name = "latestreleases";

    public $id;
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