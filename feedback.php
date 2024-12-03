<?PHP
session_start();
?>
<?PHP
include("database.php");

$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';

$name		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$email		= (isset($_POST['email'])) ? trim($_POST['email']) : '';
$feedback	= (isset($_POST['feedback'])) ? trim($_POST['feedback']) : '';

$name		=	mysqli_real_escape_string($con, $name);
$feedback	=	mysqli_real_escape_string($con, $feedback);

$error = "";
$success = false;

if($act == "send")
{	
	$SQL_insert = " 	
	INSERT INTO `feedback`(`id_feedback`, `name`, `email`, `feedback`) 
		VALUES (NULL, '$name', '$email', '$feedback') ";
	
	$result = mysqli_query($con, $SQL_insert);
	$success = true;
}
?>
<!DOCTYPE html>
<html>
<title>Aleesya Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

input.cpwd {
  -webkit-text-security: circle;  
  /* circle , square , disk */
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
		<?PHP if(isset($_SESSION["email"])) { ?>
			<a href="logout.php" class="w3-col s1 w3-padding-16"><i class="fa fa-fw fa-power-off fa-lg"></i></a>
		<?PHP } else { ?>
		<a href="login.php" class="w3-button w3-blue w3-round">Login</a>
		<?PHP } ?>
	</div>
	</div>
</div>
</div>

<div class="w3-padding-48"></div>

<div class="w3-content w3-containerx " style="max-width:600px">
	<div class="w3-margin w3-padding " >		
		
		<div class="w3-xlarge w3-text-white w3-center"><b>FEEDBACK</b></div>
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding-32 w3-padding-large w3-round-xlarge w3-white">

			<?PHP if($success) { ?>
			<div class="w3-panel w3-center w3-border w3-border-red w3-round w3-display-container w3-animate-zoom">
			  <h3>Thanks!</h3>
			  <p>Thank you for your feedback</p>
			</div>
			<?PHP  } else { ?>	
				<form action="" method="post" class="">

					<div class="w3-section" >
						<input class="w3-input w3-border w3-padding w3-round-large" type="text" name="name" placeholder="Name *" maxlength="100" required>
					</div>
								
					<div class="w3-section" >
						<input class="w3-input w3-border w3-padding w3-round-large" type="email" name="email" placeholder="Email *" maxlength="100" required>
					</div>

					<div class="w3-section">
						<textarea class="w3-input w3-border w3-padding w3-round-large " rows="6" name="feedback" placeholder="Your Feedback *" required></textarea>
					</div>

					
					<div class="w3-center">
						<input name="act" type="hidden" value="send">
						<button type="submit" class="w3-block w3-button  w3-margin-bottomx w3-round-large w3-red"><b>SUBMIT</b></button>
					</div>
				</form> 
				<?PHP  }  ?>	
				
			</div>		

    </div>
</div>


</body>
</html>
