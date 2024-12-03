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
$id_admin	= $_SESSION["id_admin"];

$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$username	= (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password	= (isset($_POST['password'])) ? trim($_POST['password']) : '';

$username	=	mysqli_real_escape_string($con, $username);

$success = "";

if($act == "edit")
{	
	$SQL_update = " 
	UPDATE
		`admin`
	SET
		`username` = '$username',
		`password` = '$password'
	WHERE
		id_admin = $id_admin
	";
										
	$result = mysqli_query($con, $SQL_update);
	
	$success = "Successfully Updated";
	
	//print "<script>self.location='a-profile.php';</script>";
}

$SQL_list 	= "SELECT * FROM `admin` WHERE `id_admin` = '$id_admin'  ";
$result 	= mysqli_query($con, $SQL_list) ;
$data		= mysqli_fetch_array($result);
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
  background-image: url("images/back2.jpg");
  min-height: 100%;
}

.w3-bar .w3-button {
  padding: 16px;
}

.w3-merah,.w3-hover-merah:hover{color:#fff!important;background-color:#fe0000!important}

</style>

<body class="w3-light-grey">

	
<div class="w3-padding"></div>

<div class="w3-top">
<div class="w3-row w3-white w3-padding-16">
	<div class="w3-content" >
		<a href="a-main.php" class="w3-col s2 "><i class="w3-margin-left fa fa-arrow-left fa-lg"></i></a>
		<div class="w3-col s8 w3-center w3-large"><b>Admin Profile</b></div>	
	</div>
</div>
</div>

<div class="w3-padding"></div>

<!--- Toast Notification -->
<?PHP 
if($success) { Notify("success", $success, "a-main.php"); }
?>	
<!-- Content -->

<div class="w3-containerx" id="contact">
    <div class="w3-content w3-container w3-padding-16" style="max-width:450px">
		
		<div class="w3-padding-32"></div>
		
		<form action="" method="post">			
				
			<div class="w3-section" >
				username
				<input class="w3-input w3-border w3-padding w3-round-large" type="username" name="username" value="<?PHP echo $data["username"];?>" placeholder="username" maxlength="100" required>
			</div>

			<div class="w3-section">
				Password
				<input class="w3-input w3-border w3-padding w3-round-large cpwdx" type="password" name="password" id="password" value="<?PHP echo $data["password"];?>" placeholder="Password" maxlength="40" required>
				<div class="w3-center w3-small">Password must at least be 6 characters</div>
			</div>
			
			<div class="w3-padding"></div>

			<div class="w3-center">
				<input name="act" type="hidden" value="edit">
				<button type="submit" class="w3-padding-large w3-block w3-button w3-margin-bottom w3-round-large w3-red"><b>SAVE CHANGES</b></button>
			</div>
		</form>
		
		<div class="w3-padding-16"></div>
				
	</div>
</div>
<!-- Content End -->


</body>
</html>
