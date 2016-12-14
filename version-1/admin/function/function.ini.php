<?php
// error redirect
function redirect_error($message){
   echo ("<script type='text/javascript'>
   document.location.replace('error.php?msg=$message');
   </script> ");
   die();
}
// simpe redirect
function redirect($new_location){
   echo ("<script type='text/javascript'>
   document.location.replace('$new_location');
   </script> ");
   die();
}
function success($msg){
	return '<div class="alert alert-success alert-block fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Well done!</strong>'.$msg.'
			</div>';
}

function error($msg){
	return '<div class="alert alert-block alert-danger fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Oh snap!</strong>'.$msg.'
			</div>';
}
function warning($msg){
	return '<div class="alert alert-warning fade in">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Oh snap!</strong>'.$msg.'
			</div>';
}
// connect function
function connect($host,$user,$pass,$db)
{
	$check = @mysql_connect('localhost',$user,$pass);
	$select_db = mysql_select_db($db);
	if ($check) {
		if ($select_db) {
			return true;
		}
	}
}
// Rest Email
 function reset_pass($email,$url){
 	$check_email = mysql_query("SELECT * from admin WHERE email = '{$email}'");
 	if (mysql_num_rows($check_email) > 0) {
 		$subject = 'Reset Password';
 		$hash = md5("QWERTY!@#$%".time());
 		$message = $url."reset.php?hash=$hash";
 		$email_send = mail($email, $subject, $message);
 		if ($email_send) {
 			mysql_query("UPDATE `admin` SET `hash`='$hash' WHERE `email`='$email'");
 			return true;
 		}
 	}
 }
 // PasswordDone
 function reset_pass_done($hash,$pass){
  $check = mysql_query("SELECT * FROM `admin` WHERE `hash` = '$hash'");
  if (mysql_num_rows($check) > 0) {
    $row = mysql_fetch_object($check);
    $update = mysql_query("UPDATE `admin` SET `pass`='$pass', `hash` = '' WHERE `id` = '$row->id;'");
    if ($update) {
      return true;
    }
  }
}
 // PasswordDone
 function change_pass_done($id,$pass){
    $update = mysql_query("UPDATE `admin` SET `pass`='$pass'  WHERE `id` = '$id'");
    if ($update) {
      return true;
    }
}
function limit_words($string, $word_limit)
{
    $words = explode(" ",$string);
    return implode(" ", array_splice($words, 0, $word_limit));
}
// encrypt helper
function Encrypt_Helper($string, $key){
 if(extension_loaded('mcrypt') === true){
 return base64_encode(mcrypt_encrypt(MCRYPT_BLOWFISH, substr($key, 0,
                      mcrypt_get_key_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB)),
                      trim($string), MCRYPT_MODE_ECB,
                      mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB),
                      MCRYPT_RAND)));
 }
 return false;
}
// dencrypt helper
function Decrypt_Helper($string, $key){
 if(extension_loaded('mcrypt') === true){
 return trim(mcrypt_decrypt(MCRYPT_BLOWFISH, substr($key, 0,
             mcrypt_get_key_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB)),
             base64_decode($string), MCRYPT_MODE_ECB,
             mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB),
             MCRYPT_RAND)));
 }
 return false;
}
// login 
function login($user,$pass,$checkbox,$key)
{
	$check = mysql_query("SELECT * FROM `admin` WHERE `user` = '{$user}' AND `pass` = '{$pass}'");
	if(mysql_num_rows($check) > 0){
		if (!empty($checkbox) AND $checkbox != 'no') {
			setcookie('login_hash',Encrypt_Helper($user.'-'.'login'.'-'.time(),$key) , strtotime('+1 month'),'/admin');
			mysql_query("UPDATE `admin` SET `login_hash`='".Encrypt_Helper($user.'-'.'login'.'-'.time(),$key)."' WHERE `user` = '{$user}'");
			$_SESSION['user'] = $user;
			$_SESSION['login'] = 'login';
			return true;
		}else{
			$_SESSION['user'] = $user;
			$_SESSION['login'] = 'login';
			return true;
		}
	}
}
// Logout
function logout($key){
	if (isset($_COOKIE['login_hash'])) {
		$login_hash = Decrypt_Helper($_COOKIE['login_hash'], $key);
		$ld = explode('-', $login_hash);
		$q = mysql_query("UPDATE `admin` SET `login_hash`='' WHERE `user` = '".mysql_real_escape_string($ld[0])."'");
		if ($q) {
			unset($_COOKIE['login_hash']);
			setcookie('login_hash','', time() - (36400 * 60) ,'/admin');
			session_destroy();
		}
	}else{
		session_destroy();
	}
}
// thumbnails
function thumbnails($path,$nwidth,$nhight,$dir,$img){
	//$uploadedfile = "$desired_dir/".$file_name;
    $src = imagecreatefromjpeg($path);
     //list($width,$height)=getimagesize($path);
    $imagesize = getimagesize($path);
    $width = $imagesize[0];
    $height = $imagesize[1];
    $newwidth=$nwidth;
    $newheight=$nwidth;
    $tmp=imagecreatetruecolor($newwidth,$newheight);
    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height); 
    $smallfilename = $dir.$img;
    imagejpeg($tmp,$smallfilename,100);
    imagedestroy($src);
    imagedestroy($tmp);
}
// Delete main Category
function del_main_cat($id){	
  $get_sub_cat = mysql_result(mysql_query("SELECT count('sub_cat_id') FROM sub_cats WHERE main_cat_id = '$id'"), 0);
  if($get_sub_cat > 0){
    mysql_query("DELETE FROM `sub_cats` WHERE `main_cat_id` = '{$id}'");
    mysql_query("DELETE FROM `main_cats` WHERE `main_cat_id` = '{$id}'");
    return true;
  }else{
    mysql_query("DELETE FROM `main_cats` WHERE `main_cat_id` = '{$id}'");
    return true;
  }
}
// delete Product
function del_prd($id){
  $get_gal = mysql_result(mysql_query("SELECT count('id') FROM `product-image` WHERE hash = '$id'"), 0);
  if($get_gal > 0){
    mysql_query("DELETE FROM `product-image` WHERE `hash` = '{$id}'");
    mysql_query("DELETE FROM `products` WHERE `prd_id` = '{$id}'");
    return true;
  }else{
    mysql_query("DELETE FROM `products` WHERE `prd_id` = '{$id}'");
    return true;
  }
}
// Get Ipaddress
function GetIp()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}	
function titleCase($string, $delimiters = array(" ", "-", ".", "'", "O'", "Mc"), $exceptions = array("and", "to", "of", "das", "dos", "I", "II", "III", "IV", "V", "VI"))
{
    /*
     * Exceptions in lower case are words you don't want converted
     * Exceptions all in upper case are any words you don't want converted to title case
     *   but should be converted to upper case, e.g.:
     *   king henry viii or king henry Viii should be King Henry VIII
     */
    $string = mb_convert_case($string, MB_CASE_TITLE, "UTF-8");
    foreach ($delimiters as $dlnr => $delimiter) {
        $words = explode($delimiter, $string);
        $newwords = array();
        foreach ($words as $wordnr => $word) {
            if (in_array(mb_strtoupper($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtoupper($word, "UTF-8");
            } elseif (in_array(mb_strtolower($word, "UTF-8"), $exceptions)) {
                // check exceptions list for any words that should be in upper case
                $word = mb_strtolower($word, "UTF-8");
            } elseif (!in_array($word, $exceptions)) {
                // convert to uppercase (non-utf8 only)
                $word = ucfirst($word);
            }
            array_push($newwords, $word);
        }
        $string = join($delimiter, $newwords);
   }//foreach
   return $string;
}
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// Show nav
function nav_show($location)
{
  $url = $GLOBALS['url'];
  $get_links = mysql_query("SELECT * FROM `links` WHERE `location` = '$location'");
  while($get_links_featch = mysql_fetch_object($get_links)){
     echo  "<li><a href='".$url."page/".$get_links_featch->url."'> ".$get_links_featch->name."</a></li>";
    }
}
function have_gallery($id){
  $count = mysql_result(mysql_query("SELECT count('id') FROM `product-image` WHERE hash = '$id'"), 0);
  return $count;
}
function  gallery($id,$width,$swidth){
  $query = mysql_query("SELECT * FROM `product-image` WHERE `hash` = '$id'");
  while ($row = mysql_fetch_object($query)) {
    echo "<a href='".$row->image."?width=".$width."' data-large='".$row->image."?width=".$width."'><img src='".$row->image."?width=".$swidth."' /></a>";
  }
}
// Slig
function slug($string){
   $slug= preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   return strtolower($slug);
}