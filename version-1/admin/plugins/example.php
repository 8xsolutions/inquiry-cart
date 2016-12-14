<?php  
/* include watermark class */
require_once realpath('watermark.class.php');

/* example */
$smartWattermark =& smartWattermark::getInstance(array(
	'debug' => true,
	'position' => 'repeat',
	'min_size_for_wattermark' => 200,
	'opacity' => 15,
	'watermark_logo_path' => 'watermark_repeat.png'
));
