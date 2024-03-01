<?php
include_once 'include/functions.php';
include_once 'include/connect.php';

sec_session_start();

if(login_check(dbConnect()) == true) {
	include_once('include/navbar.php');
?>
<?php

if (isset($_POST['addCategory'])) {
	$category = new category();
	$category->setName($_POST['categoryName']);
	$category->addCategory();
}
if (isset($_POST['deleteCategory'])) {
	$category = new category();
	$category->setId($_POST['categoryId']);
	$category->delete();
}
if (isset($_POST['editCategory'])) {
	$category = new category();
	$category->setName($_POST['categoryName']);
	$category->setId($_POST['categoryId']);
	$category->update();
}
if (isset($_POST['addSubCategory'])) {
	$subCategory = new subCategory();
	$subCategory->setName($_POST['subCategoryName']);
	$subCategory->setCategoryId($_POST['categoryId']);
	$subCategory->addSubCategory();
}
if (isset($_POST['editSubCategory'])) {
	$subCategory = new subCategory();
	$subCategory->setName($_POST['subCategoryName']);
	$subCategory->setId($_POST['subCategoryId']);
	$subCategory->update();
}
if (isset($_POST['deleteSubCategory'])) {
	$subCategory = new subCategory();
	$subCategory->setName($_POST['subCategoryName']);
	$subCategory->setId($_POST['subCategoryId']);
	$subCategory->delete();
}
if (isset($_POST['saveSettings'])) {
	$setting = new system();
	$setting->setName('email');
	$setting->setValue($_POST['email']);
	$setting->update();

	$setting->setName('brand');
	$setting->setValue($_POST['brand']);
	$setting->update();

	$setting->setName('siteurl');
	$setting->setValue($_POST['siteurl']);
	$setting->update();

	$setting->setName('siteurl');
	$setting->setValue($_POST['siteurl']);
	$setting->update();

	$setting->setName('system email');
	$setting->setValue($_POST['email']);
	$setting->update();


}
?>

<!-- // set active menu bar -->
<script>$('#system').addClass("active");</script>

<body>
<?php
if ($_GET['maintenace'] == 'users') {

}

if ($_GET['maintenace'] == 'system') { ?>
<div id="content">
		<div id="displayCategories" class="panel panel-default">
        		<div class="panel-heading">System Settings</div>
		        	<div class="panel-body">
		   		<?php
		   			$systemV = system::withName('version');
		   			$systemAuthentication = system::withName('Authentication');
		   			$systemLanguage = system::withName('language');
						$systemEmail = system::withName('system email');
						$systemBrand = system::withName('brand'); # get branding for nav bar
						$systemUrl = system::withName('siteurl');
		   		?>

				<form class="form" method="post">
					<div class="form-group">
				    <label for="version" class="col-sm-3 control-label">System Version</label>
				      <div class="col-sm-8">
								<input class="form-control" name="version" id="version" value="<?php echo ''.  $systemV->getValue(); ?> " disabled="true" />
				      </div>
				  </div>

				  <div class="form-group">
				    <label for="authentication" class="col-sm-3 control-label">Authentication</label>
				      <div class="col-sm-8">
								<select class="form-control" name="authentication" id="authentication" >
									<option value="Native">Native</option>
									<option value="LDAP">LDAP</option>
								</select>
				      </div>
				  </div>

				  <div class="form-group">
				    <label for="email" class="col-sm-3 control-label">Notification Email</label>
				      <div class="col-sm-8">
								<input class="form-control" name="email" id="email" value="<?php echo ''. $systemEmail->getValue(); ?>" />
				      </div>
				  </div>

				  <div class="form-group">
				    <label for="language" class="col-sm-3 control-label">language</label>
				      <div class="col-sm-8">
								<select class="form-control" name="language" id="language" >
									<option value="English">English</option>
								</select>
				      </div>
				  </div>

					<div class="form-group">
				    <label for="brand" class="col-sm-3 control-label">Brand</label>
				      <div class="col-sm-8">
								<input class="form-control" name="brand" id="brand" value="<?php echo ''. $systemBrand->getValue(); ?>" />
				      </div>
				  </div>

					<div class="form-group">
				    <label for="siteurl" class="col-sm-3 control-label">Site url</label>
				      <div class="col-sm-8">
								<input class="form-control" name="siteurl" id="brand" value="<?php echo ''. $systemUrl->getValue(); ?>" />
				      </div>
				  </div>

				  <div class="form-group">
				      <div class=" col-offset-sm-2 col-sm-8">
				 	 <button class="btn btn-success" name="saveSettings" type="submit">Save</button>
				      </div>
				  </div>

				</form>

				</div> <!--/panel body -->
		</div> <!-- /panel -->
</div> <!-- /content -->


<?php } ?>

<?php if ($_GET['maintenace'] == 'categories') { ?>
<div id="content">
		<div id="displayCategories" class="panel panel-default">
        		<div class="panel-heading">Categories</div>

		        	<div class="panel-body">
			        	<form class="form-inline" method="POST">
						<div class="form-group">
							<label for="categoryName">Category Name</label>
							<input type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Ticket System">
						</div>
						<button type="submit" name="addCategory" class="btn btn-success">Add Category</button>
					</form>
					<form class="form-inline" method="POST">
						<div class="form-group">
							<label for="categoryId">Category</label>
				                        <select class="form-control" id="categoryId" name="categoryId">
				                        	<?php category::displayCategoryOptionList(); ?>

				                       </select>
						</div>
						<div class="form-group">
							<label for="subCategoryName">Sub Category Name</label>
							<input type="text" class="form-control" name="subCategoryName" id="subCategoryName" placeholder="system issue">
						</div>
						<button type="submit" name="addSubCategory" class="btn btn-success">Add Sub Category</button>
					</form>
				</div>
			</div>

	 		<div id="displayCategories" class="panel panel-default">
        			<div class="panel-heading">Categories</div>
		        		<?php category::displayCategoryEditList(); ?>
	        	</div>

	 		<div id="displaySubCategories" class="panel panel-default">
        			<div class="panel-heading">Sub Categories</div>
        			<div class="panel=body">

					<select class="form-control" id="selectCategory">
						<?php category::displayCategoryOptionList(); ?>
					</select>

			        	<div id="subCategoryDisplay"></div>
			        </div>

        		</div>
       		</div>



       		 <?php } ?>

</div>
</body>

<?php
// end protected content
} else {
        echo 'You are not authorized to access this page redirecting you to the <a href="./index.php">login page</a>.';
        echo '<META http-equiv="refresh" content="2;URL=./index.php">';
}

?>
