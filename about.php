<?PHP
session_start();
//require_once("database.php");
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

<div class="w3-padding-48"></div>

<div class="w3-content w3-containerx " style="max-width:1000px">
	<div class="w3-margin w3-padding " >		
		
		<div class="w3-xlarge w3-text-white w3-center"><b>ABOUT US</b></div>
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding-32 w3-padding-large w3-round-xlarge w3-white">			
			<img src="images/cafe.png" style="width: 885px;px" >
			<p>Selamat datang ke Aleesya Cafe! Sejak 2016, kami bermula dengan pasukan kecil barista dan cef yang bersemangat yang berdedikasi untuk mencipta rasa yang unik dan pengalaman yang tidak dapat dilupakan. Hari ini, Aleesya Cafe berbangga menjadi makanan ruji komuniti, terkenal dengan suasana mesra dan perkhidmatan peribadi kami.</p>
			<p>Di sini, kami percaya bahawa detik-detik terbaik dalam hidup dikongsi melalui hidangan yang lazat. Kafe kami ialah tempat kegemaran untuk penggemar kopi, penggemar makanan dan sesiapa sahaja yang mencari ruang yang selesa dan santai untuk melepak. Aleesya Cafe diasaskan dengan misi mudah yang mewujudkan tempat di mana orang ramai boleh berhubung, berehat dan menikmati makanan dan minuman berkualiti tinggi.</p>
			<p>
			Inilah Top 3 Menu Terbaik di Aleesya Café!
			<ol>
				<li>Nasi Maghoh Ngat</li>
				<li>Teh Tarik</li>
				<li>Chicken Chop</li>
			</ol>
			<a target="_BLANK" href="https://maps.app.goo.gl/KsVHHh7GmcsW982w6"><img src="images/map.png" class="w3-image" style="max-width:890px"></a>
			<p>Lokasi: LOT-4, Jalan Meranti, Kampung Baharu Mak Cili, 24000 Chukai, Terengganu</p>
			<p>Phone Number: +603-72960728</p>
			<p>E-mail: AleesyaCafe24@gmail.com</p>
			</p>
			<p>
			Join Group Kami Untuk Sebarang Kemas Kini!</br>
			Facebook: <a target="_blank" class="w3-text-blue" href="https://www.facebook.com/groups/800118280026677/about">https://www.facebook.com/groups/800118280026677/about</a>
			</p>
		</div>
				
    </div>
</div>


</body>
</html>
