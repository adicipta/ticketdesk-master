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
	    fputcsv($output, array('TicketId','clientId','open_date','update_date', 'opened_by','assigned_to','Details','Status','Category','SubCategory','Notes'), "\t");

	  $where = '';
	  if(!empty($this->startDate) && !empty($this->endDate)){

	  	if(empty($where)) $where .= " where "; else $where .= " and ";
		  	$where .= " (date(ts.statusdate) BETWEEN '{$this->startDate}' and '{$this->endDate}' ) ";
	  }
	  if(!empty($this->user) && $this->user != "all"){

	  	if(empty($where)) $where .= " where "; else $where .= " and ";
		  	$where .= " t.user = '{$this->user}' ";
	  }
	  if(!empty($this->category) && is_numeric($this->category)){

	  	if(empty($where)) $where .= " where "; else $where .= " and ";
		  	$where .= " t.categoryid = '{$this->category}' ";
	  }
	  if(!empty($this->subCategory) && is_numeric($this->subCategory)){

	  	if(empty($where)) $where .= " where "; else $where .= " and ";
		  	$where .= " t.subcategoryid = '{$this->subCategory}' ";
	  }
	  if(!empty($this->status) && $this->status != "all"){

	  	if(empty($where)) $where .= " where "; else $where .= " and ";
		  	$where .= " ts.status = '{$this->status}' ";
	  }
      $sql = "SELECT 
					t.id,
					t.clientId,
					t.opendate,
					ts.statusdate,
					t.user,
					t.assigneduser,
					t.comments,
					ts.status,
					c.name AS category_name,
					sc.name AS sub_category_name
					 from tickets t inner join categories c on c.id = t.categoryid inner join ticketstatus ts on ts.ticketid = t.id inner join subcategories sc on t.subcategoryid = sc.id  $where order by t.opendate desc";
					 // echo $sql;
      	$result = $this->mysqli->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) { 
				$note = "";
				$qry = $this->mysqli->query("SELECT * from ticketnotes where ticketid = {$row['id']} ");
				$note = $qry->num_rows > 0 ? $qry->fetch_array()['note'] : $note;

				// replace special characters in the note with spaces
				$note = str_replace(array("\r\n", "\r", "\n", "\t"), ' ', $note);

				$row['Category'] = $row['category_name'];
				$row['SubCategory'] = $row['sub_category_name'];
				$row['Notes'] = $note;

				// remove alias columns to avoid writing them to the excel file 
				unset($row['category_name']);
				unset($row['sub_category_name']);
			
				fputcsv($output, $row, "\t");
			}
		}
		fclose($output);
		mysqli_close($this->mysqli);
	}
}


?>
