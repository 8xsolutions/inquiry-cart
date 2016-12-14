            <!--  footer -->
            <footer class="footer-area">
                <div class="footer-inner">
                    <div class="container">
                        <div class="row">
                        <div class="col-sm-6 col-md-2 col-lg-2">
                                <!--  footer Custom Service -->
                                <div class="service col-sm col-xs1">
                                    <h3 class="hadding-title"><span>Custom Service</span></h3>
                                    <div class="footer-content">
                                        <ul>
                                            <li>
                                                <a href="<?php echo $config['url'] ?>">
                                                    <span>Home</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="http://devineinstruments.com/page/about-us">
                                                    <span>About Us</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $config['url'] ?>contact/">
                                                    <span>Contact Us</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo $config['url'] ?>cart/">
                                                    <span>Cart</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- / footer Custom Service -->
                            </div>
                            <div class=" col-sm-6 col-md-2 col-lg-2">
                                <!--  footer information -->
                                <div class="information">
                                    <h3 class="hadding-title">information</h3>
                                    <div class="footer-content">
                                        <ul>
                                               <?php 
	                                        $get_links = mysql_query("SELECT * FROM `links` WHERE `location` = '1'");
	                                        while($get_links_featch = mysql_fetch_object($get_links)){
	                                           echo  "<li><a href='".$url."page/".$get_links_featch->url."'> ".$get_links_featch->name."</a></li>";
	                                          }
	                                    ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- / footer information -->
                            </div>
                            <div class=" col-sm-6 col-md-2 col-lg-2">
                                <!--  footer my account -->
                                <div class="account col-sm col-xs1">
                                    <h3 class="hadding-title">News & Events</h3>
                                    <div class="footer-content">
                                        <ul>
                                            <p>
                                                <marquee direction="up" width="100%" height="120" scrollamount="2">
                                                    <ul class="list-unstyled footer-links">
                                                        <?php  
                                                          $newsq = mysql_query("SELECT * FROM news");
                                                          while($news = mysql_fetch_object($newsq)):
                                                         ?>
                                                        <li>
                                                          <div class="news">
                                                              <div class="date" style="color:red;"><b><?php echo $news->date; ?></b></div>
                                                              <div class="heading" style="color:white;"><?php echo $news->title; ?></div>
                                                              <p style="color:white;"><?php echo  $news->content; ?></p>
                                                          </div>
                                                        </li>
                                                        <?php endwhile; ?>
                                                    </ul>
                                                </marquee>
                                            </p>
                                        </ul>
                                    </div>
                                </div>
                                <!-- / footer my account -->
                            </div>
                            <div class=" col-sm-6 col-md-2 col-lg-2">
                                <!--  footer my account -->
                                <div class="account col-sm col-xs1">
                                    <h3 class="hadding-title">Catalogue</h3>
                                    <div class="footer-content">
                                    	<a href="<?php echo $config['url'] ?>source/catlouge.pdf">
                                           <img src="<?php echo $config['url'] ?>source/PDF_convert.png"style="width: 80%;">
                                        </a>
                                    </div>
                                </div>
                                <!-- / footer my account -->
                            </div>
                            <!-- newsletter -->
                            <div class=" col-sm-12 col-md-3 col-lg-3">
                                <!--  footer newsletter -->
                                <div class="newsletter col-sm col-xs1" style="margin-left: 25px;">
                                    <div class="footer-content">
                                        <div class="footer-social-box">
                                            <div class="footer-social-inner">
                                                <h3 class="hadding-title"><span>Follow Us On...</span></h3>
                                                <div class="footer-social-icon">
                                                    <ul align="center">
                                                        <li><a class="facebook" href="<?php echo $data->facebook; ?>"><i class="fa fa-facebook"></i></a><li>
                                                       <li> <a class="twitter" href="<?php echo $data->twitter; ?>" style="margin-top: 15px;"><i class="fa fa-twitter"></i></a></li>
                                                        <li><a class="google" href="<?php echo $data->google; ?>"><i class="fa fa-google-plus"></i></a></li>
                                                        <li><a class="skype" href="skype:<?php echo $data->skype; ?>?chat"><i class="fa fa-skype"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- / footer newsletter -->
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="footer-buttom">
                            <div class="footer-line"></div>
                            <!-- / footer copyright -->
                            <div class="copyright">
                                <p>Copyright &copy; <?php echo date('Y'); ?> <b><a href="<?php echo $config['url'] ?>"><?php echo $data->cname; ?></a></b>. All Rights Reserved. 
                            </div>
                            <!-- / footer copyright -->
                        </div>
                    </div>
                </div>
            </footer>
            <div class="top-bottom" id="tot-buttom" style="display: block;"><span class="fa fa-play"></span></div>
            <!-- / footer -->
        </div>
        <!-- / page-->
    </div>
    <!-- / wrapper-->
    <!-- JS Global -->
    <script src="<?php echo $config['url'] ?>assets/plugins/jquery/jquery-1.11.3.min.js"></script>
    <!-- jquery ui -->
    <script src="<?php echo $config['url'] ?>assets/plugins/jquery-ui-1.12.0/jquery-ui.min.js"></script>
    <!-- bootstarp -->
    <script src="<?php echo $config['url'] ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- owl carousel -->
    <script src="<?php echo $config['url'] ?>assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- nivo slider -->
    <script src="<?php echo $config['url'] ?>assets/plugins/Nivo-Slider/jquery.nivo.slider.js"></script>
    <!-- elevatezoom -->
    <script src="<?php echo $config['url'] ?>assets/plugins/elevatezoom/jquery.elevatezoom.js" type="text/javascript"></script>
    <!-- magnific popup -->
    <script src="<?php echo $config['url'] ?>assets/plugins/magnific/jquery.magnific-popup.min.js"></script>
    <!-- accordion -->
    <script src="<?php echo $config['url'] ?>assets/js/jquery.accordion.source.js"></script>
    <!-- ddslick -->
    <script src="<?php echo $config['url'] ?>assets/js/jquery.ddslick.min.js"></script>
    <!-- custom js -->
    <script src="<?php echo $config['url'] ?>assets/js/theme.js"></script>
</body>
</html>