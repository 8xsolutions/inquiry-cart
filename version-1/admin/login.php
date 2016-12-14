<?php
  $page = 'login';
  include 'data.php';
  if (isset($_SESSION['user']) AND $_SESSION['login'] == 'login') {
    redirect('index.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <title><?php echo $config['cms_name'] ?> | <?php echo $page ?></title>
    <!--Core CSS -->
    <link href="<?php echo $config['admin_url'] ?>theme/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $config['admin_url'] ?>theme/css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo $config['admin_url'] ?>theme/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo $config['admin_url'] ?>theme/css/style.css" rel="stylesheet">
    <link href="<?php echo $config['admin_url'] ?>theme/css/style-responsive.css" rel="stylesheet" />
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php 
    if (isset($_POST['ajex'])) {
        $user = mysql_real_escape_string($_POST['user']);
        $pass = md5(mysql_real_escape_string($_POST['user']));
        if (isset($_POST['check'])) {
          $checkbox = mysql_real_escape_string('yes');
        }else{
          $checkbox = mysql_real_escape_string('no');
        }
      if (login($user,$pass,$checkbox,$config['key']) == true) {
        $msg = success(' Redirect please wait');
        echo redirect($config['admin_url']);
      }else{
        $msg = error(' invalid username or password');
      }
    }
    ?>
</head>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" method="post" action="<?php echo $config['admin_url'] ?>login.php">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <?php if(isset($msg)) echo $msg; ?>
            <div id="login-msg" style="margin-bottom: 38px;"></div>
            <div class="user-login-info">
                <input type="text" class="form-control" id="username" placeholder="User ID" autofocus>
                <input type="password" class="form-control" id="password" placeholder="Password">
                <input type="hidden" id="checkbox" id="password" value="">
            </div>
            <label class="checkbox">
                <input type="checkbox" id="cb" value="" name="check"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" id="login" type="submit">Sign in</button>

            <div class="registration">
                &copy; <?php echo date('Y') ?> by <a href="http://8xolutions.com" target="blank">8x</a>
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                      	<form method="post">
                      	  <div id="reset-msg"></div>
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="email" name="email" placeholder="Email" id="email" autocomplete="off" class="form-control placeholder-no-fix">
                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button" id="reset" >Submit</button>
                      </div>
                      </form>
                  </div>
              </div>
          </div>
          <!-- modal -->

      </form>

    </div>
    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo $config['admin_url'] ?>theme/js/jquery.js"></script>
    <script src="<?php echo $config['admin_url'] ?>theme/bs3/js/bootstrap.min.js"></script>
    <!-- change pass script -->
    <script type="text/javascript">
      $('#login').click(function(){
          var form_data = {
          user: $('#username').val(),
          pass: $('#password').val(),
          check: $('#checkbox').val(),
          ajex : '1',
            };
          $.ajax({
          url : "<?php echo $config['admin_url'] ?>ajex/login.php",
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
      $('#reset').click(function(){
          var form_data = {
          email: $('#email').val(),
          ajex : '1',
            };
          $.ajax({
          url : "<?php echo $config['admin_url'] ?>ajex/reset.php",
           type :"POST",
          data: form_data,
          success: function(msg){
          $("#reset-msg").html(msg);
             }
            });
           return false;
      });
    </script>
    <script type="text/javascript">
     $(function(){
          $('#cb').change(function() {
              $("#checkbox").val(($(this).is(':checked')) ? "yes" : "no");
          });
      });              
    </script>
  </body>
</html>
