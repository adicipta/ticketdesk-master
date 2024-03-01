<?php
include_once('../connect.php');

$mysqli = dbConnect();

$selectvalue =  $_GET['svalue'];

if (!is_numeric($selectvalue)){
	echo "Invalid Data";
	exit;
}
$sql = "select sc.name as subcategoryname,
		c.name as categoryname,
		c.id as categoryid,
		sc.id as subcategoryid
	from subcategories sc, categories c
		where sc.categoryid = c.id
		and sc.categoryid = $selectvalue";
$result = $mysqli->query($sql);
$mysqli->close();
if ($result->num_rows > 0) {
	// output data of each row
	//echo '<table class="table"><th>Category</th><th>Subcategory</th><th></th>';
	while($row = $result->fetch_assoc()) {
		echo '<form class="form form-inline" method="POST" action="#">
		<input type="text" name="subCategoryId" value="'.$row['subcategoryid'].'" hidden />
		<input type="text" name="categoryId" value="'.$row['categoryid'].'" hidden />

		<input name="subCategoryName" class="form-control" type="text" value="'.$row['subcategoryname'].'" />
		<button type="submit" name="editSubCategory" class="btn btn-success" >Save</button>								
		<button type="submit" name="deleteSubCategory" class="btn btn-danger" >Delete</button>

		</form>';
	}
	//echo '</table>';
} else {
	echo "No categories added yet...";
}
 



?>