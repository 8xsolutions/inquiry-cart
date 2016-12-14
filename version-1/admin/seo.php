<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/jquery-1.10.1.min.js"></script>
<!-- page start-->
        <div class="row">
           	<div class="col-md-12">
           	<section class="panel">
                    <header class="panel-heading">
                      Seo Setting
                      <span class="tools pull-right">
                      </span>
                    </header>
                    <div class="panel-body">

                    <div id="update-msg"></div>
                            <div id="settings" class="tab-pane ">
                                <div class="">
                                    <form role="form" class="form-horizontal bucket-form">
                                      
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Seo Title</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $s->title; ?>" id="title" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Seo Keyword</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $s->keyword; ?>" id="keyword" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Seo Description</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" id="description" class="form-control"  name=""><?php echo $s->description; ?></textarea>
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
              var form_data = {
                title: $('#title').val(),
                keyword: $('#keyword').val(),
                description: $('#description').val(),
                ajex : '1',
                };
              $.ajax({
              url : "<?php echo $config['admin_url'] ?>ajex/update-seo.php",
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
include('function/footer.ini.php');
?>