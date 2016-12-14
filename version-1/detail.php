<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
if (!isset($_GET['uniid'])) {
    redirect($config['url']);
}else{
    $id = mysql_real_escape_string($_GET['uniid']);
    $query = mysql_query("SELECT * FROM `products` WHERE `prd_id`='{$id}'");
    if (mysql_num_rows($query) > 0) {
    // featch Detail
    $row = mysql_fetch_object($query);
?>
                <!--  breadcrumb -->
                <section class="breadcrumb-area padding-top-product">
                    <div class="container">
                        <div class="breadcrumb breadcrumb-box">
                            <ul>
                                 <li><a href="#"><span ><span>home</span></span></a></li>
                                <li><a href="#"><span><span>Product Detail</span></span></a></li>
                                <li><span><?php echo $row->prd_name; ?></span></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- / breadcrumb -->
                <!--  product details -->
                <section  class="main-page container">
                    <div class="main-container col1-layout">
                        <div class="main">
                            <div class="col-main">
                                <div class="product-view">
                                    <div class="product-essential">
                                        <div class="row">
                                          <?php include 'assets/inc/sideban.php'; ?>
                                            <div class="col-sm-5 col-md-4 col-lg-4">
                                                <div class="product-img-box resbaner" style="border: 1px solid #beb9b9">
                                               <!-- big images -->
                                                <p class="product-view-img colorbox">
                                                    <img id="zoom_image" data-zoom-image="<?php echo $row->prd_image; ?>" src="<?php echo $row->prd_image; ?>" alt="view image" />
                                                </p>
                                                <!-- / big images -->
                                            </div>
                                            </div>
                                            <!-- product content -->
                                            <div class="col-sm-7 col-md-5 col-lg-5">
                                                <div class="product-shop">
                                                    <div class="products-name">
                                                        <h1> <?php echo $row->prd_name; ?> </h1>
                                                    </div>
                                                    <ul class="list-unstyled">
                                                        <li>
                                                        <label> Art #:</label>
                                                        <span class="editable instock"><?php echo $row->prd_art; ?></span>
                                                        </li>
                                                        <li>
                                                        <label>Color:</label>
                                                        <span class="editable instock"><?php echo $row->prd_color; ?></span>
                                                        </li>
                                                        <li>
                                                        <label>Availability:</label>
                                                        <span class="editable instock">in STOCK</span>
                                                        </li>
                                                        <li>
                                                        <label>Price</label>
                                                        <span class="editable instock"><?php echo $row->prd_price; ?></span>
                                                        </li>
                                                    </ul>
                                                    <div class="product-discription">
                                                        <div class="product-discription-title">Description:</div>
                                                        <p><?php echo $row->prd_dec; ?></p>
                                                    </div>
                                                    <div class="add-to-cart">
                                                        <!--<div class="input-content">
                                                            <label>Qty:</label>
                                                            <div class="box-qty">
                                                                <input type="text" class="input-text qty" id="input-quantity" value="1" name="quantity">
                                                                <input type="hidden" value="44" name="product_id">
                                                                <div class="qty-arrows">
                                                                    <input type="button" class="qty-increase" onclick="var qty_el = document.getElementById('input-quantity');
                                                                    var qty = qty_el.value;
                                                                    if (!isNaN(qty))
                                                                        qty_el.value++;
                                                                    return false;" value="+">
                                                                    <input type="button" class="qty-decrease" onclick="var qty_el = document.getElementById('input-quantity');
                                                                    var qty = qty_el.value;
                                                                    if (!isNaN(qty))
                                                                        qty_el.value--;
                                                                    return false;
                                                                           " value="-">
                                                                </div>
                                                            </div>
                                                        </div>-->
                                                        <a href="<?php echo $config['url'] ?>add_to_cart/<?php echo $row->prd_id; ?>">
                                                        	<button class="btn btn-button white" ><i class="fa fa-shopping-cart"></i>add to cart</button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- product content -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
                <br>
                 <!-- / product details -->
<?php
}else{
    redirect($config['url']);
}
}
include 'assets/inc/foot.php';
?>