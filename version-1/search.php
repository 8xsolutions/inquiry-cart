<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
if (!isset($_REQUEST['s'])) {
    redirect($config['url']);
}else{
$url = $config['url'];
$search = mysql_real_escape_string($_REQUEST['s']);

//-----------------------------------------------
//PAGING STARTS FROM HERE
//-----------------------------------------------
// how many rows to show per page

//-----------------------------------------------
//PAGING STARTS FROM HERE
//-----------------------------------------------
// how many rows to show per page

$rowsPerPage =16;
$productsPerRow = 6;
// by default we show first page
$pageNum = 1;
// if $_GET['page'] defined, use it as page number
if(isset($_GET['page']))
{
    $pageNum = $_GET['page'];
}

// counting the offset
$offset = ($pageNum - 1) * $rowsPerPage;

// how many rows we have in database

// how many rows we have in database

$prdrs=mysql_query("SELECT * FROM `products` WHERE `prd_name` LIKE '%$search%' OR `prd_price` LIKE '%$search%' OR `prd_meta_key` LIKE '%$search%' OR `prd_meta_dic`LIKE '%$search%' OR `prd_dec` LIKE '%$search%' OR `prd_cat`LIKE '%$search%' OR `prd_link` LIKE '%$search%' OR`prd_color` LIKE '%$search%' OR`prd_art`LIKE '%$search%' OR `prd_size` LIKE '%$search%'");
$numrows=mysql_num_rows($prdrs);
$total_prds=$numrows;

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
if($maxPage==0) {
$maxPage=1;
}else{
$maxPage=$maxPage;
}
$self = "?s=$search";
$prdrs=mysql_query("SELECT * FROM `products` WHERE `prd_name` LIKE '%$search%' OR `prd_price` LIKE '%$search%' OR `prd_meta_key` LIKE '%$search%' OR `prd_meta_dic`LIKE '%$search%' OR `prd_dec` LIKE '%$search%' OR `prd_cat`LIKE '%$search%' OR `prd_link` LIKE '%$search%' OR`prd_color` LIKE '%$search%' OR`prd_art`LIKE '%$search%' OR `prd_size` LIKE '%$search%' ORDER BY prd_order LIMIT $offset, $rowsPerPage");
?>
            <!--  breadcrumb -->
            <section class="breadcrumb-area padding-top-product">
                <div class="container">
                    <div class="breadcrumb breadcrumb-box">
                        <ul>
                            <li><a href="<?php echo $config['url'] ?>"><span ><span>home</span></span></a></li>
                            <li><a href="#"><span><span>Search</span></span></a></li>
                            <li><span><?php echo $_GET['s']; ?></span></li>
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
                                                <?php
                                                  if ($total_prds > 0 ) {
                                                  while ($row = mysql_fetch_object($prdrs)):
                                                    // echo $hash;
                                                ?>
                                                 <?php  ?>
                                                    <!-- item -->
                                                    <li class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                                                        <div class="item">
                                                            <div class="product-details">
                                                               <!-- images -->
                                                                <div class="product-media">
                                                                    <div class="product-img">
                                                                        <a href="<?php echo $config['url'] ?>detail/<?php echo $row->prd_id; ?>"> <img alt="<?php echo $row->prd_name; ?>" src="<?php echo $row->prd_image; ?>"></a>
                                                                        <div class="hover-box">
                                                                          <a href="<?php echo $config['url'] ?>add_to_cart/<?php echo $row->prd_id; ?>">
                                                                            <button data-placement="top" data-toggle="tooltip" class="btn btn-button cart-button" type="button" title="add to cart"><i class="fa fa-shopping-cart"></i><span>add to cart</span></button>
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
                                                                            <div class="product-name"><a href="<?php echo $config['url'] ?>detail/<?php echo $row->prd_id; ?>"><?php echo $row->prd_name; ?></a></div>
                                                                            <div class="product-name">Art # <?php echo $row->prd_art; ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- / content -->
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <!-- / item -->
                                                    <?php 
                                                        endwhile;
                                                        }else{
                                                            echo '<h2 style=" padding: 67px; ">We Are Update Our Website...!</h2>';
                                                        }
                                                    ?>
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
}
include 'assets/inc/foot.php';
?>