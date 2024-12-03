<?PHP
session_start();

include("database.php");
?>
<?PHP 
$id_order 	= (isset($_REQUEST['id_order'])) ? trim($_REQUEST['id_order']) : '0';

$SQL_list = "SELECT * FROM `order_food` WHERE order_food.id_order = $id_order ";
$result = mysqli_query($con, $SQL_list) ;
$data	= mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html>
<title>Aleesya Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}

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
  background-color: rgba(255, 255, 255, 0.5);
  background-blend-mode: overlay;
}

.w3-bar .w3-button {
  padding: 16px;
}
</style>

<body>

<div class="w3-containerx w3-top" id="contact">
    <div class="w3-content w3-container w3-padding-16 " style="max-width:450px">		 
		<a href="index.php" class="w3-right"><i class="fa fa-fw fa-times-circle fa-2x"></i></a> 
	</div>
</div>


<div class="bgimg-1" >

	<div class="w3-padding-24"></div>
		
<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card " style="max-width:500px">
		
		<div class="w3-padding-small"></div>
		<div class="w3-light-grey w3-padding-small w3-center">
			<div class="w3-xlarge">Order No</div>
			<div class="w3-xlarge"><b><?PHP echo $data["booking_id"];?></b></div>
		</div>
		
		<div class="w3-center w3-large w3-padding-16">Aleesya Cafe</div>

<?PHP 
$color1 = $color2 = $color3 = $color4 = "";
$disable2 = $disable3 = $disable4 = "";
$icon2 = $icon3 = $icon4 = "fa-circle";
	
if($data["status"] == "Order Placed") {
	$icon2 	= "fa-circle";
	$icon3 	= "fa-circle";
	$icon4 	= "fa-circle";
	$color1 = "w3-text-blue";
	$disable2 = "w3-disabled";
	$disable3 = "w3-disabled";
	$disable4 = "w3-disabled";
}

if($data["status"] == "Order Confirmed") {
	$icon2 	= "fa-check-circle";
	$icon3 	= "fa-circle";
	$icon4 	= "fa-circle";
	$color2 = "w3-text-blue";
	$disable3 = "w3-disabled";
	$disable4 = "w3-disabled";
}

if($data["status"] == "Order Processed") {
	$icon2 	= "fa-check-circle";
	$icon3 	= "fa-check-circle";
	$icon4 	= "fa-circle";
	$color3 = "w3-text-blue";
	$disable4 = "w3-disabled";
}

if($data["status"] == "Ready to Pickup") {
	$icon2 	= "fa-check-circle";
	$icon3 	= "fa-check-circle";
	$icon4 	= "fa-check-circle";
	$color4 = "w3-text-blue";
}
?>
			
		<div class="w3-row w3-padding-24 <?PHP echo $color1;?>">
			<div class="w3-col s1 w3-center w3-padding-16"><i class="far fa-check-circle fa-lg"></i></div>
			<div class="w3-col s3 w3-center"><i class="far fa-file-alt fa-3x"></i></div>
			<div class="w3-col s8">
			<div class="w3-large"><b>Order Placed</b></div>
			<span class="w3-small">We have received your order.</span>
			</div>
		</div>
		
		<div class="w3-row w3-padding-16 <?PHP echo $color2 . " " . $disable2;?>">
			<div class="w3-col s1 w3-center w3-padding-16"><i class="far <?PHP echo $icon2;?> fa-lg"></i></div>
			<div class="w3-col s3 w3-center"><i class="far fa-thumbs-up fa-3x"></i></div>
			<div class="w3-col s8">
			<div class="w3-large"><b>Order Confirmed</b></div>
			<span class="w3-small">Your order have been confirmed.</span>
			</div>
		</div>
		
		<div class="w3-row w3-padding-16 <?PHP echo $color3 . " " . $disable3;?>">
			<div class="w3-col s1 w3-center w3-padding-16"><i class="far <?PHP echo $icon3;?> fa-lg"></i></div>
			<div class="w3-col s3 w3-center"><i class="fas fa-utensils fa-3x"></i></div>
			<div class="w3-col s8">
			<div class="w3-large"><b>Order Processed</b></div>
			<span class="w3-small">We are preparing your order.</span>
			</div>
		</div>
		
		<div class="w3-row w3-padding-16 <?PHP echo $color4 . " " . $disable4;?>">
			<div class="w3-col s1 w3-center w3-padding-16"><i class="far <?PHP echo $icon4;?> fa-lg"></i></div>
			<div class="w3-col s3 w3-center"><i class="fas fa-gift fa-3x"></i></div>
			<div class="w3-col s8">
			<div class="w3-large"><b>Ready to Pickup</b></div>
			<span class="w3-small">Your order ready for pickup.</span>
			</div>
		</div>	

		<div class="w3-padding-24 w3-center">		
		<a href="track.php?id_order=<?PHP echo $id_order;?>" class="w3-button w3-block w3-large w3-wide w3-red w3-round"><b>Refresh</b></a>			
		</div>	

    </div>
</div>



	
</div>

	

 
<script>

// Toggle between showing and hiding the sidebar when clicking the menu icon
var mySidebar = document.getElementById("mySidebar");

function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
  } else {
    mySidebar.style.display = 'block';
  }
}

// Close the sidebar with the close button
function w3_close() {
    mySidebar.style.display = "none";
}
</script>

</body>
</html>
