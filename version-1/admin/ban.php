<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      Ban Country
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    <a class="btn btn-success banner-add-button" href="#bancountry" style="margin-top: -4px;color: white;" data-toggle="modal">Ban Country</a>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             <?php 
		             if (isset($_POST['add_cont'])) {
		             	$country = mysql_real_escape_string($_POST['country']);
		             	$add_country = mysql_query("INSERT INTO `ban-country`(`id`, `country`) VALUES (NULL,'{$country}')");
		             	if ($add_country) {
		             		echo success( " You ban this $country");
		             	}else{
		             		echo warning(' PLease Try again');
		             	}
		             } 
                      if (isset($_GET['delete-country'])) {
                        $lidr = mysql_real_escape_string($_GET['delete-country']);
                        $delete_link = mysql_query("DELETE FROM `ban-country` WHERE `id`='$lidr'");
                        if ($delete_link) {
                          echo success(' Country delete successfully');
                          echo '<meta http-equiv="refresh" content="2; url=ban.php">';
                        }else{
                          echo warning(mysql_error());
                        }
                         }

                    ?>
                    <div class="adv-table">
                        <?php 
                          ##############################################################################
                          # checking banner is available ?
                          #############################################################################
                        $bq = mysql_query("SELECT * FROM `ban-country`");
                        if (mysql_num_rows($bq) > 0) {
                          $i = 1;
                          ?> 
                        <table  class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Country</th>
                                <th class="center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php while ($br = mysql_fetch_object($bq)): ?>
                                <tr>
                                  <td><?php echo $i; $i++; ?></td>
                                  <td><?php echo $br->country; ?></td>
                                  <td class="center">
                                    <a href="<?php echo $config['admin_url'] ?>ban.php?delete-country=<?php echo $br->id;?>">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                                    </a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>  
                            </tbody>
                            </table>
                          <?php
                        }else{
                          echo warning("no Ban Country Found");
                        }
                        ?>
		             	<!-- Contact Here -->
		             </div>
	             </section>
           	</div>
        </div>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	     <header class="panel-heading">
                      Ban User
                      <span class="tools pull-right">
                      <a class="btn btn-success banner-add-button" href="#add_ban" style="margin-top: -4px;color: white;" data-toggle="modal">Add Ban</a>
                      </span>
                    </header>
		             <div class="panel-body">
		            <!-- Contact Here -->
					<?php
						// Add Ban
						if (isset($_POST['add_ban'])) {
						    $ip       = addslashes(htmlspecialchars($_POST['ip']));
						    $months   = array(
						        "",
						        "January",
						        "February",
						        "March",
						        "April",
						        "May",
						        "June",
						        "July",
						        "August",
						        "September",
						        "October",
						        "November",
						        "December"
						    );
						    $date     = date('d', time()) . ' ' . $months[date('n', time())] . ' ' . date('Y', time());
						    $reason   = addslashes(htmlspecialchars($_POST['reason']));
						    $redirect = $_POST['redirect'];
						    $url      = addslashes(htmlspecialchars($_POST['url']));
						    $bannedby = $_SERVER['REMOTE_ADDR'];
						    if ($ip == NULL OR $reason == NULL) {
						    	echo warning(" Please Fill IP Address and Reason For ban Ip address");
						        echo '<meta http-equiv="refresh" content="2;url=ban.php">';
						    }
						    $queryvalid = mysql_query("SELECT * FROM `bans` WHERE ip='$ip' LIMIT 1");
						    $validator  = mysql_num_rows($queryvalid);
						    if ($validator > "0") {
						    	echo warning(" Ip Address is already Ban");
						        echo '<meta http-equiv="refresh" content="2;url=ban.php">';
						    } else {
						        $query = mysql_query("INSERT INTO `bans` (ip, date, reason, redirect, url, bannedby) VALUES('$ip', '$date', '$reason', '$redirect', '$url', '$bannedby')");
						        echo success(" The IP Adress was successfully banned!");
						        echo "<meta http-equiv=Refresh content=2;url=ban.php>";
						    }
						} // end add ban ip
						// if update
					    if (isset($_POST['update'])) {
					        $ip       = addslashes(htmlspecialchars($_POST['ip']));
					        $reason   = addslashes(htmlspecialchars($_POST['reason']));
					        $redirect = $_POST['redirect'];
					        $ban_id = $_POST['ban_id'];
					        $url      = addslashes(htmlspecialchars($_POST['url']));
					        $update   = "UPDATE bans SET ip='$ip', reason='$reason', redirect='$redirect', url='$url' WHERE id='$ban_id'";
					        $sql      = mysql_query($update);
					        echo success(" The ban was successfuly updated");
					        echo '<meta http-equiv="refresh" content="2;url=ban.php">';
					    } // end Update
						// Delete Ban Function
						if (isset($_GET['delete-id'])) {
						    $id    = (int) $_GET["delete-id"];
						    $query = mysql_query("DELETE FROM `bans` where id='{$id}'");
						    echo success(" The ban was removed successfully");
						    echo "<meta http-equiv=Refresh content=2;url=ban.php>";
						} // End Delete Function
						$broinastranica = 15;
						$pageNum        = 1;
						if (isset($_GET['page'])) {
						    $pageNum = $_GET['page'];
						}
						if (!is_numeric($pageNum)) {
						    die("Error <script type='text/javascript'>window.location = 'index.php'</script>");
						}
						$redove = ($pageNum - 1) * $broinastranica;
						$sql    = "SELECT * FROM bans ORDER by id DESC LIMIT $redove, $broinastranica";
						$result = mysql_query($sql);
						$count  = mysql_num_rows($result);
						if ($count <= 0) {
						    echo success(" There are no bans.");
						} else {
						// if some in record then show this error
						?>
						<table class="table  table-hover general-table">
							<thead>
								<tr>
									<th>#</th>
									<th>IP</th>
									<th>Date</th>
									<th>Redirect</th>
									<th class="center">Actions</th>
								</tr>
						    </thead>
							<tbody>
							<?php
							$i = 1;
							// whie loop
						    while ($row = mysql_fetch_object($result)):
						    ?>
						     <tr>
						     	<td><?php echo $i; $i++; ?></td>
								<td><?php echo $row->ip; ?></td>
								<td><?php echo $row->date; ?></td>
								<td><?php echo $row->redirect; ?></td>
								<td class="center">
									<a href="javascript:;" onclick="showAjaxModal('<?php echo $config['admin_url'] ?>ban_detail.php?id=<?php echo $row->id; ?>')" class="btn btn-primary"><i class="icon-eye-open icon-white"></i> Details</a>
									<a href="?delete-id=<?php echo $row->id; ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i> Delete</a>
								</td>
							 </tr>
							<?php endwhile; ?>
						     </tbody>
						</table>
						<?php
						// Pagination
					    $query = "SELECT COUNT(id) AS numrows FROM `bans`";
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
                    <h4 class="modal-title">Ban Detail</h4>
                </div>
                
                <div class="modal-body" style="overflow:auto;">
                
                    
                    
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
   <!-- (Add Ban Modal)-->
    <div class="modal fade" id="add_ban">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Add Ban</h4>
                </div>
                
                <div class="modal-body" style="overflow:auto;">
					<form action="" method="post">
					<div class="form-group">
						<label>IP Address</label>
						<input class="form-control" name="ip" type="text" required>
					</div>
					<div class="form-group">
						<label>Reason</label>
						<input class="form-control" name="reason" type="text" required> 
					</div>
					<div class="form-group">
						<label>Redirecting to another page or site</label>
					    <select class="form-control" name="redirect">
					        <option value="No" selected>No</option>
					        <option value="Yes">Yes</option>
					    </select>
					</div>
					<div class="form-group">
						<label>Redirect URL</label>
						<input class="form-control" name="url" type="text">
					</div>
					<input type="submit" class="btn red" name="add_ban" value="Ban" />
					</form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="bancountry">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Country Ban</h4>
                </div>
                
                <div class="modal-body" style="overflow:auto;">
					<form action="" method="post">
					<div class="form-group">
						<label>Country Name</label>
						<input class="form-control" name="country" type="text" required>
					</div>
					<input type="submit" class="btn red" name="add_cont" value="Ban Country" />
					</form>
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