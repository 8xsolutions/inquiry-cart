<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $config['admin_url'] ?>theme/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/jquery-1.10.1.min.js"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/jquery.mousewheel-3.0.6.pack.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/source/jquery.fancybox.js?v=2.1.5"></script>
<!--Core js-->
<script type="text/javascript">
    $(document).ready(function() {
      $('.fancybox').fancybox();
    });
</script>
<!-- page start-->
        <div class="row">
           	<div class="col-md-12">
           	<section class="panel">
                     <header class="panel-heading">
                      Banner
                      <span class="tools pull-right">
                      <a class="btn btn-success banner-add-button" style="margin-top: -4px;color: white;" data-toggle="modal" href="<?php echo $config['admin_url'] ?>new-banner.php">New Banner</a>
                      </span>
                    </header>
                    <div class="panel-body">
                    <?php
                      if (isset($_GET['delete'])) {
                        $lidr = mysql_real_escape_string($_GET['delete']);
                        $delete_link = mysql_query("DELETE FROM `banner` WHERE `id`='$lidr'");
                        if ($delete_link) {
                          echo success(' Banner delete successfully');
                        }else{
                          echo warning(mysql_error());
                        }
                         }

                    ?>
                    <div class="adv-table">
                        <?php 
                          ##############################################################################
                          # checking banner is available ?
                          #############################################################################
                        $bq = mysql_query("SELECT * FROM `banner`");
                        if (mysql_num_rows($bq) > 0) {
                          $i = 1;
                          ?> 
                        <table  class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Alt name</th>
                                <th>Url</th>
                                <th class="center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                              <?php while ($br = mysql_fetch_object($bq)): ?>
                                <tr>
                                  <td><?php echo $i; $i++; ?></td>
                                  <td><a href="<?php echo $br->image; ?>" class="fancybox" >Click</a></td>
                                  <td><?php echo $br->name; ?></td>
                                  <td><a href="<?php echo $br->url; ?>" targrt="blanck">Click</a></td>
                                  <td class="center">
                                    <a href="<?php echo $config['admin_url'] ?>banner.php?delete=<?php echo $br->id;?>">
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
                                    </a>
                                  </td>
                                </tr>
                              <?php endwhile; ?>  
                            </tbody>
                            </table>
                          <?php
                        }else{
                          echo warning("no Banner Found");
                        }
                        ?>
                    </div>
                    </div>
                </section>
            </div>
        </div>
<?php 
include('function/footer.ini.php');
?>