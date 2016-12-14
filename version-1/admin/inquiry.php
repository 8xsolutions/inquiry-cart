<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      Inquiry
		                    <span class="tools pull-right">
		                    <!-- spam -->
		                    <a href="<?php echo $config['admin_url']; ?>db-to-excel.php?tabel=inquiry" style="margin-top: -6px;color: white !important;" class="btn btn-danger">Export</a></center>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             	<!-- Contact Here -->
		             	<?php
						$inq=mysql_query("select * from inquiry");
						if(mysql_num_rows($inq) > 0 ){
						?>
						<table class="table  table-hover general-table">
                        <thead>
                            <tr>
                                <td class="head0 center">#</td>
                                <td class="head0 center">Name</td>
                                <td class="head1 center">Phone</td>
                                <td class="head0 center">Email</td>
                                <td class="head1 center">Art#</td>
                                <td class="head0 center">Date</td>
                                <td class="head1 center">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                           $i = 1;
						   while($rec=mysql_fetch_assoc($inq)){
						?>
		                   <tr>
		                        <td class="center"><?php echo $i; $i++; ?></td>
		                        <td class="center"><?php echo $rec['name'];?></td>
			                    <td class="center"><?php echo $rec['telephone'];?></td>
			                    <td class="center"><a href="mailto:<?php echo $rec['email'];?>"><?php echo $rec['email'];?></a></td>
			                    <td class="center"><?php echo $rec['prd_art'];?></td>
			                    <td class="center"><?php echo $rec['date'];?></td>
			                    <td class="center">
			                    	<a href="?delete=<?php echo $rec['id'];?>">
			                    		<input type="submit" class="btn btn-danger" value="Delete" >	
			                    	</a>
		                    	</td>
		                            </tr>
		                            <?php } ?>
		                        </tbody>
		                        </table>
						<?php
						}else{
							echo warning(" No Inqueries available at this time");
						}
						?>
		             </div>
	             </section>
           	</div>
        </div>
<?php 
include('function/footer.ini.php');
?>