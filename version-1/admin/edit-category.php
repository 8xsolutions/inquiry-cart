<?php
include('function/config.ini.php');
include('function/function.ini.php');
include('function/setting.ini.php');
$id = (int) $_GET['id'];
if (empty($id)) {
    echo '<meta http-equiv="refresh" content="0; url=category.php">';
}
$sql = mysql_query("SELECT * FROM `main_cats` WHERE main_cat_id = '$id'");
if (mysql_num_rows($sql) == 0) {
    echo '
    <h1>No Category Found</h1>
    <meta http-equiv="refresh" content="3; url=category.php">';
} else {
    $row  = mysql_fetch_object($sql);
?>
<form action="" method="post">
	<div class="form-group">
		<label>Category Name</label>
		<input class="form-control" name="cat_name" id="cat_name" type="text" value="<?php echo $row->caption; ?>" required>
	</div>
	<div class="form-group">
		<label>Category Order</label>
		<input class="form-control" name="cat_order" id="cat_order"  value="<?php echo $row->sorting_order; ?>" type="text" required> 
	</div>
	<input type="hidden" name="id"  value="<?php echo $row->main_cat_id; ?>">
	<div class="form-group">
            <label>Image</label>
            <div class="input-group">
				<input type="text" id="fieldID" name="cat_img"  value="<?php echo $row->img; ?>" class="form-control" placeholder="Select image File">
					<span class="input-group-btn">
						<a href="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?type=1&field_id=fieldID&akey=<?php echo $config["key"] ?>" class="iframe-btn fancybox fancybox.iframe" ><button class="btn btn-default" type="button">Go!</button></a>
					</span>
			</div><!-- /input-group -->
    </div>
		<input type="submit" class="btn btn-success"  name="update" value="Update" />
	</form>
<?php } ?>