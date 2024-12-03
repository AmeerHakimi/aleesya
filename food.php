<?PHP
session_start();
include("database.php");

$cat 		= (isset($_GET['cat'])) ? trim($_GET['cat']) : '';

$act 		= (isset($_POST['act'])) ? trim($_POST['act']) : '';
$name 		= (isset($_SESSION['name'])) ? trim($_SESSION['name']) : '';
$phone 		= (isset($_SESSION['phone'])) ? trim($_SESSION['phone']) : '';
$option_in	= (isset($_SESSION['option_in'])) ? trim($_SESSION['option_in']) : '';
$table_in	= (isset($_SESSION['table_in'])) ? trim($_SESSION['table_in']) : '';
$time		= (isset($_SESSION['time'])) ? trim($_SESSION['time']) : date("H:i");

$found = 0;
$error = "";
$success = false;
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

.w3-bar .w3-button {
  padding: 16px;
}

</style>
<style>
div.scrollmenu {
  overflow: auto;
  white-space: nowrap;
}

div.scrollmenu a {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 6px;
  text-decoration: none;
}

div.scrollmenu a:hover {
  background-color: #777;
}
</style>
<body class="w3-light-grey">

<div class="w3-top">
<div class="w3-row w3-white w3-padding-16">
	<div class="w3-content" >
		<a href="menu.php" class="w3-col s2 "><i class="w3-margin-left fa fa-arrow-left fa-lg"></i></a>
		<div class="w3-col s9 w3-center w3-large"><b>Menu</b></div>
		<?PHP if(isset($_SESSION["phone"])) { ?>
			<a href="logout.php" class="w3-col s1 "><i class="fa fa-fw fa-power-off fa-lg"></i></a>
		<?PHP } ?>
	</div>
</div>
</div>

<div class="w3-padding-48"></div>

<div class="w3-content scrollmenu w3-center" style="max-width:600px">		
	<a class="w3-tag w3-round" onclick="openCity('Promosi')">Promosi</a>
	<a class="w3-tag w3-round" onclick="openCity('Nasi')">Nasi</a>
	<a class="w3-tag w3-round" onclick="openCity('Mee')">Mee</a>
	<a class="w3-tag w3-round" onclick="openCity('Tomyam')">Sup / Tomyam</a>
	<a class="w3-tag w3-round" onclick="openCity('Western')">Western</a>
	<a class="w3-tag w3-round" onclick="openCity('Burger')">Burger</a>
	<a class="w3-tag w3-round" onclick="openCity('Sayur')">Sayur</a>
	<a class="w3-tag w3-round" onclick="openCity('Lain')">Lain</a>
	<a class="w3-tag w3-round" onclick="openCity('Minuman')">Minuman</a>
</div>

<!-- content -->
<div class="w3-content w3-container" style="max-width:600px">	

	<div class="w3-padding-16"></div>
	<?PHP 
	$bil = -1; 
	$array_product = $array_amounts = "";
	?>
	<div id="Promosi" class="city" style="<?PHP if($cat <> 8) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 8");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}				
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=1"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>
	
	
	<div id="Nasi" class="city" style="<?PHP if($cat <> 1) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 1");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}				
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=1"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>

	<div id="Mee" class="city" style="<?PHP if($cat <> 2) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 2");			
		while ($data = mysqli_fetch_array($result))
		{	
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=2"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>

	<div id="Tomyam" class="city" style="<?PHP if($cat <> 3) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 3");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=3"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>
	
	<div id="Western" class="city" style="<?PHP if($cat <> 4) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 4");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=4"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>
	
	<div id="Burger" class="city" style="<?PHP if($cat <> 5) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 5");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}					
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=5"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>
	
	
	<div id="Sayur" class="city" style="<?PHP if($cat <> 9) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 9");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}					
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=5"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>
	
	<div id="Lain" class="city" style="<?PHP if($cat <> 6) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 6");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}			
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=6"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>
	
	<div id="Minuman" class="city" style="<?PHP if($cat <> 7) echo "display:none";?>">
		<?PHP
		$result = mysqli_query($con, " SELECT * FROM `product` WHERE category = 7");			
		while ($data = mysqli_fetch_array($result))
		{
			$bil++;	
			if($bil == 0){
				$products=array($data["item"]);
				$amounts =array($data["price"]);
			} else {
			
			array_push($products,$data["item"]);
			array_push($amounts,$data["price"]);
			}
		?>
		<div class="w3-col s6 w3-padding-small w3-smallx">
			<a href="#" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='block'">
			<div class="w3-round-large w3-border w3-white">
				<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round"><br>

				<div class="w3-row w3-padding-small">	
					<div class="w3-col s10">
						<b><?PHP echo $data["item"]; ?></b><br>
						<span class="w3-text-red">RM <?PHP echo $data["price"]; ?></span>
					</div>
					<div class="w3-col s2">					
						<span class="w3-center"><a href="?add=<?php echo($bil); ?>&cat=7"><i class="fas fa-plus-circle fa-2x w3-text-red w3-hover-text-blue"></i></a></span>
					</div>
				</div>
			</div>
			</a>
		</div>
		
		<div id="idPop<?PHP echo $bil;?>" class="w3-modal" style="z-index:10;">
			<div class="w3-modal-content w3-round-large w3-card-4 w3-animate-bottom" style="max-width:500px">
			  <header class="w3-container "> 
				<span onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'" 
				class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
			  </header>

				<div class="w3-container w3-padding">
						
					<div class="w3-padding"></div>
					<b class="w3-large"><?PHP echo $data["item"]; ?></b><br>
					  
					<hr class="w3-clear" style="margin : 10px 0 10px 0">
					<img src="upload/<?PHP echo $data["photo"]; ?>" class="w3-image w3-round-large" style="width:100%">
					
					<div class="w3-row">
					<div class="w3-right-align w3-large w3-padding-small"><b>RM <?PHP echo $data["price"]; ?></b></div>
					</div>
					<div><?PHP echo $data["description"]; ?></div>
					
					<div class="w3-padding-small"></div>
					
					<button type="button" onclick="document.getElementById('idPop<?PHP echo $bil;?>').style.display='none'"  class="w3-button w3-black w3-margin-bottom w3-round-xlarge">CLOSE</button>		
				</div>
			</div>
		</div>
		<?PHP } ?>
	</div>

	<script>
	function openCity(cityName) {
	  var i;
	  var x = document.getElementsByClassName("city");
	  for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";  
	  }
	  document.getElementById(cityName).style.display = "block";  
	}
	</script>


	
</div>
<!-- content end -->

<div class="w3-padding-small"></div>


<div class="w3-row"></div>
<div class="w3-padding-32"></div>


<?PHP
if($act == "addOrder")
{
	$name		= (isset($_POST['name'])) ? trim($_POST['name']) : '';
	$phone		= (isset($_POST['phone'])) ? trim($_POST['phone']) : '';
	$pay_method	= (isset($_POST['pay_method'])) ? trim($_POST['pay_method']) : 0;
	$pick_time 	= (isset($_POST['pick_time'])) ? trim($_POST['pick_time']) : '';
	$note	 	= (isset($_POST['note'])) ? trim($_POST['note']) : '';
	
	$booking_id = rand(10000,90000);
	
	// jika user belum daftar
	$found = numRows($con, "SELECT * FROM `user` WHERE `phone` = '$phone'");
	if($found == 0) {
		$SQL_insert = " 
		INSERT INTO `user`(`id_user`, `name`, `phone`, `password`) VALUES (NULL,'$name','$phone','$phone')
		";	

		$result = mysqli_query($con, $SQL_insert);
	}
	
	$SQL_insert = " 
	INSERT INTO `order_food`(`id_order`, `booking_id`, `name`, `phone`, `option_in`, `time`, `table_in`,  `pick_date`,  `pick_time`, `amount`, `pay_method`, `attachment`, `status`, `note`, `pdf`, `create_date`) 
					VALUES (NULL, '$booking_id', '$name',  '$phone', '$option_in', '$time', '$table_in', NOW(), '$pick_time', '".$_SESSION["total"]."', '$pay_method', '', 'Order Placed', '$note',  '', NOW() )
	";	

	$result = mysqli_query($con, $SQL_insert) or die("Error in query: ".$SQL_insert."<br />".mysqli_error($con));
	
	$id_order = mysqli_insert_id($con);
	
	foreach ( $_SESSION["cart"] as $i ) 
	{
		$food = ( $products[$_SESSION["cart"][$i]] );
		$quantity = ( $_SESSION["qty"][$i] );
		$price = "RM" . number_format( $_SESSION["amounts"][$i] ,2);
		
		$SQL_insert = " 
		INSERT INTO `order_detail`(`id_order`, `food`, `quantity`, `price`) 
		VALUES ('$id_order', '$food', '$quantity', '$price')";	

		$result = mysqli_query($con, $SQL_insert) or die("Error in query: ".$SQL_insert."<br />".mysqli_error($con));
	}
	
	// -------- attachment -----------------
	
	if(isset($_FILES['attachment'])){
		if(($_FILES["attachment"]["error"] == 0) && (isset($_FILES['attachment']))) {		 
		  $file_name = $_FILES['attachment']['name'];
		  $file_size = $_FILES['attachment']['size'];
		  $file_tmp = $_FILES['attachment']['tmp_name'];
		  $file_type = $_FILES['attachment']['type'];
		  
		  $fileNameCmps = explode(".", $file_name);
		  $file_ext = strtolower(end($fileNameCmps));
		  $new_file	= rand() . "." . $new_file;
		  
		  if(empty($errors)==true) {
			 move_uploaded_file($file_tmp,"upload/".$new_file);
			 
			$query = "UPDATE `order_food` SET `attachment`='$new_file' WHERE `id_order` = '$id_order'";			
			$result = mysqli_query($con, $query) or die("Error in query: ".$query."<br />".mysqli_error($con));
		  }else{
			 print_r($errors);
		  }  
	}}
	// -------- End attachment -----------------
 
	$success = true;
	
	// clear cart
	$_SESSION["qty"] = "";
	$_SESSION["amounts"] = "";
	$_SESSION["total"] = "";
	$_SESSION["cart"] = "";
	unset($_SESSION["qty"]); //The quantity for each product
	unset($_SESSION["amounts"]); //The amount from each product
	unset($_SESSION["total"]); //The total cost
	unset($_SESSION["cart"]); //Which item has been chosen	
	
	print "<script>self.location='done.php?id_order=$id_order';</script>";
}
?>			
			
<?PHP
//Load up session
 if ( !isset($_SESSION["total"]) ) {
   $_SESSION["total"] = 0;
   for ($i=0; $i< count($products); $i++) {
    $_SESSION["qty"][$i] = 0;
   $_SESSION["amounts"][$i] = 0;
  }
 }

 //---------------------------
 //Reset
 if ( isset($_GET['reset']) )
 {
 if ($_GET["reset"] == 'true')
   {
   unset($_SESSION["qty"]); //The quantity for each product
   unset($_SESSION["amounts"]); //The amount from each product
   unset($_SESSION["total"]); //The total cost
   unset($_SESSION["cart"]); //Which item has been chosen
   }
 }

 //---------------------------
 //Add
 if ( isset($_GET["add"]) )
   {
   $i = $_GET["add"];
   $qty = $_SESSION["qty"][$i] + 1;
   $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
   $_SESSION["cart"][$i] = $i;
   $_SESSION["qty"][$i] = $qty;
 }

  //---------------------------
  //Delete
  if ( isset($_GET["delete"]) )
   {
   $i = $_GET["delete"];
   $qty = $_SESSION["qty"][$i];
   $qty--;
   $_SESSION["qty"][$i] = $qty;
   //remove item if quantity is zero
   if ($qty == 0) {
    $_SESSION["amounts"][$i] = 0;
    unset($_SESSION["cart"][$i]);
  }
 else
  {
   $_SESSION["amounts"][$i] = $amounts[$i] * $qty;
  }
 }
?>

<div id="AddOrder" class="w3-modal" >
    <div class="w3-modal-content w3-white w3-round-large w3-card w3-animate-bottom" style="max-width:400px">
      <header class="w3-container "> 
        <span onclick="document.getElementById('AddOrder').style.display='none'" 
        class="w3-button w3-large w3-circle w3-display-topright "><i class="fa fa-fw fa-times"></i></span>
      </header>

      <div class="w3-containerx">
		
		<form method="post" action="" enctype="multipart/form-data" >
		<div class="w3-padding">
			<b class="w3-large">Checkout</b>
			<hr>
			
			<div class="w3-section w3-center" >
				<div class="w3-large">ORDER DETAILS</div>
				Confirm Order
			</div>
			
			
			  
<?php
 if ( isset($_SESSION["cart"]) ) {
 ?>
 <div><span class="w3-large">Cart</span>
  <a href="?reset=true&cat=<?PHP echo $cat;?>" class="w3-right w3-small w3-tag w3-red w3-round-xlarge"><i class="fa fa-fw fa-history"></i> RESET CART</a>
 </div>
 <table class="w3-table w3-table-all ">
 <tr>
 <th>Item</th>
 <th class="w3-center">Qty</th>
 <th>RM</th>
 <th></th>
 </tr>
 <?php
 $total = 0;
 foreach ( $_SESSION["cart"] as $i ) {
 ?>
 <tr>
 <td><?php echo( $products[$_SESSION["cart"][$i]] ); ?></td>
 <td class="w3-center"><?php echo( $_SESSION["qty"][$i] ); ?></td>
 <td><?php echo number_format( $_SESSION["amounts"][$i] ,2); ?></td>
 <td> 
 <a href="?delete=<?php echo($i); ?>&cat=<?PHP echo $cat;?>"><i class="fa fa-minus-circle fa-lg w3-text-red"></i></a>
 <a href="?add=<?php echo($i); ?>&cat=<?PHP echo $cat;?>"><i class="fa fa-plus-circle fa-lg w3-text-blue"></i></a>
 </td>
 </tr>
 <?php
 $total = $total + $_SESSION["amounts"][$i];
 }
 $_SESSION["total"] = $total;
 ?>
 <tr>
 <td>Total : </td>
 <td></td>
 <td><b><?php echo number_format($total,2); ?></b></td>
 <td></td>
 </tr>
 </table>
 <?php
 } 
 else $total = 0;
 ?>
			<div class="w3-section" >
				<label>Nickname *</label>
				<input class="w3-input w3-border w3-round" type="text" name="name" value="<?PHP echo $name;?>" required>
			</div>
			
			<div class="w3-section" >
				<label>Mobile Phone *</label>
				<input class="w3-input w3-border w3-round" type="text" name="phone" value="<?PHP echo $phone;?>" required>
			</div>
			
			<div class="w3-section " >
				<label>Option *</label>
				<select class="w3-select w3-border w3-round" name="option_in" required>
					<option value="DineIn" <?PHP if($option_in == "Dine") echo "selected";?>>Dine In</option>
					<option value="Pickup" <?PHP if($option_in == "Pickup") echo "selected";?>>Pickup</option>
				</select>
			</div>
			
			<?PHP if($_SESSION["table_in"] > 0) { ?>
			<div class="w3-section" >
				<label>Table </label>
				<input class="w3-input w3-border w3-round" type="number" name="table_in" value="<?PHP echo $_SESSION["table_in"];?>" >
			</div>
			<?PHP } ?>
						
			<div class="w3-section" >
				<label>Time *</label>
				<input class="w3-input w3-border w3-round" type="time" name="pick_time" value="<?PHP echo $_SESSION["time"];?>" required>
			</div>
			
			<hr>
			
			<img src="images/bank.jpeg" class="w3-image">
			
			<!--
			<div class="w3-border w3-amber w3-padding w3-round w3-padding-16">
				Please make payment to : <br>				
				<div class="w3-row">
					<div class="w3-col s4">Bank: </div>
					<div class="w3-col s8"><b>MAYBANK</b></div>
					<div class="w3-col s4">Acc No: </div>
					<div class="w3-col s8"><b>512011221345</b></div>
					<div class="w3-col s4">Acc Name: </div>
					<div class="w3-col s8"><b>ALEESYA CAFE</b></div>
				</div>
			</div>
			-->
			 
			<div class="w3-section " >
				<label>Amount (RM) *</label>
				<input class="w3-input w3-border w3-round" type="text" name="amountx" value="<?PHP echo number_format($total,2);?>" disabled>
			</div>
			  
			<div class="w3-section " >
				<label>Payment Method *</label>
				<select class="w3-select w3-border w3-round" name="pay_method" required>
					<option value="Online Pay">Online Pay</option>
					<option value="Cash">Cash</option>
				</select>
			</div>
			  
			<div class="w3-section" >
				<label>Attachment (Payment Slip) </label>
				<input class="w3-input w3-border w3-round" type="file" name="attachment" >
				<small>  only JPEG, JPG, PNG or GIF allowed </small>
			</div>
			
			<div class="w3-section " >
				<label>Note</label>
				<textarea class="w3-input w3-border w3-round" name="note"></textarea>
			</div>
  
			<div class="w3-section" >
				<input name="cat" type="hidden" value="<?PHP echo $cat;?>">
				<input name="act" type="hidden" value="addOrder">
				<button type="submit" class="w3-wide w3-button w3-block w3-padding-large w3-red w3-margin-bottom w3-round"><b>CONFIRM ORDER</b></button>
			</div>
		</div>  
		</form> 
         
      </div>

	  <div class="w3-padding-16"></div>
    </div>
</div>	

<footer class="w3-bottom w3-card-4 w3-red w3-padding-large w3-padding-16">
	<div class="w3-content">
	Total : 
	<?PHP if ( isset($_SESSION["cart"]) ) {  
	echo "RM " . number_format($total,2); 
	} ?>
	<span class="w3-right"><a href="#" onclick="document.getElementById('AddOrder').style.display='block'; " class="w3-tag w3-round-xlarge w3-white w3-hover-blue">View Cart</a></div>
	</div>
</footer>


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
