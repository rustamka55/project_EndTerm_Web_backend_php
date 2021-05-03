<?php
class Blog{
    private $conn;
    private $table_name = "blogs";

    public $id;
    public $title;
    public $author;
    public $date;
    public $message;
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
	// create product
	function create(){
		
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					title=:title, author=:author, date=:date, message=:message";
		$stmt = $this->conn->prepare($query);
	  
		// sanitize
		$this->title=htmlspecialchars(strip_tags($this->title));
		$this->author=htmlspecialchars(strip_tags($this->author));
		$this->date=htmlspecialchars(strip_tags($this->date));
		$this->message=htmlspecialchars(strip_tags($this->message));
	  
		// bind values
		$stmt->bindParam(":title", $this->title);
		$stmt->bindParam(":author", $this->author);
		$stmt->bindParam(":date", $this->date);
		$stmt->bindParam(":message", $this->message);
	  
		// execute query
		if($stmt->execute()){
			return true;
		}
	  
		return false;
	}
}
?>