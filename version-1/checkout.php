<?php
include 'conn.php';
include 'assets/inc/head.php';
include 'assets/inc/nav.php';
$sess_id = session_id();


if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['SUBMIT'])) {
  if(isset($_POST['address2'])){$address2 = $_POST['address2'];}else{$address2 = "";}
  $name = $_POST['name'].' '.$_POST['lastname'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $fax = $_POST['fax'];
  $mobile = $_POST['mobile'];
  $company = $_POST['compnyname'];
  $address = $_POST['address']." ".$address2;
  $city = $_POST['city'];
  $date = date("Y/m/d");
  $postcode = $_POST['postcode'];
  $country = $_POST['country'];

  if (empty($name) || empty($email) || empty($telephone) || empty($mobile) || empty($address) || empty($city) || empty($postcode) || empty($country)) {
   $msg = warning(' Please Fill * fild for submiting inquery!');
  }else{
  $inqcartrsf = mysql_query("select * from inquiry_cart, products where inquiry_cart.prdid = products.prd_id AND inquiry_cart.session_id = '$sess_id'");
  while($inq_cart = mysql_fetch_array($inqcartrsf)){
  extract($inq_cart);
  @$selected_arts .= $prd_art ." (Qty: $quantity , Color: $color, Size: $size),";
  }

  $clientmsg = 'Dear : '.$name;
  $clientmsg .= '
  Thank you for submited inquery. we will contact you As Soon As Possible.';
  $email_body = "Hi, Following Customer had placed an inqury";
  $email_body .= "Name: $name <br>
  Email: $email<br>
  Telephone: $telephone<br>
  Mobile: $mobile<br>
  Fax: $fax<br>
  Comopany: $company<br>
  Address: $address<br>
  Postcode: $postcode<br>
  Country: $country<br>
  <br>
  <br><br>";
  $email_body .= "Following is Inquiry Detail <Br>";
  $email_body .=$selected_arts;
  $email_to = "info@knowus.biz";
  $email_subject = "New Inquiry Notice";
  $headers = "MIME-Version: 1.0 \r\n";
  $headers .= "Content-type: text/html; Charset=ISO-8859-1 \r\n";
  $headers .= "FROM: $name <$email> \r\n";
  $headers .= "Reply-To: $email \r\n";
  $headers .= "cc: ";
  $mail = mail($email_to, $email_subject, $email_body, $headers);

    if ($mail) {  
      mail($email, "Submited New Inquiry from ".$data->cname, $clientmsg);
      
      $add_inq = mysql_query("INSERT INTO `inquiry`(`name`, `email`, `telephone`, `fax`, `mobile`, `company`, `address`, `city`, `postcode`, `country`, `date`, `prd_art`) VALUES ('$name','$email','$telephone','$fax','$mobile','$company','$address','$city','$postcode','$country','$date','$selected_arts')");
         
      if($add_inq == TRUE){
        $msg = success(' Your Inquiry has been submited. Thank You.Please wait you are redirect on Home page');
        mysql_query("DELETE FROM inquiry_cart where session_id = '$sess_id'");
        echo '<meta http-equiv="refresh" content="4; url='.$config['url'].'" />';
      }
    }
}

}
?>
            <!--  breadcrumb -->
            <section class="breadcrumb-area padding-top-product">
                <div class="container">
                    <div class="breadcrumb breadcrumb-box">
                        <ul>
                            <li><a href="<?php echo $config['url']; ?>"><span ><span>home</span></span></a></li>
                            <li><span>Check Out</span></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!-- / breadcrumb -->
            <!-- Checkout -->
            <section class="main-page container">
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">
                            <section class="shopping-cart">
                            <?php
                               $sess_id = session_id();
                               $inq_cart_rs = mysql_query("select * from inquiry_cart, products where inquiry_cart.prdid = products.prd_id AND inquiry_cart.session_id = '$sess_id'");
                                if(mysql_num_rows($inq_cart_rs)==0){
                                                       
                                  echo "<span style='text-align:center;color:#000 !important'><h1 style='color:#000 !important'>Your Inquiry Cart Is Empty...!</h1></span>";
                                                       
                                }else{
                            ?>
                                <div class="page-title margin-buttom-product"><span>checkout</span></div>
                                                    <form class="form-billing-details" action="<?php echo $config['url']; ?>checkout/" method="post">
                                                        <div class="row">
                                                            <div class="col-sm-6 col-md-12 col-lg-12">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="First Name" name="name" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Last Name" name="lastname" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Company Name" name="compnyname" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Address 1" name="address" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Address 2" name="address2" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Country" name="country" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="City" name="city" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Postcode/ZIP" name="postcode" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-6 col-lg-6">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Email" name="email" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Phone Number" name="telephone" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Cell Number" name="mobile" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4 col-md-4 col-lg-4">
                                                                <div class="form-group">
                                                                    <input type="text" placeholder="Fax Number" name="fax" required class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                                <div class="button-set">
                                                                    <button class="btn btn-button gray9-bg white" name="SUBMIT">Send Inquiry</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                </div>
                            <?php } ?>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
            <br>
            <!-- / Checkout -->
<?php
include 'assets/inc/foot.php';
?>