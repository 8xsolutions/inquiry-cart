<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
    // How many page want to show
    $per_page = 20;
    // chek post number
    if(isset($_GET['catagary'])){
    	$catagary = $_GET['catagary'];
  		$check_post_num = mysql_query("SELECT count('prd_id') FROM products WHERE prd_cat = '$catagary'");
  	}else{
  		$check_post_num = mysql_query("SELECT count('prd_id') FROM products");
  	} 
    
    // return value 
    $total_page = ceil(mysql_result($check_post_num, 0) / $per_page); 
    // Geting Page
    $page = isset($_GET['page'])? $_GET['page'] : '1';
    // Our Next Value
    $next = ($page - 1) * $per_page;
    // Query
    if(isset($_GET['catagary'])){ 
  		$query = mysql_query("SELECT * FROM `products` WHERE prd_cat = '$catagary' LIMIT $next , $per_page"); // 10, 2 = next 10;
  	}else{
  		$query = mysql_query("SELECT * FROM `products` LIMIT $next , $per_page"); // 10, 2 = next 10;
  	}
  	if(isset($_GET['catagary'])){ 
  		$url= '?catagary='.$_GET['catagary'].'&';
  	}else{
  		$url = '?';
  	}  
?>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      products
		                    <span class="tools pull-right">
		                    <!-- spam -->
                    		<a class="btn btn-success banner-add-button"  style="margin-top: -4px;color: white;" data-toggle="modal" href="<?php echo $config['admin_url'] ?>new-product.php">New Product </a>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             <form action="" method="get">
			                    <select class="form-control"  style="width: 88%; float: left;" name="catagary">
			                            <?php
			                            $maincats_rs = mysql_query("SELECT * FROM `main_cats`");
			                            while($var = mysql_fetch_object($maincats_rs)){
			                            ?>
					                        <optgroup label="<?php echo $var->caption; ?>">
					                        	<?php 
					                        	$sub_cat = mysql_query("SELECT * FROM `sub_cats` WHERE `main_cat_id` = '$var->main_cat_id'");
					                        	while($sr = mysql_fetch_object($sub_cat)):
					                        	?>
					                        		<option value="<?php echo $sr->sub_cat_id ?>"> <?php echo $sr->caption; ?> </option>
					                        	<?php  endwhile; ?>
					                        </optgroup>
			                        	<?php } ?>
			                    </select> &nbsp;
			                    <button class="btn btn-success banner-add-button" >Apply Filter</button>
                    		</form>
		             	<!-- Contact Here -->
		             	<?php
						  	// Message Show
						  	if(isset($msg)){ echo $msg; }
						  	if (isset($_GET['delete-id'])) {
      						   $id = mysql_real_escape_string($_GET['delete-id']);
      						   $result = del_prd($id);
      						   if ($result == TRUE) {
      								echo success(' Your Category Delete sussess fully');
      			            		echo '<meta http-equiv="refresh" content="2; url=products.php">';
      						   }else{
      						   		echo warning(' Please Try again');
      			            		echo '<meta http-equiv="refresh" content="2; url=products.php">';
      						   }
      						} // Delete Category
						  	// post Show
						  		if (mysql_num_rows($query) > 0) {
						        $i = 1;
						     	?>
						      <table class="table  table-hover general-table">
		                        <thead>
		                            <tr>
		                                <th>#</th>
		                                <th>Product name</th>
		                                <th>Product image</th>
		                                <th>Products catagory</th>
		                                <th>Update Order</th>
		                                <th>Feature Product</th>
		                                <th>Product Status</th>
		                                <th>Product Action</th>
		                            </tr>
		                        </thead>
			                        <tbody>
				                        <?php
				                        $i = 1;
				                        while($row = mysql_fetch_object($query)){ 
			                            ?>
			                            <tr>
			                                <td><?php echo $i; $i++; ?></td>
			                                <td><?php echo $row->prd_name; ?></td>
			                                <td>
				                        		<a href="<?php echo $row->prd_image; ?>" target="blanck"> View </a>
			                        		</td>
				                             <td><?php 
				                             $cat = mysql_fetch_row(mysql_query("SELECT * FROM sub_cats WHERE sub_cat_id = '$row->prd_cat'"));
				                             echo $cat['2'];
				                             ?></td>
				                             <td><?php echo $row->prd_order; ?></td>
				                             <td><?php if($row->prd_featur > 0){echo 'Yes'; }else{ echo 'No'; } ?></td>
				                             <td><?php if($row->prd_stat > 0){ echo 'Active'; }else{  echo 'Not Active'; } ?></td>
				                             <td class="center">
												<a href="<?php echo $config['admin_url']; ?>product-edit.php?id=<?php echo $row->prd_id; ?>"  class="btn btn-primary">Edit</a>
												<a href="?delete-id=<?php echo $row->prd_id; ?>" class="btn btn-danger"> Delete </a>
											</td>
			                            </tr>
			                            <?php } ?>
			                        </tbody>
                    		</table>
						      <?php if ($total_page > 1): ?>
						      <nav style="float:right">
						        <ul class="pagination">
						          <?php 
						          for ($i=1; $i <= $total_page ; $i++) { 
						            echo '<li><a href="'.$url.'page='.$i.'">'.$i.'</a></li>';
						          }
						          ?>
						        </ul>
						      </nav>
						      <?php endif ?>
						      <?php
						      // if record is less then 1 or record is 0
						      }else{
						        echo '<h1>No Product Found</h1>';
						      }
						    ?>
		             </div>
	             </section>
           	</div>
        </div>
<?php 
include('function/footer.ini.php');
?>