<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $s->description; ?>">
    <meta name="author" content="Design Markaz">
    <link rel="shortcut icon" href="<?php echo $config['admin_url'] ?>theme/images/favicon.png">
    <title><?php echo $data->cname ?> | <?php echo $s->title; ?></title>
    <!--Core CSS -->
    <link href="<?php echo $config['admin_url'] ?>theme/bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $config['admin_url'] ?>theme/css/bootstrap-reset.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Custom styles for this template -->
    <link href="<?php echo $config['admin_url'] ?>theme/css/style.css" rel="stylesheet">
    <link href="<?php echo $config['admin_url'] ?>theme/css/style-responsive.css" rel="stylesheet" />
    <link href="<?php echo $config['admin_url'] ?>theme/css/custom.css" rel="stylesheet">
        <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $config['admin_url'] ?>theme/dist/css/mak.min.css">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
        <!-- Online Tracking -->
    <script src="http://maps.google.com/maps?file=api&v=2&key=Your_Google_Maps_API_Key" type="text/javascript"></script>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <script type="text/javascript">
        function load() {
          if (GBrowserIsCompatible()) {
            var map = new GMap2(document.getElementById("map"));
            map.addControl(new GLargeMapControl());
            map.addControl(new GMapTypeControl());
            map.setCenter(new GLatLng(geoplugin_latitude(), geoplugin_longitude()), 12);
          }
        }
    </script>
</head>

<body>
<section id="container" >
<!--header start-->
<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="<?php echo $config['admin_url'] ?>" class="logo">
            <span class="logo-lg" style="color:white; margin-top:5px;"><b>Design</b><span style="color:white;"> Markaz</span></span>
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->
    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li>
                    <form method="get" action="<?php echo $config['admin_url'] ?>search-product.php">
                        <input type="text" class="form-control search" name="s" placeholder=" Search" style="margin-top: -10px;">
                    </form>
            </li>

            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#" style="margin-top: -17px;">
                    <img src="<?php echo $u->image; ?>">
                    <span class="username"> <?php echo $u->name; ?> </span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="profile.php"><i class=" fa fa-user"></i>Profile</a></li>
                    <li><a href="setting.php"><i class="fa fa-cog"></i> Settings</a></li>
                    <li><a data-toggle="modal" data-target="#changepass"><i class="fa fa-unlock-alt"></i> Change Password</a></li>
                    <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->

        </ul>
        <!--search & user info end-->
    </div>
</header>
<!--header end-->
<!-- side bar -->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start--> 
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="<?php echo $config['admin_url'] ?>">
                    <i class="fa fa-dashboard"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['url'] ?>" target="_blank">
                    <i class="fa fa-globe"></i>
                    <span>Go To Website</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-reorder"></i>
                    <span>Products & Category</span> 
                </a>
                <ul class="sub">
                    <li><a href="<?php echo $config['admin_url'] ?>products.php"> <i class="fa fa-picture-o"></i> <span> Products</span></a></li>
                    <li><a href="<?php echo $config['admin_url'] ?>category.php"> <i class="fa fa-external-link"></i> <span> Category</span></a></li>
                </ul>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-link"></i>
                    <span>Pages & Links</span>
                </a>
                <ul class="sub">
                    <li><a href="<?php echo $config['admin_url'] ?>page.php"> <i class="fa fa-book"></i> <span>Pages</span></a></li>
                    <li><a href="<?php echo $config['admin_url'] ?>links.php"> <i class="fa fa-external-link"></i> <span>Links</span></a></li>
                </ul>
            </li>
             <li>
                <a href="<?php echo $config['admin_url'] ?>banner.php">
                    <i class="fa fa-photo"></i>
                    <span>Banners</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['admin_url'] ?>inquiry.php">
                    <i class="fa fa-envelope-o"></i>
                    <span>Inquiries</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['admin_url'] ?>news.php">
                     <i class="fa fa-newspaper-o"></i>
                    <span>News & Events</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['admin_url'] ?>seo.php">
                    <i class="fa fa-cogs"></i>
                    <span>SEO Setting</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['admin_url'] ?>ban.php">
                    <i class="fa fa-ban"></i>
                    <span>Ban Users</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['admin_url'] ?>filemanager.php">
                    <i class="fa fa-folder-open"></i>
                    <span>Filemanager</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['admin_url'] ?>profile.php">
                    <i class="fa fa-user"></i>
                    <span>Admin Setting</span>
                </a>
            </li>
            <li>
                <a href="<?php echo $config['admin_url'] ?>setting.php">
                    <i class="fa fa-user"></i>
                    <span>Website Setting</span>
                </a>
            </li>
        </ul>
      </div>        
<!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
    <section class=" wrapper site-min-height">

    
