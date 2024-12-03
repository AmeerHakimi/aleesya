<?PHP
session_start();

include("database.php");
if( !verifyAdmin($con) ) 
{
	header( "Location: admin.php" );
	return false;
}
?>
<?PHP
$act = (isset($_GET['act'])) ? trim($_GET['act']) : '';

if($act == "logout")
{
	session_destroy();
	
	header("Location:index.php");	
}
?>
<!DOCTYPE html>
<html>
<title>Aleesya Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
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

.w3-blue-gray {
	background : #6ebdef;
}
</style>

<body class="bgimg-1">


<div class="" >

<div class="w3-padding-16"></div>

<div class="w3-container " id="contact">
    <div class="w3-content w3-container" style="max-width:600px">

	<div class="w3-padding-32"></div>
	
	<div class="w3-center w3-white w3-card w3-padding w3-padding-16 w3-round-large w3-largex w3-margin-bottom">
		Thank you for using this app
		<div class="w3-padding-16">
			<a href="?act=logout" class="w3-button w3-padding-16 w3-round-large w3-red" style="width:80%">Log Out <i class="fas fa-fw fa-sign-out-alt fa-lg"></i> </a>
		</div>
		
		<div class="w3-center w3-padding-16 "><a href="a-main.php" >Cancel</a></div>	
		
	</div>
	
    </div>
</div>



</div>
	


</body>
</html>
