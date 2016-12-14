               <!--  main menu -->
                <div class="header-menu gray9-bg">
                    <div class="container">
                        <!-- header menu -->
                        <div class="nav-container">
                            <nav class="navigation" id="sf-menu">
                                <ul class="sf-menu sf-js-enabled sf-arrow">
                                    <li class="active sfish-menu">
                                        <a href="<?php echo $config['url'] ?>"><span class="home-icon"></span>Home</a>
                                    </li>
                                    <li class="sfish-menu">
                                        <a href="#">About Us<i aria-hidden="true" class="fa fa-angle-down"></i></a>
                                        <ul class="menu-animation sfmenuffect">
	                                    <?php 
	                                        $get_links = mysql_query("SELECT * FROM `links` WHERE `location` = '1'");
	                                        while($get_links_featch = mysql_fetch_object($get_links)){
	                                           echo  "<li><a href='".$url."page/".$get_links_featch->url."'> ".$get_links_featch->name."</a></li>";
	                                          }
	                                    ?>
	                                	</ul>
                                    </li>
                                    <li class="sfish-menu">
                                        <a href="#">products Catagories<i aria-hidden="true" class="fa fa-angle-down"></i></a>
                                        <ul class="menu-animation sfmenuffect">
                                            <!--  sf menu -->
                                            <?php
                                                $maincats_rs = mysql_query("SELECT * FROM `main_cats` order by sorting_order");
                                                while($var = mysql_fetch_object($maincats_rs)):
                                            ?>
                                                <li>
                                                <a href="<?php echo $config['url'] ?>products/cat-<?php echo $var->main_cat_id ?>">
                                                    <?php echo $var->caption; ?>
                                                </a>

                                               <ul class="sfmenuffect">
                                                   <?php
		                                    $sub_cat = mysql_query("SELECT * FROM `sub_cats` WHERE main_cat_id = '$cur_main_cat_id' order by sorting_order+0 ASC");
		                                    while($row = mysql_fetch_object($sub_cat)):
		                                   ?>
                                                    <li>
                                                        <a href="<?php echo $config['url'] ?>products/<?php echo $row->sub_cat_id ?>"><?php echo $row->caption; ?></a>
                                                    </li>
                                                    <?php
		                                      endwhile; 
		                                      ?>
                                                   </ul>
                                            <!-- / sf menu -->
                                            </li>
                                            <?php
                                            endwhile;
                                            ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?php echo $config['url'] ?>contact/">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $config['url'] ?>cart/">Cart</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- / header menu -->
                        <!--  cart bar  -->
                        <div class="header-cart-mini">
                            <div class="topcart-mini-container">
                                <div class="block-cart">
                                    <button type="button">
                                        <i class="fa fa-shopping-bag"></i>
                                        <span class="cart-top-title"><?php 
                                                                          $sess_id = session_id();
                                                                          $inq_rs = mysql_query("select quantity from inquiry_cart where session_id='$sess_id'");
                                                                          if (mysql_num_rows($inq_rs) > 0) {
                                                                            # code...
                                                                          }else{
                                                                            
                                                                          }
                                                                          $total_products = "";
                                                                          while($inq_results = mysql_fetch_array($inq_rs)){
                                                                        
                                                                            $total_products += $inq_results['quantity'];
                                                                          }
                                                                           if($total_products==1){
                                                                          // echo $total_products."  item";  
                                                                          }else if($total_products>1){
                                                                          // echo $total_products."  item(s)"; 
                                                                          }else{ ?>
                                                                              Empty Cart
                                                                            <?php
                                                                        }if($total_products==0){
                                                                        }else{
                                                                    ?>
                                                                    <?php }  ?>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- / cart bar -->
                        <!-- mobile menu -->
                        <div class="mobile-container " style="display: none">
                            <div class="mobile-menu-toggle">
                                <ul>
                                    <li class="toggle-icon"><a href="#">Menu</a></li>
                                </ul>
                            </div>
                            <div style="display: none;" class="mobile-main-menu">
                                <ul class="accordion">
                                    <li>
                                        <a href="<?php echo $config['url'] ?>">Home</a>
                                    </li>
                                    <li class="parent ">
                                        <a href="#">About Us</a>
                                        <ul class="children" style="display: none;">
                                            <?php 
		                                        $get_links = mysql_query("SELECT * FROM `links` WHERE `location` = '1'");
		                                        while($get_links_featch = mysql_fetch_object($get_links)){
		                                           echo  "<li><a href='".$url."page/".$get_links_featch->url."'> ".$get_links_featch->name."</a></li>";
		                                          }
		                                    ?>
                                        </ul>
                                        <span class="down-up">&nbsp;</span>
                                    </li>
                                    <li class="parent ">
                                        <a href="#">product Catagory</a>
                                        <ul class="children" style="display: none;">
                                            <!--  sf menu -->
                                            <?php
                                                $maincats_rs = mysql_query("SELECT * FROM `main_cats` order by sorting_order");
                                                while($var = mysql_fetch_object($maincats_rs)):
                                            ?>
                                                <li>
                                                <a href="<?php echo $config['url'] ?>products/cat-<?php echo $var->main_cat_id ?>">
                                                    <?php echo $var->caption; ?>
                                                </a>
                                            </li>
                                            <?php
                                            endwhile;
                                            ?>
                                            <!-- / sf menu -->
                                        </ul>
                                        <span class="down-up">&nbsp;</span>
                                    </li>
                                    <li>
                                        <a href="<?php echo $config['url'] ?>contact/">Contact Us</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo $config['url'] ?>cart/">Cart</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- / mobile menu -->
                    </div>
                </div>
            </header>
            <!-- header -->