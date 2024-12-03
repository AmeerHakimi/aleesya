<?PHP
session_start();

$_SESSION["option_in"]	= (isset($_POST['option_in'])) ? trim($_POST['option_in']) : 'DineIn';
$_SESSION["time"]		= (isset($_POST['time'])) ? trim($_POST['time']) : date("H:i");
$_SESSION["table_in"]	= (isset($_POST['table_in'])) ? trim($_POST['table_in']) : 0;

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

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body class="w3-light-grey">

<div class="w3-top">
<div class="w3-row w3-white w3-padding-16">
	<div class="w3-content" >
		<a href="index.php" class="w3-col s2 "><i class="w3-margin-left fa fa-arrow-left fa-lg"></i></a>
		<div class="w3-col s9 w3-center w3-large"><b>Dashboard</b></div>	
		<?PHP if(isset($_SESSION["phone"])) { ?>
			<a href="logout.php" class="w3-col s1 "><i class="fa fa-fw fa-power-off fa-lg"></i></a>
		<?PHP } ?>
	</div>
</div>
</div>

<div class="w3-padding-48"></div>

<div class="w3-content w3-containerx " style="max-width:600px">
	<div class="w3-margin w3-padding " >		
		
		<a href="food.php?cat=8" class="w3-animate-zoom w3-hover-red w3-large w3-block w3-card w3-padding-16 w3-round-large w3-padding w3-center w3-blue"><b>SPECIAL OFFER !</b></a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=1" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>NASI</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu1.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=2" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>MEE / MAGGIE / KUEYTIOW</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu2.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=3" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>SUP / TOMYAM</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu3.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=4" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>WESTERN</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu4.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=5" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>BURGER</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu5.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=9" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>SAYUR</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu8.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=6" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>LAIN-LAIN</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu6.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
		<div class="w3-padding"></div>
		<a href="food.php?cat=7" class="w3-hover-red w3-row w3-large w3-block w3-card w3-padding-16x w3-round-large w3-white">
			<div class="w3-col s10 w3-padding-16 w3-padding"><b>MINUMAN</b></div>
			<div class="w3-col s2 w3-right-align"><img src="images/menu7.png" class="w3-image w3-round-large" style="height:60px"></div>
		</a>
    </div>
</div>

<div class="w3-padding-16"></div>


</body>
</html>
