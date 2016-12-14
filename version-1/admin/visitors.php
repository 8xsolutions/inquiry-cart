<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      Visitors
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    <a href="?clean-history=ok" style="margin-top: -6px;color: white !important;" class="btn btn-danger">Clean History</a></center>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             	<!-- Contact Here -->
		             	<?php 
		             		if (isset($_GET['clean-history']) AND $_GET['clean-history'] == 'ok') {
		             			$query = mysql_query("TRUNCATE TABLE `visitors`");
		             			echo success(" All Visitors were removed successfully");
        						echo "<meta http-equiv=Refresh content=2;url=visitors.php>";
		             		}
		             		$clients = mysql_query("SELECT * FROM `visitors`");
		             		if (mysql_num_rows($clients) > 0) {
		             	?>
		             	<table class="table  table-hover general-table">
		                    <thead>
		                        <tr>
		                        	<th>#</th>
		                            <th>IP</th>
		                            <th>CITY</th>
		                            <th>COUNTRY</th>
		                            <th>CURRENCY SYMBOL</th>
		                            <th class="center"><b>COUNTRY CODE</b></th>
		                        </tr>
		                    </thead>
		                    <tbody>
								<?php $geoplugin = new geoPlugin();
								$i = 1;
								while ($ipdelclients  = mysql_fetch_assoc($clients)) {
								@$geoplugin->locate($ipdelclients['cip']);

									?>
			                        <tr>
			                        	<td><b><?php echo $i; $i++; ?></b></td>
			                            <td><?php echo $geoplugin->ip; ?></td>
			                            <td><?php echo $geoplugin->city; ?></td>
			                            <td><?php echo $geoplugin->countryName; ?></td>
			                            <td><?php echo $geoplugin->currencySymbol ?></td>
			                            <td class="center"><?php echo $geoplugin->currencyCode; ?></td>
			                        </tr>
		       					<?php } ?>                
		                    </tbody>
		                </table>
		                <?php }else { echo success(" No Visitor Found"); } ?>
		             </div>
	             </section>
           	</div>
        </div>
<?php 
include('function/footer.ini.php');
?>