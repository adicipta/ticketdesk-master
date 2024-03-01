<?php

class system {
	private $id;
	private $name;
	private $value;
	private $mysqli;


	function __construct() {
		$this->mysqli = dbConnect();
	}

	public function getSystemSetting($settingName) {
		$this->name = $settingName;
		$sql = "select * from system where name = '" . $this->name . "'";
		$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$this->name = $row['name'];
				$this->value = $row['value'];
			}
		}

	}

	public static function withName($settingName) {
		$instance = new self;
		$instance->getSystemSetting($settingName);
		return $instance;
	}

	public static function displaySettings() {
		$mysqli = dbConnect();
		$sql = "select * from system";
		$result = $mysqli->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			echo '<table class="table"><th>Name</th><th>Value</th><th></th>';
			while($row = $result->fetch_assoc()) {
		       		echo '<tr><td>' .$row['name'] .
		       		'</td><td>' . $row['value'] .
		       		'</td><td><button class="btn btn-success">Edit</button> </td></tr>';
			}
			echo '</table>';
		} else {
			echo "No system settings... Woops.";
		}

	}
	public function update() {
		$sql = "update system set value = ? where name = ?";
		if ($update_stmt = $this->mysqli->prepare($sql)) {
			$update_stmt->bind_param('ss',$this->value, $this->name);
			if (! $update_stmt->execute()) {
				return false;
			}
		}
	}

	public function getId() { return $this->id; }
	public function getName() {return $this->name;}
	public function getValue() {return $this->value;}

	public function setId($id) { $this->id = $id; }
	public function setName($name) {$this->name = $name;}
	public function setValue($value) {$this->value = $value;}



}

?>
