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
jQuery(document).ready(function($) {
    $('.iframe-btn').fancybox({
        'width': 880,
        'height': 570,
        'type': 'iframe',
        'autoScale': false,
        
    });
    $('.fieldID').on('change', function() {
        alert('change triggered');
    });
    //
    // Handles message from ResponsiveFilemanager
    //
    function OnMessage(e) {
            var event = e.originalEvent;
            // Make sure the sender of the event is trusted
            if (event.data.sender === 'responsivefilemanager') {
                if (event.data.field_id) {
                    var fieldID = event.data.field_id;
                    var url = event.data.url;
                    $('.' + fieldID).val(url).trigger('change');
                    //$.fancybox.close();
                    parent.$.fancybox.close();
                    // Delete handler of the message from ResponsiveFilemanager
                    $(window).off('message', OnMessage);
                }
            }
        }
        // Handler for a message from ResponsiveFilemanager
    $('.iframe-btn').on('click', function() {
        $(window).on('message', OnMessage);
    });
});
</script>
<!-- page start-->
        <div class="row">
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                      Setting View
                      <span class="tools pull-right">
                      </span>
                    </header>
                    <div class="panel-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
                               <img src="<?php echo $data->logo; ?>" alt=""/>
                           </div>
                       </div>
                       <div class="col-md-9">
                           <div class="profile-desk">
                               <h1><?php echo $data->cname; ?></h1>
                               <span class="text-muted">Company name</span>
                               <p>
                                  <?php echo $data->description; ?>
                               </p>
                           </div>
                       </div>
                    </div>
                </section>
            </div>
           	<div class="col-md-12">
           	<section class="panel">
                    <header class="panel-heading">
                      Setting
                      <span class="tools pull-right">
                      </span>
                    </header>
                    <div class="panel-body">
                    <div id="update-msg"></div>
                            <div id="settings" class="tab-pane ">
                                <div class="">
                                    <div class="prf-contacts sttng">
                                        <h2>  Personal Information </h2>
                                    </div>
                                    <form role="form" class="form-horizontal bucket-form">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label"> Avatar</label>
                                            <div class="col-lg-10">
                                            	<div class="input-group m-bot15">
					                                      <input ffpdm="2mwguuais5hl4eodn8j0ps" id="fieldID" class="form-control" value="<?php echo $data->logo; ?>" type="text">
					                                       <span class="input-group-btn">
					                                        <a href="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?type=1&field_id=fieldID&akey=<?php echo $config["key"] ?>" class="iframe-btn fancybox fancybox.iframe" >
                                                    <button class="btn btn-success" type="button">Select!</button>
                                                  </a>
					                                       </span>
					                                    </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Company</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->cname; ?>" id="cname" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Lives In</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->livein; ?>" id="lives-in" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Country</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " id="country" value="<?php echo $data->country; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Description</label>
                                            <div class="col-lg-10">
                                                <textarea rows="10" cols="30" id="description" class="form-control editor"  name=""><?php echo $data->description; ?></textarea>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="prf-contacts sttng">
                                        <h2> socail networks</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Facebook</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->facebook; ?>" id="facebook" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Twitter</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->twitter; ?>" id="twitter" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Google plus</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->google; ?>" id="google" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Flicr</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->flicr; ?>" id="flicr" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Youtube</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->youtube; ?>" id="youtube" class="form-control">
                                            </div>
                                        </div>

                                    </form>
                                    <div class="prf-contacts sttng">
                                        <h2>Contact</h2>
                                    </div>
                                    <form role="form" class="form-horizontal">
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Address 1</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->address; ?>" id="address" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Address 2</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->address2; ?>" id="address2" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Phone</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->phone; ?>" id="phone" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Cell</label>
                                            <div class="col-lg-10"> 
                                                <input type="text" placeholder=" " value="<?php echo $data->cell; ?>" id="cell" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Skype</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->skype; ?>" id="skype" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 control-label">Web unlock password</label>
                                            <div class="col-lg-10">
                                                <input type="text" placeholder=" " value="<?php echo $data->web_unlock_pass; ?>" id="web_unlock_pass" class="form-control">
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
              var editor = tinymce.get('description');
              var form_data = {
                logo: $('#fieldID').val(),
                livein: $('#lives-in').val(),
                cname: $('#cname').val(),
                country: $('#country').val(),
                description: editor.getContent(),
                facebook: $('#facebook').val(),
                twitter: $('#twitter').val(),
                google: $('#google').val(),
                flicr: $('#flicr').val(),
                youtube: $('#youtube').val(),
                address: $('#address').val(),
                address2: $('#address2').val(),
                phone: $('#phone').val(),
                cell: $('#cell').val(),
                skype: $('#skype').val(),
                web_unlock_pass: $('#web_unlock_pass').val(),
                ajex : '1',
                };
              $.ajax({
              url : "<?php echo $config['admin_url'] ?>ajex/update-setting.php",
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