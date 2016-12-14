<?php
include('function/config.ini.php');
include('function/db.ini.php');
include('function/function.ini.php');
include('function/setting.ini.php');
$id = (int) $_GET['id'];
if (empty($id) || !isset($id)) {
    echo '<meta http-equiv="refresh" content="0; url=ban.php">';
}
$sql = mysql_query("SELECT * FROM `bans` WHERE id='$id'");
if (mysql_num_rows($sql) == 0) {
	echo success("No such ban");
    echo '<meta http-equiv="refresh" content="3; url=ban.php">';
} else {
    $row = mysql_fetch_assoc($sql);
?>
<form action="" method="post">
	<div class="form-group">
		<label>IP Address</label>
		<input class="form-control" name="ip" type="text" value="<?php echo $row['ip']; ?>">
	</div>
	<div class="form-group">
		<label>Date: <span class="badge bg-success"><?php echo $row['date']; ?></span></label>
	</div>
	<div class="form-group">
		<label>Banned by: <span class="badge bg-warning"><?php echo $row['bannedby']; ?></span></label>
	</div>
	<div class="form-group">
		<label>Reason</label>
		<input class="form-control" name="ban_id" type="hidden" value="<?php echo $row['id'];?>">
		<input class="form-control" name="reason" type="text" value="<?php echo $row['reason'];?>">
	</div>
	<div class="form-group">
		<label>Redirecting to another page or site: <?php
	    echo $row['redirect'];
	?></label><br />
	    <select class="form-control" name="redirect">
	        <option value="No">No</option>
	        <option value="Yes">Yes</option>
	    </select>
	</div>
	<div class="form-group">
		<label>Redirect URL</label>
		<input class="form-control" name="url" type="text" value="<?php echo $row['url']; ?>">
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update" value="Update" />
		<a href="<?php echo $config['admin_url'] ?>ban.php?delete-id=<?php echo $row['id']; ?>" class="btn btn-danger">Unban</a>
	</div>
</form>
<?php } // end else ?>