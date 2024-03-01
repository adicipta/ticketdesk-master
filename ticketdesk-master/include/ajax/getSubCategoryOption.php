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
	 echo '<div class="form-group">
                    <label for="subCategoryId" class="col-sm-2 control-label">SubCategory</label>
                    <div class="col-sm-10">
			<select class="form-control" id="subCategoryId" name="subCategoryId">
				<option>Choose Sub Category</option>';

	while($row = $result->fetch_assoc()) {
		echo '<option value="'.$row['subcategoryid'].'">' .$row['subcategoryname']. '</option>';
	}
	echo '</select>
		</div>
        </div>';
} else {
	
}




?>