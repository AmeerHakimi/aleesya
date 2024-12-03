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

$id_order	= (isset($_REQUEST['id_order'])) ? trim($_REQUEST['id_order']) : '0';
$status		= (isset($_REQUEST['status'])) ? trim($_REQUEST['status']) : 'Order Placed';
$sta_filter	= (isset($_REQUEST['sta_filter'])) ? trim($_REQUEST['sta_filter']) : 'Order Placed';

$success = "";

if($act == "edit")
{	
	$SQL_update = " UPDATE
						`order_food`
					SET
						`status` = '$status'
					WHERE `id_order` =  '$id_order'";	
										
	$result = mysqli_query($con, $SQL_update) or die("Error in query: ".$SQL_update."<br />".mysqli_error($con));
	
	$success = "Successfully Update";
	print "<script>self.location='a-order.php?sta_filter=$sta_filter';</script>";
}

if($act == "del")
{
	$SQL_delete = " DELETE FROM `order_detail` WHERE `id_order` =  '$id_order' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$SQL_delete = " DELETE FROM `order_food` WHERE `id_order` =  '$id_order' ";
	$result = mysqli_query($con, $SQL_delete);
	
	$success = "Successfully Delete";
	print "<script>self.location='a-order.php?sta_filter=$sta_filter';</script>";
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
		<div class="w3-col s8 w3-center w3-large"><b>Orders</b></div>	
	</div>
</div>
</div>
	
<div class="w3-padding-48"></div>

<div class="w3-content w3-container" style="max-width:600px">
	<a href="?sta_filter=Order Placed" class="w3-button <?PHP if($sta_filter == "Order Placed") echo "w3-white"; else echo "w3-grey";?> w3-border">New Order</a>
	<a href="?sta_filter=All" class="w3-button <?PHP if($sta_filter == "All") echo "w3-white"; else echo "w3-grey";?> w3-border">All Order</a>
	<hr style="margin: 0 0px 20px 0">
</div>

<?PHP
$sql_status = "";
if($sta_filter == 'Order Placed') 
	$sql_status = "AND `status` = 'Order Placed'";
else
	$sql_status = "AND `status` <> 'Order Placed'";

$bil = 0;
$SQL_list = "SELECT * FROM `order_food` WHERE 1 $sql_status ORDER BY id_order DESC";
$result = mysqli_query($con, $SQL_list) ;
while ( $data	= mysqli_fetch_array($result) )
{
	$bil++;
	$id_order= $data["id_order"];
?>			
<div class="w3-container w3-padding-12" id="contact">
    <div class="w3-content w3-container w3-card w3-white w3-round-large w3-padding-16" style="max-width:600px">

			<div class="w3-row">
				<div class="w3-col s4">Username : </div>
				<div class="w3-col s8"><?PHP echo $data["name"] ;?></div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Phone : </div>
				<div class="w3-col s8"><?PHP echo $data["phone"] ;?></div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Order ID :</div>
				<div class="w3-col s8"><?PHP echo $data["booking_id"] ;?></div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Total :</div>
				<div class="w3-col s8"><?PHP echo number_format($data["amount"],2) ;?></div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Option :</div>
				<div class="w3-col s8"><b><?PHP echo $data["option_in"] ;?></b></div>
			</div>
			
			<?PHP if($data["option_in"] == "DineIn") { ?>
			<div class="w3-row">
				<div class="w3-col s4">Table No : </div>
				<div class="w3-col s8"><?PHP echo $data["table_in"]; ?></div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Time : </div>
				<div class="w3-col s8"><?PHP echo $data["time"]; ?></div>
			</div>
			<?PHP } else { ?>
			
			<div class="w3-row">
				<div class="w3-col s4">Pick Date : </div>
				<div class="w3-col s8"><?PHP echo $data["pick_date"]; ?></div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Pick Time : </div>
				<div class="w3-col s8"><?PHP echo $data["pick_time"]; ?></div>
			</div>
			<?PHP } ?>
			
			<div class="w3-row">
				<div class="w3-col s4">Pay Method :</div>
				<div class="w3-col s8"><?PHP echo $data["pay_method"] ;?></div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Attachment :</div>
				<div class="w3-col s8">
					<?PHP if($data["attachment"] <> "") { ?>
					<a target="_blank" href="upload/<?PHP echo $data["attachment"] ;?>" class="w3-tag w3-small w3-round">View</a>
					<?PHP } ?>
				</div>
			</div>
			
			<div class="w3-row">
				<div class="w3-col s4">Status :</div>
				<div class="w3-col s8"><?PHP echo $data["status"] ;?></div>
			</div>
			
			<hr style="margin: 10px 0 10px 0">
			<span class="">
			<?PHP
			$sql = "SELECT * FROM `order_detail` WHERE `id_order` =  $id_order";
			$rst = mysqli_query($con, $sql) ;
			while ( $dat = mysqli_fetch_array($rst) )
			{
				echo $dat["quantity"] . " x " . $dat["food"]. "<br>";
			} 
			?>
			</span>
			
			<hr style="margin: 10px 0 10px 0">
			
			<div class="w3-row">
				<div class="w3-col s3">Note :</div>
				<div class="w3-col s9"><?PHP echo $data["note"] ;?></div>
			</div>
			
			<hr style="margin: 10px 0 10px 0">

			<div class="w3-center">							
				<a href="#" onclick="document.getElementById('idEdit<?PHP echo $bil;?>').style.display='block'" class="w3-button w3-blue w3-round-large"><i class="fa fa-fw fa-edit fa-lg"></i> Update</a>			
				<a title="Delete" onclick="document.getElementById('idDelete<?PHP echo $bil;?>').style.display='block'" class="w3-button w3-red  w3-round-large"><i class="fa fa-fw fa-trash-alt"></i> Delete</a>
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
		
		<form action="" method="post" >
			<div class="w3-padding"></div>
			<b class="w3-large">Update Order</b>
			<hr>

				
				<div class="w3-section" >
					Status *
					<select class="w3-select w3-border w3-round" name="status" required>			
						<option value="Order Placed" <?PHP if($data["status"] == "Order Placed") echo "selected";?>>Order Placed</option>					
						<option value="Order Confirmed" <?PHP if($data["status"] == "Order Confirmed") echo "selected";?>>Order Confirmed</option>					
						<option value="Order Processed" <?PHP if($data["status"] == "Order Processed") echo "selected";?>>Order Processed</option>					
						<option value="Ready to Pickup" <?PHP if($data["status"] == "Ready to Pickup") echo "selected";?>>Ready to Pickup</option>				
					</select>
				</div>
			  
			<hr class="w3-clear">
			<input type="hidden" name="sta_filter" value="<?PHP echo $sta_filter;?>" >
			<input type="hidden" name="id_order" value="<?PHP echo $data["id_order"];?>" >
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
			
			<input type="hidden" name="sta_filter" value="<?PHP echo $sta_filter;?>" >
			<input type="hidden" name="id_order" value="<?PHP echo $data["id_order"];?>" >
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
