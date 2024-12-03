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
$act 		= (isset($_REQUEST['act'])) ? trim($_REQUEST['act']) : '';	

$id_feedback	= (isset($_REQUEST['id_feedback'])) ? trim($_REQUEST['id_feedback']) : '0';

$success = "";


if($act == "del")
{
	$SQL_delete = " DELETE FROM `feedback` WHERE `id_feedback` =  '$id_feedback' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	print "<script>self.location='a-feedback.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<title>Aleesya Cafe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- include summernote css-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- include summernote js-->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


<style>
a:link {
  text-decoration: none;
}

body,h1, h2,h3,h4,h5,h6 {font-family: "Poppins", sans-serif}

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
  background-color: rgba(255, 255, 255, 0.8);
  background-blend-mode: overlay;
  background-attachment:fixed;
}

.w3-bar .w3-button {
  padding: 16px;
}

</style>

<body class="w3-light-grey">


<div class="" >

<div class="w3-top">
<div class="w3-row w3-white w3-padding-16">
	<div class="w3-content" >
		<a href="a-main.php" class="w3-col s2 "><i class="w3-margin-left fa fa-arrow-left fa-lg"></i></a>
		<div class="w3-col s8 w3-center w3-large"><b>All Feedback</b></div>	
	</div>
</div>
</div>
	
<div class="w3-padding-48"></div>


<?PHP
$bil = 0;
$SQL_list = "SELECT * FROM `feedback` ";
$result = mysqli_query($con, $SQL_list) ;
while ( $data	= mysqli_fetch_array($result) )
{
	$bil++;
	$id_feedback= $data["id_feedback"];
	/*$photo	= $data["photo"];
	if(!$photo) $photo = "noimage.jpg";*/
?>			
<div class="w3-container w3-padding-12" id="contact">
    <div class="w3-content w3-container w3-card w3-white w3-round-large w3-padding-small" style="max-width:600px">
			
			<div class="w3-padding w3-padding-16">				
				<span class="w3-right">							
					<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-text-red"><i class="fa fa-fw fa-trash-alt"></i></a>
				</span>
				<?PHP echo $data["name"] ;?><br>
				<?PHP echo $data["email"] ;?>
				
				<hr style="margin: 10px 0px 0 0">

				<?PHP echo $data["feedback"] ;?>	
			</div>
			
    </div>
</div>
<div class="w3-padding"></div>



<div id="idDelete<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:500px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post">
			<div class="w3-padding"></div>
			<b class="w3-large">Confirmation</b>
			  
			<hr class="w3-clear">			
			Are you sure to delete this record ?
			<div class="w3-padding-16"></div>
			
			<input type="hidden" name="id_feedback" value="<?PHP echo $data["id_feedback"];?>" >
			<input type="hidden" name="act" value="del" >
			<button type="button" onclick="document.getElementById('idDelete<?PHP echo $bil; ?>').style.display='none'"  class="w3-button w3-gray w3-text-white w3-margin-bottom w3-round">CANCEL</button>
			
			<button type="submit" class="w3-right w3-button w3-red w3-text-white w3-margin-bottom w3-round">YES, CONFIRM</button>
		</form>
		</div>
	</div>
</div>
<?PHP } ?>

<div class="w3-padding-16"></div>

</div>

<div class="w3-padding-64"></div>
	

</body>
</html>
