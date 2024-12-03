<?PHP
session_start();

include("database.php");
?>
<?PHP
$id_order 	= (isset($_REQUEST['id_order'])) ? trim($_REQUEST['id_order']) : '0';

unset($_SESSION["qty"]); //The quantity for each product
unset($_SESSION["amounts"]); //The amount from each product
unset($_SESSION["total"]); //The total cost
unset($_SESSION["cart"]); //Which item has been chosen
?>
<!DOCTYPE html>
<html>
<title>Aleesya Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

	<div class="w3-padding-32"></div>
		
<div class="w3-container w3-padding-16" id="contact">
    <div class="w3-content w3-container w3-white w3-round w3-card w3-padding-32" style="max-width:500px">
		<div class="w3-center"><img src="images/logo.png" class="w3-image" width="100px"></div>
			
		<div class="w3-padding w3-center">
			<div class="w3-padding-24"></div>
			
			<h3>Your Order has been submitted!</h3>
			
			<div class="w3-padding-24"></div>
			
			<a href="track.php?id_order=<?PHP echo $id_order;?>" class="w3-button w3-block w3-large w3-wide w3-red w3-round"><b>Track Order</b></a>
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
