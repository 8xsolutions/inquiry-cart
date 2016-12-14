<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
<style type="text/css">
	iframe{
		border:0px;
	}
	.panel-body {
     padding: 0px !important;
     background-color: rgb(236, 236, 236);
	}
</style>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      filemanager
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    </span>
		            	</header>
		             <div class="panel-body">
						<iframe src="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?akey=<?php echo $config["key"] ?>" width="100%" height="600"></iframe>
		             </div>
	             </section>
           	</div>
        </div>
<?php 
include('function/footer.ini.php');
?>