<?PHP
session_start();
?>
<?PHP
include("database.php");

$phone 		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
$password 	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';

$error = "";

if($act == "login")
{	
	$SQL_login 	= " SELECT * FROM `user` WHERE `phone` = '$phone' AND `password` = '$password' ";

	$result = mysqli_query($con, $SQL_login);
	$data	= mysqli_fetch_array($result);

	$valid = mysqli_num_rows($result);

	if($valid > 0)
	{
		$_SESSION["name"] 	= $data["name"];
		$_SESSION["phone"] 	= $phone;
		$_SESSION["password"] 	= $password;
		
		header("Location:food.php?cat=1");

	}else{
		$error = "Invalid Login";
		header("refresh:1;url=login.php");
	}
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
		
		<div class="w3-xlarge w3-text-white w3-center"><b>SIGN IN</b></div>
		
		<div class="w3-padding-16"></div>
		
		<div class="w3-padding-32 w3-padding-large w3-round-xlarge w3-white">
			
			<?PHP if($error) { ?>
				<div class="w3-center w3-border w3-border-red w3-round" id="contact">
						<div class="w3-large">Error! </div>
						<?PHP echo $error;?>
				</div>	
			<?PHP } ?>

			<form action="" method="post" class="">
				
				<div class="w3-section" >
					<input class="w3-input w3-border w3-padding w3-round-large" type="text" name="phone" placeholder="Mobile Phone" required>
				</div>
				
				<div class="w3-section">
					<input class="w3-input w3-border w3-padding w3-round-large cpwdx" type="password" name="password" id="password" placeholder="Password" required>
					<div class="w3-padding w3-small"><input type="checkbox" onclick="myFunction()"> Show Password</div>
				</div>
				  
				<script>
				function myFunction() {
				  var x = document.getElementById("password");
				  if (x.type === "password") {
					x.type = "text";
				  } else {
					x.type = "password";
				  }
				}
				</script>
					
				<div class="w3-padding-small"></div>
				  
				<div class="w3-center">
				<input name="act" type="hidden" value="login">
				<button type="submit" class="w3-paddingx w3-block w3-button w3-large w3-round-large w3-red"><b>Login</b></button>
				</div>
			</form>		
		
		</div>
		
		
				
    </div>
	
	
</div>

<div class="w3-center w3-text-white">Don't have an account? <a href="register.php" class="w3-text-red">Sign Up</a></div>


<div class="w3-bottom">
<div class="w3-center w3-padding-16"><a href="admin.php" class="w3-text-white">Administrator</a></div>
</div>


</body>
</html>
