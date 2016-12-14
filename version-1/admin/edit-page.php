<?php
$Page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
<!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/jquery-1.10.1.min.js"></script>
        <?php 
        ##############################################################################
        # Getting id and featch Record
        ##############################################################################
        if (!isset($_GET['id'])) { redirect($config['admin_url'].'page.php'); die(); }
        $id = mysql_real_escape_string($_GET['id']);
        $get_record = mysql_query("SELECT * FROM `page` WHERE `pid` = '{$id}'");
        if(mysql_num_rows($get_record) > 0){
          $row = mysql_fetch_object($get_record);
        ?>
<!-- Page start-->
        <div class="row">
           	<div class="col-md-12">
           	<section class="panel">
                    <header class="panel-heading">
                      Edit Page
                      <span class="tools pull-right">
                      <a class="btn btn-success banner-add-button" style="margin-top: -4px;color: white;" data-toggle="modal" href="<?php echo $config['admin_url'] ?>page.php">Go Back</a>
                      </span>
                    </header>
                    <div class="panel-body">
                    <div id="update-msg"></div>
                            <div id="settings" class="tab-pane ">
                                <div class="">
                                    <form role="form" class="form-horizontal bucket-form">
                                      
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Page name</label>
                                            <div class="col-lg-10">
                                                <input type="text" id="name"  value="<?php echo $row->pname; ?>" class="form-control">
                                                <input type="hidden" id="id" value="<?php echo mysql_real_escape_string($_GET['id']) ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Page Detail</label>
                                            <div class="col-lg-10">
                                                <textarea class="editor" id="detail"><?php echo $row->pcont; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-offset-2 col-lg-10">
                                                <button class="btn btn-primary" id="update-setting" type="submit">Save</button>
                                                <button class="btn btn-default" type="button">Cancel</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                            </div>
                    </div>
                </section>
            </div>
        </div>
      <script type="text/javascript">
      $('#update-setting').click(function(){
          var editor = tinymce.get('detail');
          var form_data = {
          name: $('#name').val(),
          id: $('#id').val(),
          detail: editor.getContent(),
          ajex : '1',
            };
          $.ajax({
          url : "<?php echo $config['admin_url'] ?>ajex/update-page.php",
           type :"POST",
          data: form_data,
          success: function(msg){
          $("#update-msg").html(msg);
             }
            });
           return false;
      });
    </script>
    <?php 
    }else{
      redirect($config['admin_url']);
    } 
  ?>
<?php 
include('function/footer.ini.php');
?>