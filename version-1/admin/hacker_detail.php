<?php
include('function/config.ini.php');
include('function/db.ini.php');
include('function/function.ini.php');
include('function/setting.ini.php');
$id = (int) $_GET['id'];
if (empty($id)) {
    echo '<meta http-equiv="refresh" content="0; url=index.php">';
}
$sql = mysql_query("SELECT * FROM `hacker-attacks` WHERE id = '$id'");
if (mysql_num_rows($sql) == 0) {
    echo 'No such hacking attack<meta http-equiv="refresh" content="3; url=index.php">';
} else {
    $row  = mysql_fetch_assoc($sql);
    $type = $row['type'];
?>
<h4>Information about the hacker</h4>
<ul class="nav nav-pills nav-stacked">
    <li><a href="javascript:;"> IP:<span class="pull-right r-activity"><b><?php  echo $row['ip']; ?></b></span></a></li>
    <li><a href="javascript:;"> Date: <span class="pull-right r-activity"><b><?php echo $row['date']; ?></b></span></a></li>
    <li><a href="javascript:;"> Type: <span class="pull-right r-activity"><b><?php  echo $row['type']; ?></b></span></a></li>
</ul>
<div class="nav-stacked">
<b>Broswer and Operation System:</b> <br><?php echo $row['browseros']; ?><br>
<b>Operation system language:</b><br><?php  echo $row['oslanguage']; ?><br />
<?php
    if ($type == "SQL Injection") {  echo '<hr /><h4>Attacked file</h4> ' . $row['file'] . '<br />'; }
?>
</div>
<hr />
<a href="index.php?delete-id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</a>
<?php } ?>