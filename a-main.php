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
$tot_neworder	= numRows($con, "SELECT * FROM `order_food` WHERE `status` = 'Order Placed'");
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
  background-image: url(images/banner.jpg);
  background-color: rgba(255, 2555, 255, 0.7);
  background-blend-mode: overlay;
}

.w3-bar .w3-button {
  padding: 16px;
}

input.cpwd {
  -webkit-text-security: circle;  
  /* circle , square , disk */
}

.w3-merah,.w3-hover-merah:hover{color:#fff!important;background-color:#fe0000!important}

</style>

<body class="w3-light-grey">

<div class="w3-top">
<div class="w3-row w3-white w3-padding-small">
	<div class="w3-content" >
	<a href="a-main.php" class=""><img src="images/logo.png" class="w3-padding-small w3-image" style="height:60px"></a>
	<div class="w3-right"><div class="w3-padding"><a href="a-sign-out.php" class="w3-button w3-red w3-round">Logout</a></div></div>
	</div>
</div>
</div>


<div class="w3-padding-32"></div>

<!-- Content -->
<div class="w3-center" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:600px">
		<div class="w3-xlarge w3-center w3-padding-16" style="line-height: 1.3;"><b>Administrator Dashboard</b></div>
		
		<div class="w3-row w3-padding-small">
		
			<a href="a-order.php?sta_filter=Order Placed">
			<div class="w3-col s6 w3-padding-small w3-center">
				<div class="w3-red w3-round w3-padding w3-padding-16">
				<i class="w3-block fa fa-cart-plus fa-4x"></i>
				New Order (<?PHP echo $tot_neworder;?>)
				</div>
			</div>
			</a>
			
			<a href="a-order.php?sta_filter=All">
			<div class="w3-col s6 w3-padding-small w3-center">
				<div class="w3-red w3-round w3-padding w3-padding-16">
				<i class="w3-block fa fa-tasks fa-4x"></i>
				Order History 
				</div>
			</div>
			</a>
		
			<a href="a-product.php">
			<div class="w3-col s6 w3-padding-small w3-center">
				<div class="w3-red w3-round w3-padding w3-padding-16">
				<i class="w3-block fa fa-utensils fa-4x"></i>
				Manage Food & Beverage
				</div>
			</div>
			</a>
		
			<a href="a-feedback.php">
			<div class="w3-col s6 w3-padding-small w3-center">
				<div class="w3-black w3-round w3-padding w3-padding-16">
				<i class="w3-block fa fa-file-alt fa-4x"></i>
				Feedback
				</div>
			</div>
			</a>
			
			<a href="a-user.php">
			<div class="w3-col s6 w3-padding-small w3-center">
				<div class="w3-black w3-round w3-padding w3-padding-16">
				<i class="w3-block fa fa-users fa-4x"></i>
				User
				</div>
			</div>
			</a>
			
			<a href="a-profile.php">
			<div class="w3-col s6 w3-padding-small w3-center">
				<div class="w3-black w3-round w3-padding w3-padding-16">
				<i class="w3-block fa fa-user-edit fa-4x"></i>
				Profile 
				</div>
			</div>
			</a>
		
		</div>
		
		
		
		

				
	</div>
</div>
<!-- Content End -->



</body>
</html>
