<?PHP
session_start();
//require_once("database.php");
date_default_timezone_set('Asia/Kuala_Lumpur');

$option_in	= (isset($_POST['option_in'])) ? trim($_POST['option_in']) : 'Pickup';
?>
<!DOCTYPE html>
<html>
<title>Aleesya Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
a:link {
  text-decoration: none;
}

body,h1,h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

body, html {
  height: 100%;
  line-height: 1.5;
}

/* Full height image header */
.bgimg-1 {
  background-position: top;
  background-size: cover;
  min-height: 100%;
  background-image: url(images/banner.png);
  background-color: rgba(0, 0, 0, 0.4);
  background-blend-mode: overlay;
  background-attachment:fixed;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="bgimg-1">

<div class="w3-top">
<div class="w3-row w3-border w3-white">
	<div class="w3-content" >
	<a href="index.php" class=""><img src="images/logo.png" class="w3-padding-small w3-image" style="height:60px"></a>
	<div class="w3-right w3-padding">
		<a href="about.php" class="w3-button w3-round">About Us</a>
		<a href="feedback.php" class="w3-button w3-round">Feedback</a>
		<?PHP if(isset($_SESSION["phone"])) { ?>
			<a href="logout.php" class="w3-col s1 w3-padding-16"><i class="fa fa-fw fa-power-off fa-lg"></i></a>
		<?PHP } else { ?>
		<a href="login.php" class="w3-button w3-blue w3-round">Login</a>
		<?PHP } ?>
	</div>
	</div>
</div>
</div>

<div class="w3-padding-64"></div>


<div class="w3-content w3-containerx " style="max-width:600px">
	<div class="w3-margin w3-padding " >		
		
		<div class="w3-xlarge w3-text-white w3-center"><b>&nbsp;</b></div>
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding-32 w3-padding-large w3-round-xlarge w3-white">
			
			<form action="menu.php" method="post" class="">
				<div class="w3-padding"></div>
				Select Time
				<input class="w3-input w3-padding-16 w3-border w3-padding w3-round-large" name="time" type="time" min="<?PHP echo date("H:i"); ?>" value="">
			
				<div class="w3-padding-small"></div>
					  
				<div class="w3-section">
					<input name="option_in" type="hidden" value="<?PHP echo $option_in;?>">
					<button type="submit" class="w3-large w3-block w3-padding-16 w3-button w3-round-large w3-padding w3-center w3-green"><b>Proceed</b> <i class="fa fa-fw fa-chevron-right"></i></button>
				</div>
			</form>

		</div>
				
    </div>
</div>


</body>
</html>
