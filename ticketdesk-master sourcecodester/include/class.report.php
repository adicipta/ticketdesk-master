<?php
include_once('connect.php');

class report {

	private $mysqli;
	private $startDate;
	private $endDate;
	private $user;
	private $clientId;
	private $category;
	private $subCategory;
	private $status;
	private $name;

	function __construct() {
		$this->mysqli = dbConnect();
	}

	// gets
	public function getMysqli() {return $this->mysqli;}
	public function getStartDate() {return $this->startDate;}
	public function getEndDate() {return $this->endDate;}
	public function getUser() {return $this->user;}
	public function getClientId() {return $this->clientId;}
	public function getName() {return $this->name;}
	public function getCategory() {return $this->category;}
	public function getSubCategory() {return $this->subCategory;}
	public function getStatus() {return $this->status;}

	// sets
	public function setMysqli($mysqli) { $this->mysqli = $mysqli;}
	public function setStartDate($startDate) {$this->startDate = $startDate;}
	public function setEndDate($endDate) {$this->endDate = $endDate;}
	public function setUser($user) {$this->user = $user;}
	public function setClientId($clientId) {$this->clientId = $clientId;}
	public function setName($name) {$this->name = $name;}
	public function setCategory($category) { $this->category = $category;}
	public function setSubCategory($subCategory) {$this->subCategory = $subCategory;}
	public function setStatus($status) { $this->status = $status;}


	public function createReport() {

	    $output = fopen('php://output', 'w');

	    // output the column headings
	    fputcsv($output, array('TicketId','clientId','open_date', 'opened_by','assigned_to','details','Status','Category','SubCategory','Notes'));

	    $sql = "select
							t.id,
							t.clientnumber,
							t.opendate,
							t.user,
							t.assigneduser,
							t.comments,
							ts.status,
							ts.statusdate,
							tn.note,
							tn.notedate
								from tickets t, ticketnotes tn, categories c, subcategories sc,ticketstatus ts
									where t.id = tn.ticketid
									and ts.ticketid = t.id
									and t.categoryid = c.id
									and t.subcategoryid = sc.id
										order by t.opendate desc, tn.notedate";
      $sql = "select * from tickets";
      $result = $this->mysqli->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) { fputcsv($output, $row);	}
			}
			fclose($output);
		  mysqli_close($this->mysqli);

	}
}


?>
