<?php
include_once('connect.php');

class category {
	
	// instance vars
	protected $mysqli;
	protected $id;
	protected $name;
	
	
	public function __construct() {
		$this->mysqli = dbConnect();
	}
	
	
	public function getCategory($id) {
		$this->id = $id;
		$sql = "select * from categories where id = " . $id;
		$result = $this->mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$this->name = $row['name'];	
			}
		} else {
			return false;
		}
	}
	
	
	public function addCategory() {
		$sql = "insert into categories (name) values (?)";
		if ($insert_stmt = $this->mysqli->prepare($sql)) {
			$insert_stmt->bind_param('s',$this->name);
			if (! $insert_stmt->execute()) {	
				return false;
			}
		}
	}
	
	public function delete() {
		$sql = "delete from categories
			where id = ?";
		if ($delete_stmt = $this->mysqli->prepare($sql)) {
			$delete_stmt->bind_param('i',$this->id);
			if (! $delete_stmt->execute()) {	
				return false;
			}
		}
	} 
	
	public function update() {
		$sql = "update categories set name = ? where id = ?";
		if ($update_stmt = $this->mysqli->prepare($sql)) {
			$update_stmt->bind_param('si',$this->name, $this->id);
			if (! $update_stmt->execute()) {	
				return false;
			}
		}	
	}		
	
	
	public static function displayCategoryOptionList() {
		$mysqli = dbConnect();
		$sql = "select * from categories";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			echo '<option value="">Choose Category</option>';
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row['id']. '">'. $row['name'] .' </option>';	
			}
		} else {
			echo "No categories added yet...";
		}
		$mysqli->close();   		
	}
	
	public static function displayCategoryEditList() {
		$mysqli = dbConnect();
		$sql = "select * from categories";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo '<form class="form form-inline" method="post">
					<input type="text" name="categoryId" value="'.$row['id'].'" hidden/>
					<input name="categoryName" class="form-control" type="text" value="'.$row['name'].'" ' . $row['name'] . '</input>
					<button type="submit" name="editCategory" class="btn btn-success" type="submit">Save</button>								
					<button type="submit" name="deleteCategory" class="btn btn-danger" type="submit">Delete</button>
				</form>';
			}
		} else {
			echo "No categories added yet...";
		}
		$mysqli->close();   		
	}
	
	
	public function getId() {return $this->id;}
	public function getName() {return $this->name;}
	public function getMysqli() {return $this->mysqli;}
	
	public function setName($name) {$this->name = $name;}
	public function setId($id) {$this->id = $id;}
	

}

class subCategory extends category {
	
	// instance vars
	private $categoryId;
	
	function __construct() {
		//parent::__construct();
		$this->mysqli = dbConnect();
   	}
   	
   	
   	public function getSubCategory($id) {
   		$this->id = $id;
		$sql = "select * from subcategories where id = " .$id;
		$result = $this->mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$this->name = $row['name'];
				$this->categoryId = $row['categoryid'];
			} return true;
		} return false; 
   	
   	}
   	
	public function addSubCategory() {
		$sql = "insert into subcategories (name,categoryid) values (?,?)";
		if ($insert_stmt = $this->mysqli->prepare($sql)) {
			$insert_stmt->bind_param('si',$this->name, $this->categoryId);
			if (! $insert_stmt->execute()) {	
				return false;
			}
		}
	}  
	
	public function update() {
		$sql = "update subcategories
			set name = ?
			where id = ?";
		if ($update_stmt = $this->mysqli->prepare($sql)) {
			$update_stmt->bind_param('si',$this->name, $this->id);
			if (! $update_stmt->execute()) {	
				return false;
			}
		}	
	}
	
	public function delete() {
		$sql = "delete from subcategories
			where id = ?";
		if ($delete_stmt = $this->mysqli->prepare($sql)) {
			$delete_stmt->bind_param('i',$this->id);
			if (! $delete_stmt->execute()) {	
				return false;
			}
		}
	} 	
   	
   	
   	public function getCategoryId() {return $this->categoryId;}

   	public function setCategoryId($id) {$this->categoryId = $id;}
   	
	public static function displaySubCategoryOptionList($id='') {
		$mysqli = dbConnect();
		$where = '';
		if(!empty($where)){
			$where = "where categoryid = $id";
		}
		$sql = "select * from subcategories $where";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			echo '<option value="">Choose Sub Category</option>';
			while($row = $result->fetch_assoc()) {
				echo '<option value="' . $row['id']. '">'. $row['name'] .' </option>';	
			}
		} else {
			echo "<option>No categories added yet...</option>";
		}   		
	}  

	public static function displaySubCategoryEditList() {
		$mysqli = dbConnect();
		$sql = "select sc.name as subcategoryname,
				c.name as categoryname,
				c.id as categoryid,
				sc.id as subcategoryid
			from subcategories sc, categories c
				where sc.categoryid = c.id";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			echo '<table class="table"><th>Category</th><th>Subcategory</th><th></th>';
			while($row = $result->fetch_assoc()) {
				echo '<form method="post">
					<input type="text" name="subCategoryId" value="'.$row['subcategoryid'].'" hidden/>
					<input type="text" name="categoryId" value="'.$row['categoryid'].'" hidden/>
					<tr><td>
						<input name="categoryName" class="form-control" type="text" disabled value="'.$row['categoryname'].'"> </input>
					</td><td>
						<input name="subCategoryName" class="form-control" type="text" value="'.$row['subcategoryname'].'"> </input>
					</td><td>		
						<button type="submit" name="editSubCategory" class="btn btn-success" >Save</button>								
						<button type="submit" name="deleteSubCategory" class="btn btn-danger">Delete</button>
					</td</tr>
				</form>';
			}
			echo '</table>';
		} else {
			echo "No categories added yet...";
		}
		$mysqli->close();   		
	}   	 	
	
   	
}


?>