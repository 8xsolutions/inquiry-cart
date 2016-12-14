<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
?>
            <!--  slider -->
            <figure class="slider-area">
                <div class="slider-area-inner">
                    <div class="ajax_loading"><i class="fa fa-spinner fa-spin"></i></div>
                    <div id="nivoparrallax" class="nivoSlider">
                        <?php 
                            $i = 1;
                            $bannerq = mysql_query("SELECT * FROM `banner`");
                            while($bq = mysql_fetch_object($bannerq)):
                        ?>
                        <div class="slider-item">
                            <img class="item <?php if($i == 1){ echo 'active'; } ?>" src="<?php echo $bq->image; ?>" title="#imgcaption1" alt="Banner" />
                        </div>
                        <?php 
                            $i++;
                            endwhile; 
                        ?>
                    </div>
                </div>
            </figure>
            <!-- / slider -->
            <br>
            <!--  category product -->
            <section class="main-page container">
                <div class="main-container col2-left-layout">
                    <div class="main">
                        <div class="row">
                          <?php include 'assets/inc/sideban.php'; ?>
                            <!-- Right side -->
                            <aside class=" col-sm-8 col-md-9 col-lg-9">
                                <div class="col-main">
                                    <!--  our product -->
                                    <div class="category-products">
                                        <div class="product-container">
                                            <div id="products-grid" >
                                            <div class="product-top-ber">
                                                <h2 class="product-hadding"><span>Our Catagories</span></h2>
                                            </div>
                                                <ul class="products-grid row medium-products">
                                                    <?php  
			                             $sub_cat = mysql_query("SELECT * FROM `main_cats` ORDER BY `sorting_order`");
			                              while($sr = mysql_fetch_object($sub_cat)):
			                            ?>
                                                    <!-- item -->
                                                    <li class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                        <div class="item">
                                                            <div class="product-details">
                                                               <!-- images -->
                                                                <div class="product-media">
                                                                    <div class="product-img">
                                                                        <a href="<?php echo $config['url'] ?>products/cat-<?php echo $sr->main_cat_id; ?>"> <img alt="<?php echo $sr->caption; ?>" src="<?php echo $sr->img; ?>"></a>
                                                                        <div class="hover-box">
                                                                            <a href="<?php echo $config['url'] ?>products/cat-<?php echo $sr->main_cat_id; ?>">
                                                                                <button data-placement="top" data-toggle="tooltip" class="btn btn-button cart-button" type="button"><i class="fa fa-link"></i><span>Visit Link</span></button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- / images -->
                                                                <div class="line-color"></div>
                                                                <!-- content -->
                                                                <div class="product-content">
                                                                    <div class="product-content-inner">
                                                                        <div class="product-con-left">
                                                                            <div class="product-name"><a href="<?php echo $config['url'] ?>products/cat-<?php echo $sr->main_cat_id ?>"><?php echo $sr->caption; ?></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- / content -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- / item -->
                                                    <?php endwhile; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / our product -->
                                </div>
                            </aside>
                            <!-- / Right side -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- / category product -->
            <br>
<?php
include 'assets/inc/foot.php';
?>