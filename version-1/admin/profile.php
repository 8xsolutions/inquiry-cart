<?php
$page = 'Dashboard';
include 'data.php';
include('function/header.ini.php');
?>
<link rel="stylesheet" type="text/css" href="<?php echo $config['admin_url'] ?>theme/source/jquery.fancybox.css?v=2.1.5" media="screen" />
<!-- Add jQuery library -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/lib/jquery-1.10.1.min.js"></script>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/source/jquery.fancybox.js?v=2.1.5"></script>
<script type="text/javascript">
jQuery(document).ready(function ($) {
      $('.iframe-btn').fancybox({
              'width'   : 880,
              'height'  : 570,
              'type'    : 'iframe',
              'autoScale'   : false
      });
      
      $('.fieldID').on('change',function(){
          alert('change triggered');
      });

            //
            // Handles message from ResponsiveFilemanager
            //
            function OnMessage(e){
              var event = e.originalEvent;
               // Make sure the sender of the event is trusted
               if(event.data.sender === 'responsivefilemanager'){
                  if(event.data.field_id){
                    var fieldID=event.data.field_id;
                    var url=event.data.url;
                            $('.'+fieldID).val(url).trigger('change');
                            $.fancybox.close();

                            // Delete handler of the message from ResponsiveFilemanager
                            $(window).off('message', OnMessage);
                  }
               }
            }

          // Handler for a message from ResponsiveFilemanager
            $('.iframe-btn').on('click',function(){
              $(window).on('message', OnMessage);
            });

});
</script>
<!-- page start-->
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                      profile view
                      <span class="tools pull-right">
                      </span>
                    </header>
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
                               <img src="<?php echo $u->image; ?>" alt=""/>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <div class="profile-desk">
                               <h1><?php echo $u->name; ?></h1>
                               <span class="text-muted">Administrator</span>
                               <p>
                                  <?php echo $u->about; ?>
                               </p>
                           </div>
                       </div>
                    </div>
                </section>
            </div>
           	<div class="col-md-12">
           	<section class="panel">
                    <header class="panel-heading">
                      Profile Setting
                      <span class="tools pull-right">
                      </span>
                    </header>
                    <div class="panel-body">
                    <div id="update-msg"></div>
                            <div id="settings" class="tab-pane ">
                                <div class="">
                                    <div class="prf-contacts sttng">
                                        <h2>  Personal Information</h2>
                                    </div>
                                    <form role="form" class="form-horizontal bucket-form">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Image</label>
                                            <div class="col-lg-10">
                                            	<div class="input-group m-bot15">
					                                <input ffpdm="2mwguuais5hl4eodn8j0ps" id="fieldID" class="form-control" value="<?php echo $u->image; ?>" type="text">
					                                   <span class="input-group-btn">
					                                        <a href="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?type=1&field_id=fieldID&akey=<?php echo $config["key"] ?>" class="iframe-btn fancybox fancybox.iframe" ><button class="btn btn-success" type="button">Select!</button></a>
					                                    </span>
					                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Name</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $u->name; ?>" id="name" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">User</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $u->user; ?>" id="user" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Email</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $u->email; ?>" id="email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">About User</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" id="about" class="form-control editor"  name=""><?php echo $u->about; ?></textarea>
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
              var editor = tinymce.get('about');
              var form_data = {
                image: $('#fieldID').val(),
                name: $('#name').val(),
                user: $('#user').val(),
                email: $('#email').val(),
                about: editor.getContent(),
                ajex : '1',
                };
              $.ajax({
              url : "<?php echo $config['admin_url'] ?>ajex/update-profile.php",
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