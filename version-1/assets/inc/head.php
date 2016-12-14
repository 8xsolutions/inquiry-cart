<?php 
$GLOBALS['url'] = $config['url'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $data->cname; ?> | <?php if(isset($title)){ echo $title; }else{ echo $s->title; }  ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="keywords" content="<?php echo $s->keyword; ?>">
    <meta name="description" content="<?php if (isset($description)) { echo $description; } else{ echo $s->description; } ?>">
    <meta name="author" content="MAK Designes">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $config['url'] ?>assets/image/favicon.png" type="image/x-icon" />
    <!-- Global CSS  -->
    <!-- bootstrap -->
    <link href="<?php echo $config['url'] ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- ui -->
    <link href="<?php echo $config['url'] ?>assets/plugins/jquery-ui-1.12.0/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <!-- owl carousel -->
    <link href="<?php echo $config['url'] ?>assets/plugins/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css">
    <!-- theme style -->
    <link href="<?php echo $config['url'] ?>assets/css/themestyles.css" rel="stylesheet" type="text/css">
    <!-- nivo-slider  -->
    <link href="<?php echo $config['url'] ?>assets/css/slider.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $config['url'] ?>assets/plugins/Nivo-Slider/nivo-slider.css" rel="stylesheet" type="text/css">
    <!-- animation -->
    <link href="<?php echo $config['url'] ?>assets/css/animate.css" rel="stylesheet" type="text/css">
    <!-- media css -->
    <link href="<?php echo $config['url'] ?>assets/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- magnific popup -->
    <link href="<?php echo $config['url'] ?>assets/plugins/magnific/magnific-popup.css" type="text/css" rel="stylesheet" media="screen" />
    <!-- font awesome -->
    <link href="<?php echo $config['url'] ?>assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
         <link href="24webgroup"/>
        <script src="<?php echo $config['url'] ?>assets/html5shiv.js"></script>
        <script src="<?php echo $config['url'] ?>assets/respond.js"></script>
        <![endif]-->
        <!-- Google Language -->
        <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <style>
        .goog-te-gadget-simple {
            background-color:rgba(255, 255, 255, 0) !important; 
            border-left: none !important; 
            border-top: none !important; 
            border-bottom: none !important; 
            border-right: none !important;
            font-size: 10pt;
            display: inline-block;
            padding-top: 1px;
            padding-bottom: 2px;
            cursor: pointer;
            zoom: 1;
            background-image: ;
            color: white;
        }
        </style>
</head>
<body>
    <!--  wrapper-->
    <div class="wrapper">
        <!-- page-->
        <div class="page">
            <!-- header -->
            <header>
                <!-- top-bar-->
                <div class="top-bar" style="padding-top: 10px;" >
                    <div class="container">
                        <div class="row">
                            <!-- top links -->
                            <div class="col-sm-8 col-md-8 col-lg-6 top-links">
                                <ul class="nav navbar-nav pull-left">
                                    <!--<li class="list-line dropdown flags" style="color:black !important; padding-bottom: 9px;">
                                        Welcome To <?php echo $data->cname; ?>....!
                                    </li>-->
                                </ul>
                            </div>
                            <!--/ top links -->
                            <!-- langue & currency -->
                            <div class="col-sm-4 col-md-4 col-lg-6 lang-currency">
                                <ul class="nav navbar-nav pull-right">
                                    <!-- langue -->
                                    <li class="list-line dropdown flags">
                                        <div id="google_translate_element"></div>
                                    </li>
                                    <!--/ langue  -->
                                </ul>
                            </div>
                            <!-- / langue currency -->
                        </div>
                    </div>
                </div>
                <br>
                <!-- / top-bar-->
                <!-- header-container -->
                <div class="header-container" style="padding-bottom: 9px !important; padding-top: 28px !important;">
                    <div class="container">
                        <div class="row">
                            <!-- logo-->
                            <div class="col-sm-6 col-md-4  col-lg-4">
                                <div class="logo">
                                    <a href="<?php echo $config['url'] ?>">
                                        <img src="<?php echo $data->logo; ?>" alt="<?php echo $data->cname; ?>" style="width: 250px; margin-top: -35px !important;"/>
                                    </a>
                                </div>
                            </div>
                            <!-- / logo-->
                            <!--  message -->
                            <div class="col-md-4 col-lg-4 hidden-sm hidden-xs">
                                <div class="header-message-box">
                                </div>
                            </div>
                            <!--/ message-->
                            <!--  min search bar -->
                            <div class="col-sm-6 col-md-4  col-lg-4" align="right">
                                <div class="header-search">
                                    <form id="searchbox" action="<?php echo $config['url'] ?>search/" method="GET">
                                        <div class="form-search">
                                            <input class="form-control font-capitalize" type="text" name="s" placeholder="Enter your keyword...">
                                            <button class="white gray9-bg">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- / mini search bar -->
                        </div>
                    </div>
                </div>
                <!-- / header-container -->
