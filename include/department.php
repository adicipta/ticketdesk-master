<?php
include_once('connect.php');

class department {

	private $id;
	private $name;
	private $mysqli;

	function __construct() {
		$this->mysqli = dbConnect();
	}
	public static function withId($id) {
		$instance = new self();
		$instance->getDepartment($id);
		return $instance;
		
	
	}
	public function getDepartment($id) {
		$sql = "select * from groups where id = ". $id;
		
		$result = $this->mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$this->name = $row['name'];
				$this->id = $row['id'];
			}
			
		}	
	
	}
	
	
	public function getId() {return $this->id;}
	public function getName() {return $this->name;}
	
	public function setId($id) {$this->id = $id;}
	public function setName($name) {$this->name = $name;}


	public static function displayDepartmentsOptionList() {
		
		$mysqli = dbConnect();
		$sql = "select * from groups";
		$result = $mysqli->query($sql);
		echo '<option>Choose Department</option>';

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_array()) {
				echo '<option value="'. $row['id'] .'">' . $row['name'] . '</option>';
			}
		} else {
			echo "<option>No derpartments...</option>";
		}
		$mysqli->close();   	
	}
}

?>