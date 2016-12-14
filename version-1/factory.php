<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
?>
            <!--  breadcrumb -->
            <section class="breadcrumb-area padding-top-product">
                <div class="container">
                    <div class="breadcrumb breadcrumb-box">
                        <ul>
                            <li><a href="<?php echo $config['url'] ?>"><span ><span>home</span></span></a></li>
                            <li><span>Factory View</span></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- / breadcrumb -->
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
                                        <!--toolbar-->
                                        <div class="toolbar">
                                            <div class="sorter">
                                                <p class="view-mode" align="left">
                                                    <label>View as:</label>
                                                    <a title="grid view" id="gridview" class="active"><i class="fa fa-th-large"></i><span>grid</span></a>
                                                </p> 
                                                <p><?php echo $row->prd_name; ?></p>
                                            </div>
                                        </div>
                                        <!-- toolbar -->
                                        <div class="product-container">
                                            <div id="products-grid" >
                                                <ul class="products-grid row medium-products">
                                                    <!-- item -->
                                                    <li class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                        <div class="item">
                                                            <div class="product-details">
                                                               <!-- images -->
                                                                <div class="product-media">
                                                                    <div class="product-img">
                                                                    	<p class="product-view-img colorbox">
                                                                           <a href="#"> <img id="zoom_image" data-zoom-image="http://devineinstruments.com/source/products/HS/1.jpg" src="http://www.fscandino.com/imgs/view_1.jpg" width="1000" height="1000"></a>
                                                                           <a href="http://www.fscandino.com/imgs/view_1.jpg" title=""></a>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <!-- / images -->
                                                                <div class="line-color"></div>
                                                                <!-- content -->
                                                                <div class="product-content">
                                                                    <div class="product-content-inner">
                                                                        <div class="product-con-left">
                                                                            <div class="product-name">Packing View</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- / content -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- / item -->
                                                </ol>
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
                <br>
            <!-- / category product -->

            <!-- / product details -->
<?php
include 'assets/inc/foot.php';
?>