<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
        <div class="row">
           	<div class="col-md-12">
	           	<section class="panel">
	           	    <header class="panel-heading">
		                      News
		                    <span class="tools pull-right">
			                    <!-- spam -->
			                    <a class="btn btn-success banner-add-button" style="margin-top: -4px;color: white;" data-toggle="modal" href="#add_category">Add New News</a>
		                    </span>
		            	</header>
		             <div class="panel-body">
		             <?php 
		             if (isset($_POST['add_cat'])) {
						    $content = mysql_real_escape_string($_POST['content']);
						    $title = mysql_real_escape_string($_POST['title']);
						    $date = date('Y-m-d');
						    $q = mysql_query("INSERT INTO `news`(`id`, `title`, `date`, `content`) VALUES (NULL,'{$title}','{$date}','{$content}')");
						    if ($q) {
						        echo success(' Your New News Add');
						        echo '<meta http-equiv="refresh" content="4; url=news.php">';
						    }else{
						        echo error(mysql_error());
						    }
						}
					if (isset($_GET['delete'])) {
      						   $id = mysql_real_escape_string($_GET['delete']);
      						   $result = mysql_query("DELETE FROM `news` WHERE `id` = '{$id}'");
      						   if ($result == TRUE) {
      								echo success(' Your News Delete sussess fully');
      			            		echo '<meta http-equiv="refresh" content="2; url=news.php">';
      						   }else{
      						   		echo warning(' Please Try again');
      			            		echo '<meta http-equiv="refresh" content="2; url=news.php">';
      						   }
      						} // Delete Category
		             $maincats_rs = mysql_query("select * from news order by id");
	                    $total_record=mysql_num_rows($maincats_rs);
	                    if ($total_record == 0) {
	                       echo '<h1>No News Found!</h1>';
	                    }else{
	                    ?>
	                    <table class="table">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>News Title</th>
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
                            <td> <?php echo $maincats['title']?> </td>
                            <td class="center">
                            <a href="<?php echo $config['admin_url'] ?>news.php?delete=<?php echo $maincats['id']?>">
                               <button type="button" class="btn btn-danger"> Delete </button>
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
        <!-- (Add Ban Modal)-->
    <div class="modal fade" id="add_category">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-idden="true">&times;</button>
                    <h4 class="modal-title">Add New News</h4>
                </div>
                <div class="modal-body">
                <div id="add-msg"></div>
					<form action="" method="post">
					<div class="form-group">
						<label>News Title</label>
						<input class="form-control" name="title" id="title" type="text" required>
					</div>
					<div class="form-group">
						<label>News</label>
						<textarea class="form-control" id="content"  name="content" style="height:250px" required></textarea>
						
					</div>
					<input type="submit" class="btn btn-success" id="add_news" name="add_cat" value="Add Category" />
					</form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      $('#add_news').click(function(){
          var form_data = {
          title: $('#title').val(),
          content: $('#content').val(),
          ajex : '1',
            };
          $.ajax({
          url : "<?php echo $config['admin_url'] ?>ajex/add-news.php",
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