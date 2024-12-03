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

$category	= (isset($_REQUEST['category'])) ? trim($_REQUEST['category']) : 'food';
$id_product	= (isset($_REQUEST['id_product'])) ? trim($_REQUEST['id_product']) : '0';

$item		= (isset($_POST['item'])) ? trim($_POST['item']) : '';
$description= (isset($_POST['description'])) ? trim($_POST['description']) : '';
$price		= (isset($_POST['price'])) ? trim($_POST['price']) : '0';

$item		=	mysqli_real_escape_string($con, $item);
$description=	mysqli_real_escape_string($con, $description);

$success = "";

if($act == "add")
{	
	$SQL_insert = " 
	INSERT INTO `product`(`id_product`, `category`, `item`, `description`, `price`, `photo`) 
				VALUES (NULL,'$category','$item','$description','$price','')";		
										
	$result = mysqli_query($con, $SQL_insert);
	
	$id_product = mysqli_insert_id($con);
	
	// -------- Photo -----------------
	if(isset($_FILES['photo'])){
		 
		  $file_name = $_FILES['photo']['name'];
		  $file_size = $_FILES['photo']['size'];
		  $file_tmp = $_FILES['photo']['tmp_name'];
		  $file_type = $_FILES['photo']['type'];
		  
		  $fileNameCmps = explode(".", $file_name);
		  $file_ext = strtolower(end($fileNameCmps));
		  
		  if(empty($errors)==true) {
			 move_uploaded_file($file_tmp,"upload/".$file_name);
			 
			 // Crop the image to 300x300
			$targetFile = "upload/".$file_name;
			$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));						 
            // cropImage($targetFile, $imageFileType);;
			// -------------------------
			 
			$query = "UPDATE `product` SET `photo`='$file_name' WHERE `id_product` = '$id_product'";			
			$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
		  }else{
			 print_r($errors);
		  }  
	}
	// -------- End Photo -----------------
	
	$success = "Successfully Add";
	
	print "<script>self.location='a-product.php';</script>";
}

if($act == "edit")
{	
	$SQL_update = " UPDATE
						`product`
					SET
						`category` = '$category',
						`item` = '$item',
						`description` = '$description',
						`price` = '$price'
					WHERE `id_product` =  '$id_product'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	// -------- Photo -----------------
	if(isset($_FILES['photo'])){
		 
		  $file_name = $_FILES['photo']['name'];
		  $file_size = $_FILES['photo']['size'];
		  $file_tmp = $_FILES['photo']['tmp_name'];
		  $file_type = $_FILES['photo']['type'];
		  
		  $fileNameCmps = explode(".", $file_name);
		  $file_ext = strtolower(end($fileNameCmps));
		  
		  if(empty($errors)==true) {
			 move_uploaded_file($file_tmp,"upload/".$file_name);
			 
			 // Crop the image to 300x300
			$targetFile = "upload/".$file_name;
			$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));						 
            // cropImage($targetFile, $imageFileType);
			// -------------------------
			
			$query = "UPDATE `product` SET `photo`='$file_name' WHERE `id_product` = '$id_product'";		
			$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
		  }else{
			 print_r($errors);
		  }  
	}
	// -------- End Photo -----------------
	
	$success = "Successfully Update";
	print "<script>self.location='a-product.php';</script>";
}

if($act == "photo_del")
{
	$dat	= mysqli_fetch_array(mysqli_query($con, "SELECT `photo` FROM `product` WHERE `id_product`= '$id_product'"));
	unlink("upload/" .$dat['photo']);
	$rst_d 	= mysqli_query( $con, "UPDATE `product` SET `photo`='' WHERE `id_product` = '$id_product' " );
	print "<script>self.location='a-product.php';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `product` WHERE `id_product` =  '$id_product' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	print "<script>self.location='a-product.php';</script>";
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

input.cpwd {
  -webkit-text-security: circle;  
  /* circle , square , disk */
}


</style>

<body class="w3-light-grey">

<div class="w3-top">
<div class="w3-row w3-white w3-padding-16">
	<div class="w3-content" >
		<a href="a-main.php" class="w3-col s2 "><i class="w3-margin-left fa fa-arrow-left fa-lg"></i></a>
		<div class="w3-col s8 w3-center w3-large"><b>Manage Product</b></div>	
	</div>
</div>
</div>

<div class="" >

	
<div class="w3-padding-48"></div>

<?PHP
$bil = 0;
$SQL_list = "SELECT * FROM `product`";
$result = mysqli_query($con, $SQL_list) ;
while ( $data	= mysqli_fetch_array($result) )
{
	$bil++;
	$id_product	= $data["id_product"];
	$category	= $data["category"];
	$photo		= $data["photo"];
	if(!$photo) $photo = "noimage.jpg";
	
	$Cat = "";
	if($category == 1) $Cat = "NASI";
	if($category == 2) $Cat = "MEE / MAGGIE / KUEYTIOW";
	if($category == 3) $Cat = "SUP / TOMYAM";
	if($category == 4) $Cat = "WESTERN";
	if($category == 5) $Cat = "BURGER";
	if($category == 6) $Cat = "LAIN-LAIN";
	if($category == 7) $Cat = "MINUMAN";
	if($category == 9) $Cat = "SAYUR";
?>			
<div class="w3-container w3-padding-12" id="contact">
    <div class="w3-content w3-container w3-card w3-white w3-round-large w3-padding-small" style="max-width:600px">
			
			<div class="w3-row">
				<div class="w3-col s3">
				<img src="upload/<?PHP echo $photo;?>" class="w3-image" style="width:80px">
				</div>
				<div class="w3-col s9">
					<b><?PHP echo $data["item"] ;?></b><br>
					RM <?PHP echo number_format($data["price"],2) ;?><br>
					<div class="w3-tag w3-round w3-small"><?PHP echo $Cat ;?></div>
					<span class="w3-right">							
						<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class=""><i class="fa fa-fw fa-edit fa-lg"></i></a>			
						<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-text-red"><i class="fa fa-fw fa-trash-alt"></i></a>
					</span>
				</div>
			</div>
			
    </div>
</div>
<div class="w3-padding"></div>

<div id="idEdit<?PHP echo $bil; ?>" class="w3-modal" style="z-index:10;">
	<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idEdit<?PHP echo $bil; ?>').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

		<div class="w3-container w3-padding">
		
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update Menu</b>
			<hr>

				<div class="w3-section" >
					<label >Photo</label>
					<?PHP if($data["photo"] =="") { ?>
					<div class="custom-file">
						<input type="file" class="w3-input w3-border w3-round" name="photo" id="photo" accept=".jpeg, .jpg,.png,.gif">
					</div>
					<p></p>
					<?PHP } ?>
										
					<?PHP if($data["photo"] <>"") { ?>
					<div class="w3-input w3-border w3-round">
					<a class="w3-tag w3-green w3-round" target="_BLANK" href="upload/<?PHP echo $data["photo"]; ?>"><small>View</small></a>

					<a class="w3-tag w3-red w3-round" href="?act=photo_del&id_product=<?PHP echo $data["id_product"];?>"><small>Remove</small></a>
					</div>
					<?PHP } else { ?><span class="w3-tag w3-round"> <small>None</small></span><?PHP } ?>
					<small>  only JPEG, JPG, PNG or GIF allowed </small>
				</div>
				
				<div class="w3-section" >
					Category *
					<select class="w3-select w3-border w3-round" name="category" required>
						<option value="">- Select Category - </option>
						<option value="8" <?PHP if($data["category"] == "8") echo "selected";?>>PROMOSI</option>
						<option value="1" <?PHP if($data["category"] == "1") echo "selected";?>>NASI</option>
						<option value="2" <?PHP if($data["category"] == "2") echo "selected";?>>MEE / MAGGIE / KUEYTIOW</option>
						<option value="3" <?PHP if($data["category"] == "3") echo "selected";?>>SUP / TOMYAM</option>
						<option value="4" <?PHP if($data["category"] == "4") echo "selected";?>>WESTERN</option>
						<option value="5" <?PHP if($data["category"] == "5") echo "selected";?>>BURGER</option>
						<option value="9" <?PHP if($data["category"] == "9") echo "selected";?>>SAYUR</option>
						<option value="6" <?PHP if($data["category"] == "6") echo "selected";?>>LAIN-LAIN</option>
						<option value="7" <?PHP if($data["category"] == "7") echo "selected";?>>MINUMAN</option>
					</select>
				</div>
				
				<div class="w3-section" >
					Menu Name
					<input class="w3-input w3-border w3-round" type="text" name="item" value="<?PHP echo $data["item"]; ?>" placeholder="e.g: Teh Tarik (HOT)">
				</div>
				
				<div class="w3-section" >
					Price RM *
					<input class="w3-input w3-border w3-round" type="number" step="0.01" name="price" value="<?PHP echo $data["price"]; ?>" placeholder="" required>
				</div>
				
				<div class="w3-section" >
					<label>Description *</label>
					<textarea class="w3-input w3-border w3-round" name="description" id="makeMeSummernote" rows="5" required><?PHP echo $data["description"]; ?></textarea>
				</div>
			  
			<hr class="w3-clear">
			<input type="hidden" name="id_product" value="<?PHP echo $data["id_product"];?>" >
			<input type="hidden" name="act" value="edit" >
			<button type="submit" class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round-large">SAVE CHANGES</button>
		</form>
		</div>
	</div>
<div class="w3-padding-24"></div>
</div>


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
			
			<input type="hidden" name="id_product" value="<?PHP echo $data["id_product"];?>" >
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

<div id="idAdd" class="w3-modal" >
    <div class="w3-modal-content w3-round-large w3-card-4 w3-animate-zoom" style="max-width:600px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('idAdd').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>
	  
      <div class="w3-container w3-padding">
		
		<form action="" method="post" enctype="multipart/form-data" >
			<div class="w3-padding"></div>
			<b class="w3-large">Add Menu</b>
			<hr>
			  	
				<div class="w3-section" >
					<label>Photo *</label>
					<input class="w3-input w3-border w3-round" type="file" name="photo" required >
					<small>  only JPEG, JPG, PNG or GIF allowed </small>
				</div>
				
				<div class="w3-section" >
					Category *
					<select class="w3-select w3-border w3-round" name="category" required>
						<option value="">- Select Category - </option>
						<option value="8" >PROMOSI</option>
						<option value="1" >NASI</option>
						<option value="2" >MEE / MAGGIE / KUEYTIOW</option>
						<option value="3" >SUP / TOMYAM</option>
						<option value="4" >WESTERN</option>
						<option value="5" >BURGER</option>
						<option value="9" >SAYUR</option>
						<option value="6" >LAIN-LAIN</option>
						<option value="7" >MINUMAN</option>
					</select>
				</div>
				
				<div class="w3-section" >
					Menu Name *
					<input class="w3-input w3-border w3-round" type="text" name="item" value="" placeholder="e.g: Teh Tarik (HOT)" required>
				</div>
				
				<div class="w3-section" >
					Price RM *
					<input class="w3-input w3-border w3-round" type="number" step="0.01" name="price" value="" placeholder="e.g 30" required>
				</div>
				
				<div class="w3-section" >
					<label>Decsription *</label>
					<textarea class="w3-input w3-border w3-round" name="description" id="makeMeSummernote2" rows="5"  required></textarea>
				</div>

			  <hr class="w3-clear">
			  
			  <div class="w3-section" >
				<input name="act" type="hidden" value="add">
				<button type="submit" class="w3-button w3-blue w3-text-white w3-margin-bottom w3-round-large">SUBMIT</button>
			  </div>
			</div>  
		</form> 
         
      </div>
<div class="w3-padding-24"></div>
</div>
	

<!-- Script -->
<script type="text/javascript">
	$('#makeMeSummernote,#makeMeSummernote2').summernote({
		height:200,
	});
</script>

	
<style>
.element {
  position: fixed;
  /*z-index: 999;*/
  right: 10px;
  bottom: 5%;
  margin-top: -2.5em;
}
</style>
<div class="element">
<a onclick="document.getElementById('idAdd').style.display='block'; w3_close()" class="w3-xlarge"><i class="fa fa-fw fa-4x fa-plus-circle w3-text-red w3-white w3-circle" style="width:100px"></i></a>
</div>	
	

</body>
</html>
