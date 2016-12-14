<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $config['admin_url'] ?>theme/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/jquery-1.10.1.min.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/source/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript">
jQuery(document).ready(function ($) {
      $('.iframe-btn').fancybox({
              'width'   : 880,
              'height'  : 570,
              'type'    : 'iframe',
              'autoScale'   : false
      });
      
      $('.fieldID').on('change',function(){
          alert('change triggered');
      });

            //
            // Handles message from ResponsiveFilemanager
            //
            function OnMessage(e){
              var event = e.originalEvent;
               // Make sure the sender of the event is trusted
               if(event.data.sender === 'responsivefilemanager'){
                  if(event.data.field_id){
                    var fieldID=event.data.field_id;
                    var url=event.data.url;
                            $('.'+fieldID).val(url).trigger('change');
                            $.fancybox.close();

                            // Delete handler of the message from ResponsiveFilemanager
                            $(window).off('message', OnMessage);
                  }
               }
            }

          // Handler for a message from ResponsiveFilemanager
            $('.iframe-btn').on('click',function(){
              $(window).on('message', OnMessage);
            });

});
</script>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      category
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    <a class="btn btn-success banner-add-button"  style="margin-top: -4px;color: white;" data-toggle="modal" href="#add_category">New Category </a>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             	<!-- Contact Here -->
			            <?php
			            if (isset($_POST['update'])) {
			            	$name = mysql_real_escape_string($_POST['cat_name']);
			            	$order = mysql_real_escape_string($_POST['cat_order']);
			            	$img = mysql_real_escape_string($_POST['cat_img']);
			            	$id = mysql_real_escape_string($_POST['id']);
			            	$update_q = mysql_query("UPDATE `main_cats` SET `caption`='{$name}',`sorting_order`='{$order}',`img`='{$img}' WHERE `main_cat_id` = '{$id}'");
			            	if ($update_q) {
			            		echo success(' Your category update');
			            		echo '<meta http-equiv="refresh" content="2; url=category.php">';
			            	}else{
			            		echo warning(' Please Try again');
			            		echo '<meta http-equiv="refresh" content="2; url=category.php">';
			            	}
			            } // update category
			            if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['order'])) {
      						  $id = mysql_real_escape_string($_POST['mid']);
      						  $ORD = mysql_real_escape_string($_POST['sorting_order']);
      						   $Updateq = mysql_query("UPDATE main_cats set sorting_order= '{$ORD}' WHERE main_cat_id = '{$id}'");
      						   if ($Updateq) {
      						       # code...
      						    	echo success(' Your Sorting Order Update');
      			            		echo '<meta http-equiv="refresh" content="2; url=category.php">';
      						   }else{
      						    	echo warning(' Please Try again');
      			            		echo '<meta http-equiv="refresh" content="2; url=category.php">';
      						   }
      						} // update sorting order
      						if (isset($_GET['delete'])) {
      						   $id = mysql_real_escape_string($_GET['delete']);
      						   $result = del_main_cat($id);
      						   if ($result == TRUE) {
      								echo success(' Your Category Delete sussess fully');
      			            		echo '<meta http-equiv="refresh" content="2; url=category.php">';
      						   }else{
      						   		echo warning(' Please Try again');
      			            		echo '<meta http-equiv="refresh" content="2; url=category.php">';
      						   }
      						} // Delete Category
	                    $maincats_rs = mysql_query("select * from main_cats order by sorting_order");
	                    $total_record=mysql_num_rows($maincats_rs);
	                    if ($total_record == 0) {
	                       echo '<h1>No Catagory Found!</h1>';
	                    }else{
	                    ?>
	                    <table class="table">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Menu Name</th>
	                            <th>Sorting Order</th>
	                            <th>Sub Catagory</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>
                    <tbody>
                    <?php 
                    	$i = 1;
						while($maincats = mysql_fetch_array($maincats_rs)){
                     ?>
                      <tr>  
                      		  <td><?php echo $i; $i++;?></td>
                            <td><?php echo $maincats['caption']?></td>
                            <td>
                            	<form action="" method="post">
									<input type="text" class="form-control"  name="sorting_order" value="<?php echo $maincats['sorting_order']?>"  style="width: 77px;float: left;margin-right: 4px;" /> 
									<input type="hidden"  name="mid" value="<?php echo $maincats['main_cat_id']?>" />
									<input type="submit" value="Update" name="order" class="btn" />
								</form>
							</td>
                            <td>
                            <a href="<?php echo $config['admin_url'] ?>sub-category.php?id=<?php echo $maincats['main_cat_id']?>"><button type="button" class="btn btn_warning">Sub Crtagory</button></a>
                            </td>
                            <td class="center">
                            <a href="<?php echo $config['admin_url'] ?>category.php?delete=<?php echo $maincats['main_cat_id']?>">
                               <button type="button" class="btn btn-danger"> Delete </button>
                            </a>
                            <a  href="javascript:;" onclick="showAjaxModal('<?php echo $config['admin_url'] ?>edit-category.php?id=<?php echo $maincats['main_cat_id']?>')">
                                    <button type="button" class="btn btn-success"> Edit </button>
                            </a>
                            </td>
                        </tr>
                        <?php } ?>
                   </tbody>
                </table>
	                    <?php } ?>
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
                    <button type="button" class="close" data-dismiss="modal" aria-idden="true">&times;</button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body" style="overflow:auto;">
                
                    
                    
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
        <!-- (Add Ban Modal)-->
    <div class="modal fade" id="add_category">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-idden="true">&times;</button>
                    <h4 class="modal-title">Add New Main Category</h4>
                </div>
                <div class="modal-body">
                <div id="add-msg"></div>
					<form action="" method="post">
					<div class="form-group">
						<label>Category Name</label>
						<input class="form-control" name="name" id="cat_name" type="text" required>
					</div>
					<div class="form-group">
						<label>Category Order</label>
						<input class="form-control" name="order" id="cat_order" type="text" required> 
					</div>

					 <div class="form-group">
                        <label>Image</label>
                           <div class="input-group">
						      <input type="text" id="fieldID" class="form-control" placeholder="Select image File">
						      <span class="input-group-btn">
						        <a href="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?type=1&field_id=fieldID&akey=<?php echo $config["key"] ?>" class="iframe-btn fancybox fancybox.iframe" ><button class="btn btn-default" type="button">Go!</button></a>
						      </span>
						    </div><!-- /input-group -->
                    </div>
					<input type="submit" class="btn btn-success" id="add_cat" name="add_cat" value="Add Category" />
					</form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      $('#add_cat').click(function(){
          var form_data = {
          name: $('#cat_name').val(),
          order: $('#cat_order').val(),
          img: $('#fieldID').val(),
          ajex : '1',
            };
          $.ajax({
          url : "<?php echo $config['admin_url'] ?>ajex/add-category.php",
           type :"POST",
          data: form_data,
          success: function(msg){
          $("#add-msg").html(msg);
             }
            });
           return false;
      });
    </script>
<?php 
include('function/footer.ini.php');
?>