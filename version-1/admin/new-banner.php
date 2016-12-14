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
              'height'  : 500,
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
                      New Banner
                      <span class="tools pull-right">
                      <a class="btn btn-success banner-add-button" style="margin-top: -4px;color: white;" data-toggle="modal" href="<?php echo $config['admin_url'] ?>banner.php">Go Back</a>
                      </span>
                    </header>
                    <div class="panel-body">
                       <div id="banner-msg"></div>
                      <form action="" method="post">
                        
                        <div class="form-group">
                            <label>Banner Name</label>
                            <span class="field"><input type="text"  id="name" class="form-control" name="bname" class="smallinput" required="required" /></span>
                        </div>
                         <div class="form-group">
                            <label>Banner Url</label>
                            <span class="field"><input type="text" id="url"  class="form-control" name="burl" class="smallinput" required="required" /></span>
                        </div>
                        <div class"form-group">
                            <label>Image</label>
                            <span class="field"><input id="fieldID"  class="form-control col-lg-10" name="bimg" type="text"  value=""></span>
                             <a href="<?php echo $config['admin_url'] ?>plugins/filemanager/dialog.php?type=1&amp;field_id=fieldID&akey=<?php echo $config["key"] ?>" class="btn iframe-btn" type="button">Select</a>
                        </div>
                      <span style="margin-top: 49px;display: block;"></span>
                      <div class="form-group">
                            <button type="submit" id="banneradd" name="add" class="btn"  name="submit">Add Now</button>
                            <input type="reset" class="btn reset radius2" value="Reset" />
                       </div>
                    </form>
                    </div>
                </section>
       <script type="text/javascript">
          $('#banneradd').click(function(){
              var form_data = {
                image: $('#fieldID').val(),
                name: $('#name').val(),
                url: $('#url').val(),
                ajex : '1',
                };
              $.ajax({
              url : "<?php echo $config['admin_url'] ?>ajex/add-banner.php",
               type :"POST",
              data: form_data,
              success: function(msg){
              $("#banner-msg").html(msg);
                 }
                });
               return false;
          });
        </script>
            </div>
        </div>
<?php 
include('function/footer.ini.php');
?>