<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
?>
            <!--  404 -->
            <section class="main-page container">
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">
                            <section class="error-page">
                                <h3 class="error">404</h3>
                                <h2><i class="fa fa-warning"></i> Oops! The Page you requested was not found!</h2>
                                <div class="button-set">
                                    <a href="<?php echo $config['url'] ?>">
                                        <button class="btn btn-button gray9-bg white">Back to Home</button>
                                    </a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
            <!-- / 404 -->
<?php
include 'assets/inc/foot.php';
?>