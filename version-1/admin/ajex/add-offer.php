<?php
include('../function/config.ini.php');
include('../function/function.ini.php');
include('../function/setting.ini.php');
if (isset($_POST['ajex'])) {
    if (empty($_POST['name']) || empty($_POST['person']) || empty($_POST['detail']) || empty($_POST['to']) || empty($_POST['from']) || empty($_POST['packagein']) || empty($_POST['image']) || empty($_POST['price']) || empty($_POST['hotel'])  ) {
       echo warning(' Please Fill all field');
    }else{
        $name = mysql_real_escape_string($_POST['name']);
        $person = mysql_real_escape_string($_POST['person']);
        $detail = mysql_real_escape_string($_POST['detail']);
        $to = mysql_real_escape_string($_POST['to']);
        $from = mysql_real_escape_string($_POST['from']);
        $packagein = mysql_real_escape_string($_POST['packagein']);
        $image = mysql_real_escape_string($_POST['image']);
        $price = mysql_real_escape_string($_POST['price']);
        $hotel = mysql_real_escape_string($_POST['hotel']);
        $add = mysql_query("INSERT INTO `offer`(`id`, `name`, `from`, `to`, `person`, `price`, `detail`, `page`, `image`,`hotel`) VALUES (NULL,'{$name}','{$from}','{$to}','{$person}','{$price}','{$detail}','{$packagein}','{$image}','{$hotel}')");
        if ($add) {
            echo success(" Your offer add success fully");
            redirect($config['admin_url'].'new-package.php');
        }else{
            echo warning(mysql_error());
        }
    }
}
?>