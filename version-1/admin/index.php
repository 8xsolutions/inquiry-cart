<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
		<!--mini statistics start-->
		<div class="row">
		    <div class="col-md-3">
		        <div class="mini-stat clearfix">
		            <span class="mini-stat-icon tar"><i class="fa fa-gavel"></i></span>
		            <div class="mini-stat-info">
		                <span><?php echo mysql_result(mysql_query("SELECT count('id') FROM `inquiry`"), 0); ?></span>
		                <a href="<?php echo $config['admin_url'] ?>inquiry.php">Total Inqueries</a>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="mini-stat clearfix">
		            <span class="mini-stat-icon orange"><i class="fa fa-ban"></i></span>
		            <div class="mini-stat-info">
		                <span><?php echo mysql_result(mysql_query("SELECT count('id') FROM `bans`"), 0); ?></span>
		                <a href="<?php echo $config['admin_url'] ?>ban.php">Ban Use</a>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="mini-stat clearfix">
		            <span class="mini-stat-icon pink"><i class="fa fa-square"></i></span>
		            <div class="mini-stat-info">
		                <span><?php echo mysql_result(mysql_query("SELECT count('id') FROM `products`"), 0); ?></span>
		               	<a href="<?php echo $config['admin_url'] ?>products.php">Total Products</a>
		            </div>
		        </div>
		    </div>
		    <div class="col-md-3">
		        <div class="mini-stat clearfix">
		            <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
		            <div class="mini-stat-info">
		                <span><?php echo mysql_result(mysql_query("SELECT count('id') FROM `visitors`"), 0); ?></span>
		                <a href="<?php echo $config['admin_url'] ?>visitors.php">Total Visitors</a>
		            </div>
		        </div>
		    </div>
		</div>
		<!--mini statistics end-->
		<!-- Dynamic Tabel -->
		  <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Dynamic Table
                        <span class="tools pull-right">

                         </span>
                    </header>
                    <div class="panel-body">
                    <!-- Main Body -->
                    </div>
                </section>
            </div>
        </div>
		<!-- Hacker Attack -->
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	   	<header class="panel-heading">
                        Hacker Attack
                        <span class="tools pull-right">
                        <!-- add Text -->
                        <a href="?p=delete-all" style="margin-top: -6px;color: white !important;" class="btn btn-danger">Delete all</a></center>
                         </span>
                    </header>
		             <div class="panel-body">
		             	<!-- Contact Here -->
		             	<?php
		             		if (isset($_GET['p']) AND $_GET['p'] == 'delete-all') {
		             			$query = mysql_query("TRUNCATE TABLE `hacker-attacks`");
		             			echo success(" All hacker attacks were removed successfully");
        						echo "<meta http-equiv=Refresh content=2;url=index.php>";
		             		}
		             		// Delete All Record
		             		if (isset($_GET['delete-id'])) {
							    $id    = (int) $_GET["delete-id"];
							    $query = mysql_query("DELETE FROM `hacker-attacks` where id='$id'");
							   	echo success(" The hacker attack was removed successfully");
							    echo "<meta http-equiv=Refresh content=2;url=index.php>";
							} // Delete Query
							$broinastranica = 20;
							$pageNum = 1;
							if (isset($_GET['page'])) {
							    $pageNum = $_GET['page'];
							}
							$redove = ($pageNum - 1) * $broinastranica;
							$sql    = "SELECT * FROM `hacker-attacks` ORDER by id DESC LIMIT $redove, $broinastranica";
							$result = mysql_query($sql) or die(mysql_error());
							$count = mysql_num_rows($result);
							if ($count <= 0) {
							    echo success(" There are no hacker attacks ");
							} else {
							// If Hacker Attack Found
							?>
							<table class="table  table-hover general-table">
								<thead>
									<tr>
										<th>#</th>
										<th>IP</th>
										<th>Date</th>
										<th>Type</th>
										<th class="center">Actions</th>
										</tr>
									</thead>
								<tbody>
								<?php
								$i = 1;
								// Showing Record If Exist
							    while ($hac_d = mysql_fetch_object($result)):
							   	?>
							     	<tr>
							     		<td><?php echo $i; $i++; ?></td>
										<td><?php echo $hac_d->ip; ?></td>
										<td><?php echo $hac_d->date; ?></td>
										<td><?php echo $hac_d->type; ?></td>
										<td class="center">
											<a  href="javascript:;" onclick="showAjaxModal('<?php echo $config['admin_url'] ?>hacker_detail.php?id=<?php echo $hac_d->id; ?>')" class="btn btn-primary"><i class="icon-eye-open icon-white"></i> Details</a>
											<a href="?delete-id=<?php echo $hac_d->id; ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</a>
										</td>
									 </tr>
								<?php
								   endwhile;
								?>
								</tbody>
							</table>
							<?php
								// Pagination
							    $query = "SELECT COUNT(id) AS numrows FROM `hacker-attacks`";
							    $result = mysql_query($query) or die('Error');
							    $row     = mysql_fetch_array($result, MYSQL_ASSOC);
							    $numrows = $row['numrows'];
							    $maxPage = ceil($numrows / $broinastranica);
							    $nomeranastranici = '';
								    echo '<ul class="pagination pagination-sm pull-right">';
								    for ($page = 1; $page <= $maxPage; $page++) {
								        if ($page == $pageNum) {
								            $nomeranastranici .= "<li><a href='?page=$page' class=\"btn\">$page</a></li>";
								        } else {
								            $nomeranastranici .= "<li><a href=\"?page=$page\" class=\"btn\">$page</a></li> ";
								        }
								    }
								    
								    if ($pageNum > 1) {
								        $page      = $pageNum - 1;
								        $predishna = "<li><a href=\"?page=$page\" class=\"btn\">Previous</a></li>";
								        
								        $parva = "<li><a href=\"?page=1\" class=\"btn\">First</a></li> ";
								    } else {
								        $predishna = ' ';
								        $parva     = ' ';
								    }
								    
								    if ($pageNum < $maxPage) {
								        $page       = $pageNum + 1;
								        $sledvashta = "<li><a href=\"?page=$page\" class=\"btn\">Next</a></li> ";
								        
								        $posledna = "<li><a href=\"?page=$maxPage\" class=\"btn\">Last</a> ";
								    } else {
								        $sledvashta = ' ';
								        $posledna   = ' ';
								    }
							    echo "" . $parva . $predishna . $nomeranastranici . $sledvashta . $posledna;
							    
							}
							?>
		             </div>
	             </section>
           	</div>
        </div>
    <script type="text/javascript">
	function showAjaxModal(url)
	{
		// SHOWING AJAX PRELOADER IMAGE
		jQuery('#modal_ajax .modal-body').html('<div style="text-align:center;margin-top:200px;"><img src="assets/images/preloader.gif" /></div>');
		
		// LOADING THE AJAX MODAL
		jQuery('#modal_ajax').modal('show', {backdrop: 'true'});
		
		// SHOW AJAX RESPONSE ON REQUEST SUCCESS
		$.ajax({
			url: url,
			success: function(response)
			{
				jQuery('#modal_ajax .modal-body').html(response);
			}
		});
	}
	</script>
    <!-- (Ajax Modal)-->
    <div class="modal fade" id="modal_ajax">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Detail</h4>
                </div>
                
                <div class="modal-body" style="overflow:auto;">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php 
include('function/footer.ini.php');
?>