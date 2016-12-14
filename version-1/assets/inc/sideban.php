                        <!-- left area-->
                        <div class="col-sm-4 col-md-3 col-lg-3">
                        <!-- category menu -->
                            <div class="nav_vmmenu-area hidden-xs">
                                <div class="nav_inner">
                                    <div class="vmmenu-title gray9-bg"><i class="fa fa-list"></i><span>categories</span></div>
                                    <div class="category-list">
                                        <div class="category-list-inner">
                                            <ul class="sf-vartical-menu sf-menu">
                                                <?php  
                                  // Min Category
                                  $maincat = mysql_query("SELECT * FROM `main_cats` ORDER BY `sorting_order`");
                                  while ($mc = mysql_fetch_object($maincat)):
                                  ?>
                                                <li class="parrent">
                                                    <a href="#"><span><?php echo $mc->caption; ?></span></a>
                                                    <ul class="sfmenuffect">
                                                        <?php 
		                                         $sub_cat = mysql_query("SELECT * FROM `sub_cats` WHERE main_cat_id = '$mc->main_cat_id' order by sorting_order");
		                                          while($sr = mysql_fetch_object($sub_cat)):
		                                        ?>
                                                        <li >
                                                            <a href='<?php echo $config['url'] ?>products/<?php echo $sr->sub_cat_id ?>'><span><?php echo $sr->caption; ?></span></a>
                                                        </li>
                                                        <?php
				                          endwhile;
				                        ?>
                                                    </ul>
                                                </li>
                                                <?php
			                          endwhile;
			                        ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / category menu -->
                            <!--  today deals -->
                            <div class="todaydeals-box padding-top-product">
                                <div class="today-inner">
                                    <!--  today deals title and icon -->
                                    <div class="more lable0 gray9-bg">
                                        <a class="dropdown-toggle" aria-expanded="false" href="#" data-toggle="dropdown"><i class="fa fa-plus"></i><span>Mini Banner</span></a>
                                    </div>
                                    <div id="myCarousel" class="carousel slide bs" data-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="item active" style="padding-top: 5px;">
                                                <img src="<?php echo $config['url'] ?>source/banner/mini/1.JPG" class="img-thumbnail" class="img-responsive">
                                            </div>
                                            <div class="item" style="padding-top: 5px;">
                                                <img src="<?php echo $config['url'] ?>source/banner/mini/2.JPG" class="img-thumbnail" class="img-responsive">
                                            </div>
                                            <div class="item" style="padding-top: 5px;">
                                                 <img src="<?php echo $config['url'] ?>source/banner/mini/3.JPG" class="img-thumbnail" class="img-responsive">
                                            </div>
                                            <div class="item" style="padding-top: 5px;">
                                                 <img src="<?php echo $config['url'] ?>source/banner/mini/4.JPG" class="img-thumbnail" class="img-responsive">
                                            </div>
                                            <div class="item" style="padding-top: 5px;">
                                                 <img src="<?php echo $config['url'] ?>source/banner/mini/5.JPG" class="img-thumbnail" class="img-responsive">
                                            </div>
                                            <div class="item" style="padding-top: 5px;">
                                                 <img src="<?php echo $config['url'] ?>source/banner/mini/6.JPG" class="img-thumbnail" class="img-responsive">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / today deals -->
                            <!--  cat banner -->
                            <div class="left-cat-banner padding-top-product">
                                <div class="left-cat-banner-inner">
                                    <div class="after-before-line-top"></div>
                                    <div class="left-cat-banner-content">
                                        <div class="banner-hadding"><span>new collection 2016</span></div>
                                        <div class="text-content">
                                            <span>All Beauty Product in Shop</span>
                                        </div>
                                    </div>
                                    <div class="after-before-line-buttom"></div>
                                </div>
                            </div>
                            <!-- / cat banner -->
                        </div>
                        <!-- / left area-->