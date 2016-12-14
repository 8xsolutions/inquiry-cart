<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
if (!isset($_GET['id'])) {
    redirect($data_admin['web']);
}else{
    $link = mysql_real_escape_string($_GET['id']);
    $links = mysql_query("SELECT * FROM `links` WHERE `url` = '{$link}'");
    $lq  = mysql_fetch_object($links);
    // GEt Page
    $lq->page;
    $page = mysql_query("SELECT * FROM `page` WHERE `pid` = '{$lq->page}'");
    $pq  = mysql_fetch_object($page);
?>
            <!--  breadcrumb -->
            <section class="breadcrumb- padding-top-product">
                <div class="container">
                    <div class="breadcrumb breadcrumb-box">
                        <ul>
                             <li><a href="<?php echo $config['url'] ?>"><span ><span>home</span></span></a></li>
                             <li><a href="#"><span ><span>Page</span></span></a></li>
                            <li><span><?php echo $pq->pname; ?></span></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- / breadcrumb -->
            <!-- abotu -->
            <section class="main-page container">
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">
                            <div class="about-box">
                                <div class="page-title margin-buttom-product"><span>Our Company <?php echo $pq->pname; ?></span></div>
                                <div class="about-content">
                                   <!-- banner -->
                                    <div class="about-banner">
                                        <!-- banner -->
                                        <div class="category-big-banner-box">
                                            <div class="category-big-banner-img">
                                                <!-- <img alt="" src="<?php echo $config['url'] ?>assets/image/About.png"> -->
                                            </div>
                                        </div>
                                         <!-- / banner -->
                                        <p><?php echo $pq->pcont; ?></p>
                                    </div>
                                   <!-- banner -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- / about -->
                <br>
<?php
}
include 'assets/inc/foot.php';
?>