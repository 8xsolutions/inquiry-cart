<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
?>
                <!-- start breadcrumb -->
                <section class="breadcrumb-area padding-top-product">
                    <div class="container">
                        <div class="breadcrumb breadcrumb-box">
                            <ul>
                                 <li><a href="<?php echo $config['url'] ?>"><span ><span>home</span></span></a></li>
                                <li><span>Shopping Cart</span></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- / breadcrumb -->
                <!-- shopping-cart -->
                <section class="main-page container">
                    <div class="main-container col1-layout">
                        <div class="main">
                            <div class="col-main">
                                <!-- start shopping cart area-->
                                <section class="shopping-cart">
                                    <div class="page-title margin-buttom-product"><span>cart Item</span></div>
                                    <?php
                                        $sess_id = session_id();
                                        $inq_cart_rs = mysql_query("select * from inquiry_cart, products where inquiry_cart.prdid = products.prd_id AND inquiry_cart.session_id = '$sess_id'");
                                          if(mysql_num_rows($inq_cart_rs)==0){
                                            echo "<span style='text-align:center;color:#000 !important'><h1 style='color:#000 !important'>Your Inquiry Cart Is Empty</h1></span>";
                                          }else{
                                    ?>
                                    <div class="shopping-content">
                                        <form method="post" action="<?php echo $config['url']; ?>inq_up.php">
                                            <div class="table-responsive">
                                                <table class="cart-table data-table">
                                                   <!-- list -->
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Product</th>
                                                            <th class="text-left">Description</th>
                                                            <th class="text-left">Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <!-- / list -->
                                                    <tbody>
                                                    <?php
                                                      while($cart = mysql_fetch_array($inq_cart_rs)){
                                                    ?>
                                                       <!-- item -->
                                                        <tr>
                                                            <td class="text-center">
                                                                <a href="<?php echo $config['url']; ?>detail/<?php echo $cart['prd_id'];?>">
                                                                    <img alt="<?php echo $cart['prd_name'];?>" src="<?php echo $cart['prd_image'];?>" style="width: 150px;"/>
                                                                </a>
                                                            </td>
                                                            <td class="text-left">
                                                                <ul>
                                                                    <li><a href="<?php echo $config['url']; ?>detail/<?php echo $cart['prd_id'];?>"><?php echo $cart['prd_name'];?></a></li>
                                                                    <li><a href="#">Art # : <?php echo $cart['prd_art'];?></a></li>
                                                                    <li><a href="#">Color : <?php echo $cart['prd_color'];?></a></li>
                                                                    <li><a href="#">Size : <?php echo $cart['prd_size'];?></a></li>
                                                                </ul>
                                                            </td>
                                                            <td class="text-left">
                                                                <div class="input-group btn-block" style="max-width: 200px;">
                                                                    <span class="input-group-btn">
                                                                        <button data-toggle="tooltip" type="submit" >
                                                                            <i class="fa fa-refresh"></i>
                                                                        </button>
                                                                        <a class="action" href="<?php echo $config['url']; ?>inq_del.php?id=<?php echo $cart['id'];?>"
                                                                            <button onclick="return confirm('Are you sure you want to delete?')" type="button">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </button>
                                                                         </a>
                                                                    </span>
                                                                    
                                                                    <div class="qty-area">
                                                                        <div class="input-content">
                                                                            <div class="box-qty">
                                                                            	<form action="<?php echo $config['url']; ?>inq_up.php" method="post">
                                                                                <input type="text" size="2" style="width: 65%;"  class="form-control" value="<?php echo $cart['quantity'];?>" name="up">
                                 <input type="hidden"  value="<?php echo $cart['prd_id'];?>" name="id">
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    </form
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- / item -->
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                        <div class="buttons">
                                            <div class="float-right">
                                                <a class="btn btn-button gray9-bg white" href="<?php echo $config['url']; ?>">CONTINUE SHOPPING </a>
                                                <a class="btn btn-button tomato-bg white" href="<?php echo $config['url']; ?>checkout/">Checkout</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    </div>
                                </section>
                                <!-- / shopping cart area-->
                            </div>
                        </div>
                    </div>
                </section>
                <br>
                <!-- / shopping-cart -->
<?php
include 'assets/inc/foot.php';
?>