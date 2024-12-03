<?PHP
session_start();
?>
<?PHP
include("database.php");

$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';

$name		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
$phone		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';
$repassword	= (isset($_POST['repassword'])) ? trim($_POST['repassword']) : '';

$name		=	mysqli_real_escape_string($con, $name);

$error = "";
$success = false;

if($act == "register")
{	
	$found 	= numRows($con, "SELECT * FROM `user` WHERE `phone` = '$phone' ");
	if($found) $error ="Mobile phone already registered";
	
	if($password <> $repassword) $error ="Confirmation password not matched";
}

if(($act == "register") && (!$error))
{	
	$SQL_insert = " 	
	INSERT INTO `user`(`id_user`, `name`, `phone`, `password`) 
		VALUES (NULL, '$name', '$phone', '$password') ";
	
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

<div class="w3-content w3-containerx " style="max-width:600px">
	<div class="w3-margin w3-padding " >		
		
		<div class="w3-xlarge w3-text-white w3-center"><b>SIGN UP</b></div>
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding-32 w3-padding-large w3-round-xlarge w3-white">
			<?PHP if($error) { ?>
			<div class="w3-panel w3-center w3-pale-red w3-display-container w3-animate-zoom">
				<h3>Error!</h3>
				<?PHP echo $error;?>
			</div>	
			<?PHP } ?>
				

			<?PHP if($success) { ?>
			<div class="w3-panel w3-center w3-border w3-border-red w3-round w3-display-container w3-animate-zoom">
			  <h3>Congratulation!</h3>
			  <p>Your registration has been successful!<br>You can now <a href="login.php"><b>Login</b>.</a> </p>
			</div>
			<?PHP  } else { ?>	
				<form action="" method="post" class="">

					<div class="w3-section" >
						<input class="w3-input w3-border w3-padding w3-round-large" type="text" name="name" placeholder="Full Name" maxlength="100" required>
					</div>
								
					<div class="w3-section" >
						<input class="w3-input w3-border w3-padding w3-round-large" type="text" name="phone" placeholder="Mobile Phone" maxlength="100" required>
					</div>

					<div class="w3-section">
						<input class="w3-input w3-border w3-padding w3-round-large cpwdx" type="password" name="password" id="password" placeholder="Password" maxlength="40" required>
						<div class="w3-center w3-small">Password must at least be 6 characters</div>
					</div>

					<div class="w3-section">
						<input class="w3-input w3-border w3-padding w3-round-large cpwdx" type="password" name="repassword" id="repassword" placeholder="Confirm Password" maxlength="40" required>
						<div class="w3-padding w3-small"><input type="checkbox" onclick="myFunction()"> Show Password</div>
					</div>

					<script>
					function myFunction() {
					  var x = document.getElementById("password");
					  var y = document.getElementById("repassword");
					  if (x.type === "password") {
						x.type = "text";
						y.type = "text";
					  } else {
						x.type = "password";
						y.type = "password";
					  }
					}
					</script>



					<div class="w3-center">
						<input name="act" type="hidden" value="register">
						<button type="submit" class="w3-block w3-button  w3-margin-bottomx w3-round-large w3-red"><b>REGISTER</b></button>
					</div>
				</form> 
				<?PHP  }  ?>	
				<div class="w3-center ">I agree with <a href="#" onclick="document.getElementById('idTerm').style.display='block'" class="w3-text-red">Terms and Conditions</a></div>
				
			</div>		
				
		<div class="w3-center w3-text-white">Already have an account? <a href="index.php" class="w3-text-red">Log In</a></div>
	
    </div>
</div>

<div id="idTerm" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idTerm').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
				
			<div class="w3-padding"></div>
			<b class="w3-large">Terms & Conditions</b>
			  
			<hr class="w3-clear">
			
			<p><b>Aleesya Cafe : </b>  By signing up for an account, you agree to provide accurate, complete, and up-to-date information during the registration process and You agree not to share your login information with others. Aleesya Cafe is not liable for any unauthorized access to your account. </p>			
			
			<div class="w3-padding-16"></div>
			
			<button type="button" onclick="document.getElementById('idTerm').style.display='none'"  class="w3-button w3-red w3-text-white w3-margin-bottom w3-round-xlarge">CLOSE</button>		
		</div>
	</div>
</div>	

</body>
</html>
