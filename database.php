<?PHP
	/*	-----------------------------
		Developed by : BelajarPHP.com
		Date : 27 Oct 2024
		-----------------------------	*/
	//https://aleesya.u-ji.com/index_app.php

	date_default_timezone_set('Asia/Kuala_Lumpur');
	
	//localhost
	$dbHost = "localhost";	// Database host
	$dbName = "aleesya";		// Database name
	$dbUser = "root";		// Database user
	$dbPass = "";			// Database password

	
	$con = mysqli_connect($dbHost,$dbUser ,$dbPass,$dbName);
	
	
	function verifyAdmin($con)
	{
		if ($_SESSION['username'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `username`, `password` FROM `admin` WHERE `username`='$_SESSION[username]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}
	
	function verifyUser($con)
	{
		if ($_SESSION['phone'] && $_SESSION['password'] ) 
		{
		  $result=mysqli_query($con,"SELECT  `phone`, `password` FROM `user` WHERE `phone`='$_SESSION[phone]' AND `password`='$_SESSION[password]' " ) ;

          if( mysqli_num_rows( $result ) == 1 ) 
	  	  return true;
		}
		return false;
	}

	function numRows($con, $query) {
        $result  = mysqli_query($con, $query);
        $rowcount = mysqli_num_rows($result);
        return $rowcount;
    }
	
	function Notify($status, $alert, $redirect)
	{
		$color = ($status == "success") ? "w3-text-white" : "w3-text-red";

		echo '<div class="'.$color.' w3-green w3-top w3-card w3-padding-24" style="z-index=999">
			<span onclick="this.parentElement.style.display=\'none\'" class="w3-button w3-large w3-display-topright">&times;</span>
				<div class="w3-padding w3-center">
				<div class="w3-large">'.$alert.'</div>
				</div>
			</div>';
		
		if($_SERVER['HTTP_HOST']=="localhost")
			header( "refresh:1;url=$redirect" );
		else
			print "<script>self.location='$redirect';</script>";
	}
	
	
	function substrwords($text, $maxchar, $end='...') {
		if (strlen($text) > $maxchar || $text == '') {
			$words = preg_split('/\s/', $text);      
			$output = '';
			$i      = 0;
			while (1) {
				$length = strlen($output)+strlen($words[$i]);
				if ($length > $maxchar) {
					break;
				} 
				else {
					$output .= " " . $words[$i];
					++$i;
				}
			}
			$output .= $end;
		} 
		else {
			$output = $text;
		}
		return $output;
	}
	
	function timeago($date) {
	   $timestamp = strtotime($date);	
	   
	   $strTime = array("second", "minute", "hour", "day", "month", "year");
	   $length = array("60","60","24","30","12","10");

	   $currentTime = time();
	   if($currentTime >= $timestamp) {
			$diff     = time()- $timestamp;
			for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
			$diff = $diff / $length[$i];
			}

			$diff = round($diff);
			return $diff . " " . $strTime[$i] . "(s) ago ";
	   }
	}
	
	function resizeImage($resourceType,$image_width,$image_height) {
		$resizeWidth 	= 300;
		$resizeHeight 	= 300;
		$imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
		imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
		return $imageLayer;
	}
	
	// Function to crop and resize image to 300x300
	function cropImage($filePath, $fileType) {
		$targetWidth = 300;
		$targetHeight = 300;

		// Create a new image from file
		switch ($fileType) {
			case 'jpg':
			case 'jpeg':
				$src = imagecreatefromjpeg($filePath);
				break;
			case 'png':
				$src = imagecreatefrompng($filePath);
				break;
			case 'gif':
				$src = imagecreatefromgif($filePath);
				break;
			default:
				echo "Unsupported image type.";
				return;
		}

		// Get original dimensions
		$origWidth = imagesx($src);
		$origHeight = imagesy($src);

		// Calculate the scale for cropping (for center crop)
		$srcX = 0;
		$srcY = 0;
		if ($origWidth > $origHeight) {
			$srcX = ($origWidth - $origHeight) / 2;
			$origWidth = $origHeight; // Crop to a square
		} elseif ($origHeight > $origWidth) {
			$srcY = ($origHeight - $origWidth) / 2;
			$origHeight = $origWidth; // Crop to a square
		}

		// Create a new true color image with the target dimensions
		$dst = imagecreatetruecolor($targetWidth, $targetHeight);

		// Resize and crop
		imagecopyresampled($dst, $src, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $origWidth, $origHeight);

		// Save the cropped image
		switch ($fileType) {
			case 'jpg':
			case 'jpeg':
				imagejpeg($dst, $filePath, 100); // Save as JPEG
				break;
			case 'png':
				imagepng($dst, $filePath, 0); // Save as PNG
				break;
			case 'gif':
				imagegif($dst, $filePath); // Save as GIF
				break;
		}

		// Free up memory
		imagedestroy($src);
		imagedestroy($dst);

		//echo "Image has been cropped and resized to 300x300 pixels.";
	}
	
?>