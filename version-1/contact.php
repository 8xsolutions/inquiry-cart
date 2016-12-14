<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
?>
            <!-- breadcrumb -->
            <section class="breadcrumb-area padding-top-product">
                <div class="container">
                    <div class="breadcrumb breadcrumb-box">
                        <ul>
                             <li><a href="<?php echo $config['url'] ?>"><span ><span>home</span></span></a></li>
                            <li><span>Contact Us</span></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- / breadcrumb -->
            <!-- Contact -->
            <section class="main-page container">
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">
                            <section class="contact-us-area">
                                <div class="contact-box">
                                    <div class="page-title margin-buttom-product">
                                        <span>Contact Us</span>
                                    </div>
                                    <!-- maps -->
                                    <div class="contact-map">
                                        <script type="text/javascript" src="http://www.webestools.com/google_map_gen.js?lati=37.0625&long=-95.6770&zoom=17&width=1100&height=400&mapType=normal&map_btn_normal=yes&map_btn_satelite=yes&map_btn_mixte=yes&map_small=yes&marqueur=yes&info_bulle="></script>
                                        </div>
                                        <p class="padding-top-product"><?php echo $data->description; ?></p>
                                    </div>
                                     <!-- / maps -->
                                     <!-- contact details -->
                                    <div class="contact-details">
                                        <div class="page-title margin-buttom-product"><span>Contact</span></div>
                                        <div class="row">
                                           <!-- hotline -->
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <div class="hotline contact-us-box">
                                                    <i class="fa fa-tty icon"></i>
                                                    <span><strong>Phone</strong></span>
                                                    <ul>
                                                        <li><i class="fa fa-phone"></i><span>Phone: <?php echo $data->phone; ?></span></li>
                                                        <li><i class="fa fa-phone"></i><span>Mobile: <?php echo $data->cell; ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- / hotline -->
                                            <!-- email -->
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <div class="support contact-us-box">
                                                    <i class="fa fa-envelope-o icon"></i>
                                                    <span><strong>email</strong></span>
                                                    <ul>
                                                        <li><i class="fa fa-envelope-o"></i><span> info@devineinstruments.com</span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- / email -->
                                            <!-- address -->
                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                <div class="location contact-us-box">

                                                    <i class="fa fa-map-marker icon"></i>
                                                    <span><strong>address</strong></span>
                                                    <ul>
                                                        <li><i class="fa fa-map-marker"></i> <span><?php echo $data->address; ?></span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                             <!-- / address -->
                                        </div>
                                        <!-- contact form -->
                                        <?php 
                                                  if (isset($_POST['sumit'])) {
                                                    if ($count > 0) {
                                                     echo success(' You Already Submit your Request Thank you.....!');
                                                    }else{
                                                      if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['enquiry'])) {
                                                         echo warning(' Please Enter a valid value');
                                                      }else{
                                                        if (!empty($_POST['name']) || !empty($_POST['email']) || !empty($_POST['enquiry'])) {
                                                            $name = $_POST['name'];
                                                            $email = $_POST['email'];
                                                            $msg = 'Name: '. $name;
                                                            $msg .= 'Email: ' . $email;
                                                            $msg .=' Message: '. $_POST['enquiry'];
            
                                                            $mail = mail($u->email, 'New Inquiry Submit', $msg);
                                                            echo "OK";
                                                            if ($mail) {
                                                              echo success(' Your Message Submit Thanks...!');
                                                              $_SESSION['FORM_SEBMIT'] = 1;
                                                            }else{
                                                              echo warning(' Please try again');
                                                            }
                                                        }else{
                                                          echo warning(' Please Enter a valid value');
                                                        }
                                                      }
                                                    }
                                                  }
                                                  ?>
                                        <div class="contact-form">
                                            <div class="comment-respond padding-top">
                                                <div class="comment-respond-inner">
                                                    <div class="hadding"><span>Leave a Message</span></div>
                                                    <form class="comment-form respond-form">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                                                <input type="text" id="name" name="name" placeholder="Your Name:" class="form-control border-radius" value="">
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6 comment-form-email">
                                                                <input type="text" id="customer_mail" name="email" placeholder="Email:" class="form-control border-radius" value="">
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-12">
                                                                <div class="comment-form-comment">
                                                                    <textarea class="form-control border-radius" placeholder="Comment:" id="comments" name="enquiry" cols="40" rows="8"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-submit  padding-top-product">
                                                            <button type="submit" id="submit" name="submit" class="btn submit-btn border-radius">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- / contact form -->
                                    </div>
                                    <!-- / contact details -->
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
            <br>
            <!-- Contact -->
<?php
include 'assets/inc/foot.php';
?>