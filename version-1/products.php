<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
if (!isset($_REQUEST['id'])) {
    redirect($data_admin['web']);
}else{
    $id = mysql_real_escape_string($_REQUEST['id']);
    $link = explode("-", $id);
    if (count($link) == 2) {
        $mainc= $link[1];
        $sub_cats_rs = mysql_query("select * from sub_cats where main_cat_id='$mainc'") or die(mysql_error());
    }else{
        $sub_cats_rs = mysql_query("select * from sub_cats where sub_cat_id='$id'") or die(mysql_error());  
    }
    $sub_cats = mysql_fetch_array($sub_cats_rs);
    $cur_sub_cat_caption = $sub_cats['caption'];
    $cur_main_cat_id = $sub_cats['main_cat_id'];
    $cur_main_cat_rs = mysql_query("select * from main_cats where main_cat_id='$cur_main_cat_id'");
    $cur_main_cats = mysql_fetch_assoc($cur_main_cat_rs);
    $url = $config['url'];
    //-----------------------------------------------
    //PAGING STARTS FROM HERE
    //-----------------------------------------------
    // how many rows to show per page
    $rowsPerPage =16;
    $productsPerRow = 2;
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

    if (count($link) >1) {
        $prdrs=mysql_query("SELECT * FROM `products` WHERE `main_cat_id`='$mainc'");
    }else{
    if ($id == "all") {
        $prdrs= mysql_query("Select * from products");
    }{
        $prdrs= mysql_query("Select * from products where prd_cat='$id'");
    }

}
$numrows=mysql_num_rows($prdrs);
$total_prds=$numrows;
// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);
if($maxPage==0) {
$maxPage=1;
}else{
$maxPage=$maxPage;
}
$self = "$id";
if (count($link) > 1) {
    $prdrs=mysql_query("SELECT * FROM `products` WHERE `main_cat_id`='$mainc' LIMIT $offset, $rowsPerPage");

}else{
if ($id == "all") {
$prdrs=mysql_query("Select * from products  LIMIT $offset, $rowsPerPage");
}else{
$prdrs=mysql_query("Select * from products where prd_cat='$id' ORDER BY prd_order LIMIT $offset, $rowsPerPage");
}
}
?>
            <!--  breadcrumb -->
            <section class="breadcrumb-area padding-top-product">
                <div class="container">
                    <div class="breadcrumb breadcrumb-box">
                        <ul>
                            <li><a href="<?php echo $config['url'] ?>"><span ><span>home</span></span></a></li>
                            <li><a href="#"><span><span>Products</span></span></a></li>
                            <li><span>Shop</span></li>
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
                                                            echo '<h2 style=" padding: 67px; ">Coming Soon...!</h2>';
                                                        }
                                                    ?>
                                                </ol>
                                            </div>
                                        </div>
                                        <div class="toolbar toolbar-bottom">
                                            <div class="sorter margin-buttom padding-top-product">
                                                <div class="pager pager-area">
                                                    <p class="amount">
                                                        <?php echo " Total<b> $total_prds </b>Products <strong> |</strong> Showing page <strong>$pageNum</strong> of <strong>$maxPage</strong>"; ?>
                                                    </p>
                                                    <div class="pagination pages" id="pagination">
                                                        <ol class="pagination">
                                                            <li class="disabled pagination_previous" id="pagination_previous">
                                                            <?php
                                            if ($pageNum > 1)
                                            {
                                                $page = $pageNum - 1;
                                                $prev = "<a  href=\"$page\"><<</a>";
                                                
                                                $first = " <a href=\"$self&page=1\">[First Page]</a> ";
                                            } 
                                            else
                                            {
                                                $prev  = '  ';       // we're on page one, don't enable 'previous' link
                                                $first = ' '; // nor 'first page' link
                                                
                                              //  $prev  = ' [Prev] ';  
                                                //$first = ' [First Page] ';
                                            }

                                            // print 'next' link only if we're not
                                            // on the last page
                                            if ($pageNum < $maxPage)
                                            {
                                                $page = $pageNum + 1;
                                                $next = "<a href=\"$page\">>></a>";
                                                
                                                $last = " <a href=\"$self&page=$maxPage\">[Last Page]</a> ";
                                            } 
                                            else
                                            {
                                                $next = ' [Next] ';      // we're on the last page, don't enable 'next' link
                                                $last = ' [Last Page] '; // nor 'last page' link
                                                
                                                $next = ' '; 
                                                $last = ' ';
                                            }

                                            // print the page navigation link
                                            if ($total_prds > $rowsPerPage){

                                            echo $prev;

                                            for($pi=1; $pi<=$maxPage; $pi++){
                                            echo '<a href="'.$url.'products/'.$self.'/'.$pi.'">';
                                            if($pageNum==$pi){
                                            echo "";
                                            echo $pi."";
                                            }else{
                                            echo $pi;
                                            }

                                            echo "</a>";
                                            }

                                            echo  $next;
                                             
                                            }        
                                            ?>
                                            		  <li>
                                                        </ol>
                                                    </div>
                                                </div>
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