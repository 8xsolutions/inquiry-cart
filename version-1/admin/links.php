<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?><!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/jquery-1.10.1.min.js"></script>
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/slug.js"></script>
<style type="text/css">
.float{
    width: 21%;
    float: left;
    margin-left: 5px;
  }
</style>
<!-- Page start-->
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                      Manage Links
                      <span class="tools pull-right">
                      <a class="btn btn-success banner-add-button" href="#add_link" style="margin-top: -4px;color: white;" data-toggle="modal">Add New Link</a>
                      </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table">
                            <?php 
                            if (isset($_POST['add_new'])) {
                                $linkname = mysql_real_escape_string($_POST['lname']);
                                $url = slug($linkname);
                                $link = mysql_real_escape_string($_POST['link']);
                                $page = mysql_real_escape_string($_POST['page']);
                                $add_new_link = mysql_query("INSERT INTO `links`(`lid`, `name`, `location`, `url`, `page`) VALUES ('','$linkname','$link','$url','$page')");
                                if ($add_new_link) {
                                    echo success('new links create successfully');
                                }else{
                                    echo warning(mysql_error());
                                }
                            }
                         if (isset($_GET['delete'])) {
                            $id = mysql_real_escape_string($_GET['delete']);
                            $delq = mysql_query("DELETE FROM `links` WHERE `lid` = '{$id}'");
                            if ($delq) {
                              echo success(' Your Item is Delete');
                              redirect($config['admin_url'].'links.php');
                            }else{
                              echo warning(mysql_error());
                            }
                          }
                        ##############################################################################
                          # checking travel deails is available ?
                        #############################################################################
                        $bq = mysql_query("SELECT * FROM `links`");
                        $i = 1;
                        if (mysql_num_rows($bq) > 0) {
                        ?> 
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Link Name</th>
                                <th>Link</th>
                                <th>Location</th>
                                <th>Link's Page</th>
                                <th class="center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php while ($br = mysql_fetch_object($bq)): ?>
                                <tr>
                                  <td><?php echo $i; $i++; ?></td>
                                  <td><?php echo $br->name; ?></td>
                                  <td><a href="<?php echo $br->url; ?>" target="blank">Visit Link</a></td>
                                 <td><?php echo $br->location; ?></td>
                                 <td>
                                     <?php
                                     $pq = mysql_query("select `pname` from page where `pid` = $br->page");
                                     if (mysql_num_rows($pq) > 0) {
                                        $pge = mysql_fetch_object($pq);
                                        echo $pge->pname;
                                     }else{
                                        echo "Page Delete";
                                     }
                                     
                                     ?>
                                 </td>
                                  <td class="center">
                                    <a href="<?php echo $config['admin_url'] ?>links.php?delete=<?php echo $br->lid;?>" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete </a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>  
                            </tbody>
                            </table>
                          <?php
                        }else{
                          echo warning(" No Lins found");
                        }
                        ?>
                    </div>
                    </div>
                </section>
            </div>
        </div>  
        <!-- (Add Ban Modal)-->
    <div class="modal fade" id="add_link">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">New Link</h4>
                </div>
                <div class="modal-body" style="overflow:auto;">
          <form action="" method="post">
          <div class="form-group">
            <label>Link name like (about)</label>
            <input class="form-control"  name="lname" placeholder="" type="text">
          </div>
          <div class="form-group">
            <label>Link Location</label>
            <select class="form-control" name="link">
             <?php foreach ($links as $key => $value): ?>
                <option value="<?php echo $value;?>"><?php echo $key;?></option>
            <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Select page</label>
            <select class="form-control" name="page">
                <option value="">Select page</option>
                  <?php 
                   $links_re = mysql_query("select * from page");
                   while ($row= mysql_fetch_object($links_re)): 
                  ?>
                    <option value="<?php echo $row->pid;?>"><?php echo $row->pname;?></option>
                  <?php endwhile; ?>
               </select>
          </div>
          <input type="submit" class="btn red" name="add_new" value="Add Link" />
          </form>
                </div>
                
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>           
<?php 
include('function/footer.ini.php');
?>