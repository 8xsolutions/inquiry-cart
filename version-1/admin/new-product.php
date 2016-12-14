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
		                      Add New Product
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    <a class="btn btn-success banner-add-button"  style="margin-top: -4px;color: white;" href="<?php echo $config['admin_url'] ?>products.php">Go Back</a>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             	<!-- Contact Here -->
		             	<?php 

		             	if (isset($_POST['add_prd'])) {
		             		if (empty($_POST['pro_name']) OR empty($_POST['art_no']) OR empty($_POST['sorting_order']) OR  empty($_POST['prd_dec']) OR empty($_POST['prd_image']) ) {
		             			echo warning(' Please Fill all Fields');
		             		}else{
		             			$art_no = mysql_real_escape_string($_POST['art_no']);
		             			$check = mysql_query("SELECT * FROM `products` WHERE `prd_art` = '$art_no'");
		             			if (mysql_num_rows($check) > 0) {
		             				warning(' This Product is already Exist');
		             			}else{

				             		$pro_name  =  mysql_real_escape_string($_POST['pro_name']);
      									$art_no = mysql_real_escape_string($_POST['art_no']);
      									$prd_price = mysql_real_escape_string($_POST['prd_price']);
      									$sorting_order = mysql_real_escape_string($_POST['sorting_order']);
      									$pro_size = mysql_real_escape_string($_POST['pro_size']);
      									$pro_cat = explode('-', $_POST['pro_cat']);
      									$prd_main_cat = $pro_cat['0'];
      									$prd_sub_cat = $pro_cat['1'];
      									$pro_stat = mysql_real_escape_string($_POST['pro_stat']);
      									$pro_featur = mysql_real_escape_string($_POST['pro_featur']);
      									$prd_dec = mysql_real_escape_string($_POST['prd_dec']);
      									$extra_detail =  mysql_real_escape_string($_POST['extra_detail']);
      									$prd_image = mysql_real_escape_string($_POST['prd_image']);
      									$add_prd_q = mysql_query("INSERT INTO `products`(`prd_id`, `prd_name`, `prd_price`,  `prd_dec`,  `prd_cat`, `prd_order`, `prd_stat`, `prd_featur`,  `prd_art`, `prd_size`, `main_cat_id`, `prd_image`) VALUES  (NULL,'{$pro_name}','{$prd_price}','{$prd_dec}','{$prd_sub_cat}','{$sorting_order}','{$pro_stat}','{$pro_featur}','{$art_no}','{$pro_size}','{$prd_main_cat}','{$prd_image}')");
      									if($add_prd_q){
      										echo success(' Your poduct add Success fully');
      									}else{
      										echo warning( mysql_error());
      									}
								}
							}
		             	}
		             	?>
		             	 <form method="post">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <span class="field"><input type="text" name="pro_name" class="form-control"  required/></span>
                                </div>
                                <div class="form-group">
                                    <label>Art No</label>
                                    <span class="field"><input type="text" name="art_no" class="form-control"  required/></span>
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <span class="field"><input type="text" name="prd_price" class="form-control"  required/></span>
                                </div>
                                <div class="form-group">
                                    <label>Sorting Order</label>
                                    <span class="field">
                                    <input type="text" name="sorting_order" class="form-control"  required/></span>
                                </div>
                                 <div class="form-group">
                                    <label>Product Size</label>
                                    <span class="field"><input type="text" name="pro_size" class="form-control"  required/></span>
                                </div>
								<!-- image multy url -->               
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <div>
                                            	<div class="input-group m-bot15">
					                                <input  id="fieldID" class="form-control" value="" name="prd_image" required type="text">
					                                   <span class="input-group-btn">
					                                        <a href="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?type=1&field_id=fieldID&akey=<?php echo $config["key"] ?>" class="iframe-btn fancybox fancybox.iframe" ><button class="btn btn-success" type="button">Select!</button></a>
					                                    </span>
					                            </div>
                                            </div>
                                        </div>
								<!-- end image multy url -->                   
                                <div class="form-group">
                                    <label>Product Catagory</label>
                                    <span class="field">
                                    <select name="pro_cat" class="form-control"  required>
                                  <?php
			                            $maincats_rs = mysql_query("SELECT * FROM `main_cats`");
			                            while($var = mysql_fetch_object($maincats_rs)){
			                            ?>
					                        <optgroup label="<?php echo $var->caption; ?>">
					                        	<?php 
					                        	$sub_cat = mysql_query("SELECT * FROM `sub_cats` WHERE `main_cat_id` = '$var->main_cat_id'");
					                        	while($sr = mysql_fetch_object($sub_cat)):
					                        	?>
					                        		<option value="<?php echo $var->main_cat_id.'-'.$sr->sub_cat_id ?>"> <?php echo $sr->caption; ?> </option>
					                        	<?php  endwhile; ?>
					                        </optgroup>
			                        	<?php } ?>
                                    </select>
                                    </span>
                                </div>
                                 <div class="form-group">
                                    <label>Product Status
                                    </label>
                                    <span class="field">
                                    <select class="form-control" name="pro_stat"  required>
                                        <option value="0">Choose One</option>
                                        <option value="0">Not Available</option>
                                        <option value="1">Available</option>
                                    </select>
                                    </span>
                                </div>
                                <div class="form-group">
                                    <label>Feature Product
                                    </label>
                                    <span class="field">
                                    <select name="pro_featur" class="form-control" required>
                                        <option value="0">Choose One</option>
                                        <option value="0">no</option>
                                        <option value="1">yes</option>
                                    </select></span>
                                </div>
                         
                                <div class="form-group">
                                    <label>Product Discription</label>
                                    <span class="field"><textarea  class="editor"  name="prd_dec"></textarea></span> 
                                </div>
                                <div class="form-group">
                                    <label>Extra Product Discription</label>
                                    <span class="field"><textarea  class="editor"  name="extra_detail"></textarea></span> 
                                </div>
                                
                                <div class="form-group">
									<input type="submit" class="btn btn-success" name="add_prd" value="Add Product">
                            		<input type="reset" class="btn btn-danget" value="Reset" /></span>
                                </div>
                    </form>
		             </div>
	             </section>
           	</div>
        </div>
<?php 
include('function/footer.ini.php');
?>