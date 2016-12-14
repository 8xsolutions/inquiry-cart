<?php
include 'data.php';
include('function/header.ini.php');
?>
<div class="col-md-12">
    <section class="panel">
                         <header class="panel-heading">
                      Manage Page
                      <span class="tools pull-right">
                      <a class="btn btn-success banner-add-button"  style="margin-top: -4px;color: white;" data-toggle="modal" href="<?php echo $config['admin_url'] ?>new-page.php">New Page</a>
                      </span>
                    </header>
        <div class="panel-body">
        	<div class="adv-table">
        	
                        <?php
                         if (isset($_GET['delete'])) {
                            $id = mysql_real_escape_string($_GET['delete']);
                            $delq = mysql_query("DELETE FROM `page` WHERE `pid` = '{$id}'");
                            if ($delq) {
                              echo success(' Your Item is Delete');
                              redirect($config['admin_url'].'page.php');
                            }else{
                              echo warning(mysql_error());
                            }
                          }
                        ##############################################################################
                          # checking travel deails is available ?
                        #############################################################################
                        $bq = mysql_query("SELECT * FROM `page`");
                        $i = 1;
                        if (mysql_num_rows($bq) > 0) {
                        ?> 
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>NAME</th>
                                <th class="center">ACTION</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php while ($br = mysql_fetch_object($bq)): ?>
                                <tr>
                                  <td><?php echo $i; $i++; ?></td>
                                  <td><?php echo $br->pname; ?></td>
                                  <td class="center">
                                  <a href="<?php echo $config['admin_url'] ?>edit-page.php?id=<?php echo $br->pid;?>" class="btn btn-default"><i class="fa fa-pencil"></i> Edit </a>
                                    <a href="<?php echo $config['admin_url'] ?>page.php?delete=<?php echo $br->pid;?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete </a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>  
                            </tbody>
                            </table>
                          <?php
                        }else{
                          echo warning(" No Page package found");
                        }
                        ?>
                    </div>
        </div>
    </section>
</div>
<?php 
include('function/footer.ini.php');
?>