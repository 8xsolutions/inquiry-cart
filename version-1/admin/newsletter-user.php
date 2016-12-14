<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
        <div class="row">
           	<div class="col-md-12">
           	    <header class="panel-heading">
                      newsletter user
                    <span class="tools pull-right">
                      <a class="btn btn-success banner-add-button" style="margin-top: -4px;color: white;" data-toggle="modal" href="#add_user">add user</a>
                    </span>
                </header>
	           	<section class="panel">
		             <div class="panel-body">
                  <?php 
                    if (isset($_POST['add_user'])) {
                      if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['status'])) {
                        echo warning(" Please Fill all Filed");
                        echo '<meta http-equiv="refresh" content="2;url=newsletter-user.php">';
                      }else{
                        $name = mysql_real_escape_string($_POST['name']);
                        $email = mysql_real_escape_string($_POST['email']);
                        $status = mysql_real_escape_string($_POST['status']);
                        $hash = sha1($config['key'].time());
                        $check_record = mysql_query("SELECT * FROM `newsletter-user` WHERE `email` = '{$email}'");
                        if (mysql_num_rows($check_record) > 0) {
                          echo warning(' Email  Address is Already Exist');
                          echo '<meta http-equiv="refresh" content="2;url=newsletter-user.php">';
                        }else{
                            $add_Q = mysql_query("INSERT INTO `newsletter-user`(`id`, `name`, `email`, `status`, `hash`) VALUES (NULL,'{$name}','{$email}','{$status}','{$hash}')");
                            if ($add_Q) {
                             echo success(' New Email Address is Register');
                             echo '<meta http-equiv="refresh" content="2;url=newsletter-user.php">';
                            }else{
                             echo  warning(mysql_error());

                            }
                        }
                      }
                    } // end add new email address :)
                    // Delete user
                    if (isset($_GET['detete'])) {
                        $id  = (int) $_GET['delete'];
                        mysql_query("DELETE FROM `newsletter-user` WHERE id = '{$id}'");
                        echo success(' User Delete');
                        echo '<meta http-equiv="refresh" content="2;url=newsletter-user.php">';
                    } // end delete
                    // Update User
                    if (isset($_GET['activate']) AND isset($_GET['id'])) {
                      $status = (int) $_GET['activate'];
                      $id = (int) $_GET['id'];
                      mysql_query("update `newsletter-user` SET `status` = '{$status}' WHERE id = '{$id}'");
                      echo success(" Your Value is Update");
                      echo '<meta http-equiv="refresh" content="2;url=newsletter-user.php">';
                    }
                    // now featching Record
                    $get_recoed = mysql_query("SELECT * FROM `newsletter-user`");
                    if (mysql_num_rows($get_recoed) > 0) {
                      $i = 1;
                     ?>
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th class="center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php while ($br = mysql_fetch_object($get_recoed)): ?>
                                <tr>
                                  <td><?php echo $i; $i++; ?></td>
                                  <td><?php echo $br->name; ?></td>
                                  <td><?php echo $br->email; ?></td>
                                  <td><?php if($br->status == 1){ echo 'active'; }else{ echo 'Not Active'; } ?></td>
                                  <td class="center">
                                    <a href="<?php echo $config['admin_url'] ?>newsletter-user.php?delete=<?php echo $br->id;?>" class="btn btn-danger"> Delete</button> </a>
                                    <a href="<?php echo $config['admin_url'] ?>newsletter-user.php?activate=<?php if($br->status == 1){ echo '0'; }else{ echo '1'; } ?>&id=<?php echo $br->id;?>" class="btn btn-warning"> <?php  if($br->status == 1){ echo 'De Activate'; }else{ echo 'Active'; } ?></button> </a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>  
                            </tbody>
                            </table>
                    <?php
                    }else{
                      echo warning(' No user found');
                    }
                  ?>
		             	<!-- Contact Here -->
		             </div>
	             </section>
           	</div>
        </div>
        <!-- (add user  Modal)-->
        <div class="modal fade" id="add_user">
            <div class="modal-dialog">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">ADD NEW USER</h4>
                    </div>
                    <div class="modal-body" style"overflow:auto;">
                    <form action="" method="post">
                      <div class="form-group">
                        <label>User Name</label>
                        <input class="form-control" name="name" type="text" required>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" required> 
                      </div>
                      <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                          <option value="1"> Active </option>
                          <option value="0"> Not  Active </option>
                        </select>
                        
                      </div>
  
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-success" name="add_user" value="ADD USER" />
                    </form>
                    </div>
                </div>
            </div>
        </div>
<?php 
include('function/footer.ini.php');
?>