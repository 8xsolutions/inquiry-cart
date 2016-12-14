<?php
include('function/config.ini.php');
include('function/db.ini.php');
include('function/function.ini.php');
include('function/setting.ini.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">
    <title><?php echo $config['cms_name'] ?> | <?php echo $config['cms_title'] ?></title>
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
</head>
<?php if(isset($_GET['hash'])){ ?>
  <body class="login-body">

    <div class="container">

      <form class="form-signin" method="post" action="<?php echo $config['admin_url'] ?>reset.php">
        <h2 class="form-signin-heading">Reset Password</h2>
        <div class="login-wrap">
            <?php if(isset($msg)) echo $msg; ?>
            <div id="login-msg" style="margin-bottom: 38px;"></div>
            <div class="user-login-info">
                <input type="password" class="form-control" id="passone" placeholder="Password" autofocus>
                <input type="password" class="form-control" id="passtwo" placeholder="Again Password">
                <input type="hidden" class="form-control" id="hash" value="<?php if (isset($_GET['hash'])) { echo $_GET['hash']; } ?>" placeholder="Password">
            </div>
            <button class="btn btn-lg btn-login btn-block" id="reset" type="submit">Reset</button>

            <div class="registration">
                &copy; <?php echo date('Y') ?> by <a href="http://yasirbasharat.com">almwebs</a>
            </div>

        </div>
      </form>

    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo $config['admin_url'] ?>theme/js/jquery.js"></script>
    <script src="<?php echo $config['admin_url'] ?>theme/bs3/js/bootstrap.min.js"></script>
    <!-- change pass script -->
    <script type="text/javascript">
      $('#reset').click(function(){
          var form_data = {
          pass: $('#passone').val(),
          pass2: $('#passtwo').val(),
          hash: $('#hash').val(),
          ajex : '1',
            };
          $.ajax({
          url : "<?php echo $config['admin_url'] ?>ajex/reset_pass.php",
           type :"POST",
          data: form_data,
          success: function(msg){
          $("#login-msg").html(msg);
             }
            });
           return false;
      });
    </script>
  </body>
</html>
<?php
}else{
  redirect($config['admin_url']);
}
?>