<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
if (!isset($_GET['id'])) { redirect('products.php'); }else{
$id = mysql_real_escape_string($_GET['id']);
$queryprd = mysql_query("select * from products where prd_id = '$id'");
$qpf = mysql_fetch_object($queryprd);
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
		                      Edit Product
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    <a class="btn btn-success banner-add-button"  style="margin-top: -4px;color: white;" href="<?php echo $config['admin_url'] ?>products.php">Go Back</a>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             <?php 
		             if (isset($_POST['add_gallery_image'])) {
					             		$gal_image = $_POST['gal_image'];
					             		$id = $_GET['id'];
					             		$add_imageq = mysql_query("INSERT INTO `product-image`(`id`, `image`, `hash`) VALUES (NULL,'{$gal_image}','{$id}')");
					             		if ($add_imageq) {
					             			echo success(' Your New gallery image add successfully');
					             		}else{
					             			echo warning(' Please Retry');
					             		}
					             	}
					if (isset($_POST['IMGID'])) {
					             		$IMGID = mysql_real_escape_string($_POST['IMGID']);
					             		$galimgdel = mysql_query("DELETE FROM `product-image` WHERE `id` = '{$IMGID}'");
					             		if ($galimgdel) {
					             			echo success(' Your Image Delete successfully');
					             		}else{
					             			echo warning(' Please Retry');
					             		}
					             	}
		             ?>
		             	<!-- Contact Here -->
		             	<div role="tabpanel">
						  <!-- Nav tabs -->
						  <ul class="nav nav-tabs" role="tablist">
						    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Main</a></li>
						    <li role="presentation"><a href="#gallery" aria-controls="profile" role="tab" data-toggle="tab">Gallery</a></li>
						  </ul>
						  <!-- Tab panes -->
						  <div class="tab-content">
						    <div role="tabpanel" class="tab-pane active" id="home">
						    	<br>
						    	<?php 
					             	if (isset($_POST['add_prd'])) {
					             		if (empty($_POST['pro_name']) OR empty($_POST['art_no']) OR empty($_POST['sorting_order']) OR  empty($_POST['prd_dec']) OR empty($_POST['prd_image']) ) {
					             			echo warning(' Please Fill all Fields');
					             		}else{
							             		$pro_name  =  mysql_real_escape_string($_POST['pro_name']);
												$art_no = mysql_real_escape_string($_POST['art_no']);
												$prd_price = mysql_real_escape_string($_POST['prd_price']);
												$sorting_order = mysql_real_escape_string($_POST['sorting_order']);
												$pro_color = mysql_real_escape_string($_POST['pro_color']);
												$pro_size = mysql_real_escape_string($_POST['pro_size']);
												$pro_cat = explode('-', $_POST['pro_cat']);
												if (count($pro_cat) > 1) {
													$prd_main_cat = $pro_cat['0'];
													$prd_sub_cat = $pro_cat['1'];
												}else{
													$prd_main_cat = $qpf->main_cat_id;
													$prd_sub_cat = $_POST['pro_cat'];
												}
												$pro_stat = mysql_real_escape_string($_POST['pro_stat']);
												$pro_featur = mysql_real_escape_string($_POST['pro_featur']);
												$prd_dec = mysql_real_escape_string($_POST['prd_dec']);
												$prd_image = mysql_real_escape_string($_POST['prd_image']);
												$add_prd_q = mysql_query("UPDATE `products` SET `prd_name`='$pro_name',`prd_price`='$prd_price',`prd_dec`='$prd_dec', `prd_order`='$sorting_order',`prd_stat`='$pro_stat',`prd_featur`='$pro_featur',`prd_color`='$pro_color',`prd_art`='$art_no',`prd_size`='$pro_size',`prd_image` = '$prd_image',`main_cat_id` = '$prd_main_cat', `prd_cat`= '$prd_sub_cat' WHERE `prd_id` = '$id'");
												if($add_prd_q){
													echo success(' Your poduct update Success fully');
												}else{
													echo warning(mysql_error());
												}
											
										}
					             	}
					             	
					             	?>
						    	<form method="post">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <span class="field"><input type="text" value="<?php echo $qpf->prd_name; ?>" name="pro_name" class="form-control"  required/></span>
                                </div>
                                <div class="form-group">
                                    <label>Art No</label>
                                    <span class="field"><input type="text" value="<?php echo $qpf->prd_art; ?>" name="art_no" class="form-control"  required/></span>
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <span class="field"><input type="text" value="<?php echo $qpf->prd_price; ?>" name="prd_price" class="form-control"  required/></span>
                                </div>
                                <div class="form-group">
                                    <label>Sorting Order</label>
                                    <span class="field">
                                    <input type="text" name="sorting_order" value="<?php echo $qpf->prd_order; ?>" class="form-control"  required/></span>
                                </div>
                                <div class="form-group">
                                    <label>Product Color</label>
                                    <span class="field"><input type="text" value="<?php echo $qpf->prd_color; ?>" name="pro_color" class="form-control"  required/></span>
                                </div>
                                 <div class="form-group">
                                    <label>Product Size</label>
                                    <span class="field"><input type="text" value="<?php echo $qpf->prd_size; ?>" name="pro_size" class="form-control"  required/></span>
                                </div>
								<!-- image multy url -->               
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <div>
                                            	<div class="input-group m-bot15">
					                                <input  id="fieldID" class="form-control" value="<?php echo $qpf->prd_image; ?>" name="prd_image" required type="text">
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
                                    	<option value="<?php echo $qpf->prd_cat; ?>">Pleae Select if want to Change</option>
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
                                        <option value="<?php echo $qpf->prd_stat; ?>">Choose One</option>
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
                                        <option value="<?php echo $qpf->prd_featur; ?>">Choose One</option>
                                        <option value="0">no</option>
                                        <option value="1">yes</option>
                                    </select></span>
                                </div>
                         
                                <div class="form-group">
                                    <label>Product Discription</label>
                                    <span class="field"><textarea  class="editor"  name="prd_dec"><?php echo $qpf->prd_dec; ?></textarea></span> 
                                </div>
                                <div class="form-group">
									<input type="submit" class="btn btn-success" name="add_prd" value="Add Product">
                            		<input type="reset" class="btn btn-danget" value="Reset" /></span>
                                </div>
                    </form>
						    </div>
						    <div role="tabpanel" class="tab-pane" id="gallery">
						    <br>
						    <form   method="post" action="" enctype="multipart/form-data" >
								<!-- image multy url -->               
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <div>
                                            	<div class="input-group m-bot15">
					                                <input  id="GalleryImage" class="form-control" value="" name="gal_image" required type="text">
					                                   <span class="input-group-btn">
					                                        <a href="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?type=1&field_id=GalleryImage&akey=<?php echo $config["key"] ?>" class="iframe-btn fancybox fancybox.iframe" ><button class="btn btn-success" type="button">Select!</button></a>
					                                    </span>
					                            </div>
                                            </div>
                                        </div>
																<!-- end image multy url -->                                 
									<input type="submit" class="btn btn-success" name="add_gallery_image" value="Add Image">
								  </form>
								  <table class="table  table-hover general-table">
				                        <thead>
				                            <tr>
				                                <th>#</th>
				                                <th>Image</th>
				                                <th class="center">Delete</th>
				                            </tr>
				                        </thead>
				                        <tbody>
				                        <?php $get_all_record = mysql_query("SELECT * FROM `product-image` WHERE `hash` = '$id'") ;
				                        $i = 1;
				                        while ( $mainimg = mysql_fetch_assoc($get_all_record )):
				                        ?>
				                            <tr>
				                                <td class=""><?php echo $i; $i++; ?></td>
				                                <td class=""><a href="<?php echo $mainimg['image']; ?>" >View</a></td>
				                                <td class="center">
				                                <FORM method="post">
				                                   <input type="hidden" value="<?php echo $mainimg['id']; ?>" name="IMGID"> 
				                                   <input type="submit" class="btn" name="imgdelet" value="Delete">
				                                </FORM>
				                            </tr>
				                            <?php endwhile; ?>
				                        </tbody>
				                    </table>
						    </div>
						  </div>

						</div>
		             </div>
	             </section>
           	</div>
        </div>
<?php 
}
include('function/footer.ini.php');
?>