<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      newsletter
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    <a class="btn btn-success banner-add-button"  style="margin-top: -4px;color: white;"  href="<?php echo $config['admin_url'] ?>">New</a>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             	<!-- Contact Here -->
		             </div>
	             </section>
           	</div>
        </div>
<?php 
include('function/footer.ini.php');
?>