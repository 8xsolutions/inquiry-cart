<?php
/**
 *
 * smartWattermark
 * ---------------- 
 *
 * @copyright 2010 Dinca Andrei. All rights reserved.
 *
 * @filesource
 * @contact andrei.webdeveloper@gmail.com
 * @telephone +04 0728.703.942
 * @release date 15.10.2010
 *
 */
class smartWattermark
{

	/**
	 * Holds an insance of self
	 * @var $instance
	 */
	private static $instance = NULL;
	
	
	/**
	 * Holds website option config
	 */
	private static $option = array(
	
		/* commens properties */
		'debug' => false, // if you set debug = true if error on watermark echo them
		'curr_image' => false, // path tu current image. Auto load from $_SERVER["PATH_TRANSLATED"] superglobal
		'curr_image_extension' => '', // explode from source image
		'valid_image_extension' => array('jpeg', 'jpg', 'png', 'gif'), // available images extension
		'opacity' => 0, // watermark image opacity. Default value = 100. Available value between 0 - 100
		'min_size_for_wattermark' => 300, // if image is smaller then this value watermark not init

		/* logo watermark */
		'watermark_logo_path' => '', // path to watermark logo
		/* watermark position */
		'valid_position' => array('top_left', 'top_center', 'top_right', 'center_left', 'center_center', 'center_right', 'bottom_left', 'bottom_center', 'bottom_right', 'repeat'), 
		'position' => 'left_top', // watermark logo position.
		'margin' => 20
	);
	
	
	
	/**
	 *
	 * Return smartWattermark instance or create intitial instance
	 *
	 * @access public
	 * @params $custom_option (optional)
	 *
	 * @return object
	 *
	 */
	public static function getInstance($custom_option=array())
	{
 		if(is_null(self::$instance))
 		{
 			self::$instance = new smartWattermark($custom_option);
 		}
		return self::$instance;
	}

	/**
	*
	* the constructor is set to private so
	* so nobody can create a new instance using new
	*
	*/
	public function __construct($custom_option=array())
	{
		self::$option['curr_image'] = $this->currImage();
		if(!self::$option['curr_image'] && self::$option['debug']){
			// stop script
			die('invalid image');
		}
		
		// overwrite default value with custom value
		if(count($custom_option) > 0){
			self::$option = array_merge(self::$option, $custom_option);
		}
		
		// update wattermark path
		// trim — Strip whitespace (or other characters) from the beginning and end of a string
		// realpath() expands all symbolic links and resolves references to '/./', '/../' and extra '/' characters in the input path and return the canonicalized absolute pathname. 
		self::$option['watermark_logo_path'] = trim(self::$option['watermark_logo_path']) != "" ?  realpath(trim(self::$option['watermark_logo_path'])): ''; 
		
		$this->watermark_image();
	}
	
	
	/**
	 *
	 * return current image path or false
	 *
	 * @access private
	 *
	 */
	public function currImage()
	{
		$__img = $_SERVER["PATH_TRANSLATED"];
		// is_file — Tells whether the filename is a regular file
		// realpath() expands all symbolic links and resolves references to '/./', '/../' and extra '/' characters in the input path and return the canonicalized absolute pathname.
		if(!is_file(realpath($__img))){
			if(self::$option['debug']){
				echo 'invalid $_SERVER["PATH_TRANSLATED"]: <b>'. $_SERVER["PATH_TRANSLATED"] . '</b><br />' . PHP_EOL; 
			}
			return false; // invalid path
		}
		
		
		// validate extension and set
		// in_array — Checks if a value exists in an array
		if(!in_array($this->getFileType($__img), self::$option['valid_image_extension'])){
			if(self::$option['debug']){
				echo 'invalid $this->getFileType("'.($__img).'"): <b>'. $this->getFileType($__img) . '</b><br />' . PHP_EOL; 
			}
			return false; // invalid path
		}
		self::$option['curr_image_extension'] = $this->getFileType($__img);
		
		return $__img;
	}
	
	
	/**
	 *
	 * return current image extension
	 *
	 * @access private
	 *
	 */
	private function getFileType($string) 
	{
       $type = strtolower(eregi_replace("^(.*)\.", "", $string));
       if ($type == "jpg") $type = "jpeg";
       return $type;
    }
    
    
    /***
	 * return current image extension
	 *
	 * @access private
	 * @param $source the source image
     * @param self::$option['watermark_logo_path'] the watermark to apply
     * @param $outputType the type to output as (png, jpg, gif, etc.), defaults to the image type of $source if left blank
	 *
	 */
	private function watermark_image() 
	{
		$sourceType = self::$option['curr_image_extension'];
		$watermarkType = $this->getFileType(self::$option['watermark_logo_path']);
		
		// empty — Determine whether a variable is empty
		if (empty($outputType)) $outputType = $sourceType;
		if ($outputType == "gif") $outputType = "png"; // Okay to remove after July 2004
		
		// header() is used to send a raw HTTP  header. See the » HTTP/1.1 specification  for more information on HTTP headers. 
		header("Content-type: image/$outputType");
		
		// Derive function names
		// strtoupper — Make a string uppercase
		$createSource = "ImageCreateFrom" . strtoupper($sourceType);
		$showImage = "Image" . strtoupper($outputType);
		$createWatermark = "ImageCreateFrom" . strtoupper($watermarkType);
		
		// Load original and watermark to memory
		$output = $createSource(self::$option['curr_image']);
		$logo = $createWatermark(self::$option['watermark_logo_path']);
		
		// imagealphablending — Set the blending mode for an image
		// more: http://www.php.net/manual/en/function.imagealphablending.php
		ImageAlphaBlending($output, true);
		
		// getimagesize — Get the size of an image
		$size = @getimagesize(self::$option['curr_image']);    
		if($size[0] > self::$option['min_size_for_wattermark']){
			
			// Find proper coordinates so watermark will be in the lower right corner
			// imagesx — Get image width
			// imagesy — Get image height
			$widthWatermark = imagesx($logo);
			$heightWatermark = imagesy($logo);
			$widthPhoto = imagesx($output);
			$heightPhoto = imagesy($output);
			
			// swich watermark position
			// repeat
			if(self::$option['position'] == 'repeat'){
				$xLogoPosition = 0;
			    $yLogoPosition = 0;
			}
			
			// top line
			elseif(self::$option['position'] == 'top_left'){
			    $xLogoPosition = ceil(0 + (int)self::$option['margin']);
			    $yLogoPosition = ceil(0 + (int)self::$option['margin']);
			}else if(self::$option['position'] == 'top_center'){
			    $xLogoPosition = ceil(($widthPhoto - $widthWatermark) / 2);
			    $yLogoPosition = ceil(0 + (int)self::$option['margin']);
			}else if(self::$option['position'] == 'top_right'){
			    $xLogoPosition = ceil(($widthPhoto - $widthWatermark) - (int)self::$option['margin']);
			    $yLogoPosition = ceil(0 + (int)self::$option['margin']);
			}
			
			// center line
			else if(self::$option['position'] == 'center_left'){
			    $xLogoPosition = ceil(0 + (int)self::$option['margin']);
			    $yLogoPosition = ceil(($heightPhoto - $heightWatermark) / 2);
			}else if(self::$option['position'] == 'center_center'){
			    $xLogoPosition = ceil(($widthPhoto - $widthWatermark) / 2);
			    $yLogoPosition = ceil(($heightPhoto - $heightWatermark) / 2);
			}else if(self::$option['position'] == 'center_right'){
			    $xLogoPosition = ceil(($widthPhoto - $widthWatermark) - (int)self::$option['margin']);
			    $yLogoPosition = ceil(($heightPhoto - $heightWatermark) / 2);
			}
			
			// bottom line
			else if(self::$option['position'] == 'bottom_left'){
			    $xLogoPosition = ceil(0 + (int)self::$option['margin']);
			    $yLogoPosition = ceil(($heightPhoto - $heightWatermark) - (int)self::$option['margin']);
			}else if(self::$option['position'] == 'bottom_center'){
			    $xLogoPosition = ceil(($widthPhoto - $widthWatermark) / 2);
			    $yLogoPosition = ceil(($heightPhoto - $heightWatermark) - (int)self::$option['margin']);
			}else if(self::$option['position'] == 'bottom_right'){
			    $xLogoPosition = ceil(($widthPhoto - $widthWatermark) - (int)self::$option['margin']);
			    $yLogoPosition = ceil(($heightPhoto - $heightWatermark) - (int)self::$option['margin']);
			}
			
			// default
			else{
			    $xLogoPosition = $widthPhoto - $widthWatermark - 10;
			    $yLogoPosition = $heightPhoto - $heightWatermark - 10;
			}
		

			if(self::$option['position'] == 'repeat'){
				/*
				 * utils
					$widthWatermark = imagesx($logo);
					$heightWatermark = imagesy($logo);
					$widthPhoto = imagesx($output);
					$heightPhoto = imagesy($output);
				 */
				
				// x line
				$__xRepeat = ceil($widthPhoto / $widthWatermark);
				for ($i = 0; $i <= $__xRepeat; $i++) {
				    $this->imagecopymerge_alpha($output, $logo, ($xLogoPosition + $widthWatermark * $i), $yLogoPosition, 0, 0, ImageSX($logo), ImageSY($logo), self::$option['opacity']);
				
					// y line
					$__yRepeat = ceil($heightPhoto / $heightWatermark);
					for ($ii = 1; $ii <= $__yRepeat; $ii++) {
					    $this->imagecopymerge_alpha($output, $logo, ($xLogoPosition + $widthWatermark * $i), ($yLogoPosition + $widthWatermark * $ii), 0, 0, ImageSX($logo), ImageSY($logo), self::$option['opacity']);
					}
				}
			}else{
				
				// image copy merge with alpha
				$this->imagecopymerge_alpha($output, $logo, $xLogoPosition, $yLogoPosition, 0, 0, ImageSX($logo), ImageSY($logo), self::$option['opacity']);
			}
				
		}
		// Display
		$showImage($output);
		
		// Purge
		// imagedestroy — Destroy an image
		ImageDestroy($output);
		ImageDestroy($logo);
		
		// clean memory on server, help "php garbage collector": http://php.net/manual/en/features.gc.php
		$logo = $output = '';
	}
	
	/**
	*
	* PNG ALPHA CHANNEL SUPPORT for imagecopymerge();
	* This is a function like imagecopymerge but it handle alpha channel well!!!
	* 
	* use: imagecopymerge — Copy and merge part of an image
	* 	   more: http://usphp.com/manual/en/function.imagecopymerge.php
	*
	*/
	private function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct)
	{
        $opacity = $pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);
        
        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);
        // copying that section of the background to the cut
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        
        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
    }
	
	
	/**
	*
	* Like the constructor, we make __clone private
	* so nobody can clone the instance
	*
	*/
	private function __clone()
	{
	}
	
} /*** end of class ***/
