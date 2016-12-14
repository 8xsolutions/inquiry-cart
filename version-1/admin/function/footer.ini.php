	</section> <!-- ./wrapper ./site-min-height -->
</section> <!-- ./main-contant -->
<!--main content end-->
</section>
<!-- Placed js at the end of the document so the pages load faster -->
<!-- Modal -->
<div class="modal fade" id="changepass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Your Password</h4>
      </div>
      <div class="modal-body">
        <form>
            <?php if(isset($msg)) echo $msg; ?>
            <div id="login-msg"></div>
                <input type="password" class="form-control" id="passone" placeholder="Password" autofocus>
                <br>
                <input type="password" class="form-control" id="passtwo" placeholder="Again Password">
                <br>
                <input type="hidden" class="form-control" id="hash" value="<?php echo $u->id; ?>" placeholder="Password">
                <button class="btn btn-lg btn-login btn-block" id="reset" type="submit">Change</button>
      </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<script src="<?php echo $config['admin_url'] ?>theme/js/jquery.js"></script>
<script src="<?php echo $config['admin_url'] ?>theme/bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo $config['admin_url'] ?>theme/js/jquery.scrollTo.min.js"></script>
<script src="<?php echo $config['admin_url'] ?>theme/js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="<?php echo $config['admin_url'] ?>theme/js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="<?php echo $config['admin_url'] ?>theme/js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="<?php echo $config['admin_url'] ?>theme/js/sparkline/jquery.sparkline.js"></script>
  <script src="<?php echo $config['admin_url'] ?>theme/js/sparkline/jquery.sparkline.js"></script>

<!--jQuery Flot Chart-->

<!--common script init for all pages-->
<script src="<?php echo $config['admin_url'] ?>theme/js/scripts.js"></script>
<!-- Include fm -->
<script type="text/javascript" src="<?php echo $config['admin_url'] ?>theme/source/jquery.fancybox.js?v=2.1.5"></script>
<script  src="<?php echo $config['admin_url'] ?>plugins/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea.editor",
    theme: "modern",
    theme_advanced_fonts : "Arial=arial,helvetica,sans-serif;Courier New=courier new,courier,monospace;AkrutiKndPadmini=Akpdmi-n",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
   ],
   convert_urls: false,
   filemanager_access_key:'<?php echo $config["key"] ?>',
   //language: 'EN',
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons| responsivefilemanager", 
   external_filemanager_path:"<?php echo $config['admin_url'] ?>plugins/filemanager/", filemanager_title:"Responsive Filemanager" , external_plugins: { "filemanager" : "<?php echo $config['admin_url'] ?>plugins/filemanager/plugin.min.js"},
   
 });
</script>
  <script src="<?php echo $config['admin_url'] ?>theme/js/nestable/jquery.nestable.js"></script>

  <!--script for this page-->
  <script src="<?php echo $config['admin_url'] ?>theme/js/nestable.js"></script>

  <script>

$(document).ready(function()
{

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target),
            output = list.data('output');
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));      
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };
  


    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1
    })
    .on('change', updateOutput);
    
    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    })
    .on('change', updateOutput);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    updateOutput($('#nestable2').data('output', $('#nestable2-output')));

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
        } 
    
     if (action === 'save-all') {
           // $('.dd').nestable('collapseAll');
       alert('hello');
        } 
    
    
    });

    $('#nestable3').nestable();

});
</script>
    <script type="text/javascript">
      $('#reset').click(function(){
          var form_data = {
          pass: $('#passone').val(),
          pass2: $('#passtwo').val(),
          id: $('#hash').val(),
          ajex : '1',
            };
          $.ajax({
          url : "<?php echo $config['admin_url'] ?>ajex/change_pass.php",
           type :"POST",
          data: form_data,
          success: function(msg){
          $("#login-msg").html(msg);
             }
            });
           return false;
      });
    </script>
    <script type="text/javascript">
$('#mceu_51-text').click(function (e) {
  alert('Hello window');
});
</script>
</body>
</html>