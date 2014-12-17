<?php
										//Client
ob_start();
include("../includes/includeDB.php");
session_start();

if(isset($_SESSION['id'])){
		
}else header('Location: ../login.php');
		
		$message="";

		if(@$_POST['return']=='Update Status'){
		
		extract($_POST);
		
		$sql1 = "Update purchase_order set status='$status' where id='$id'";
		$select1 = mysql_query($sql1, $con);
		
		
		$message="Status Updated";
		
		}
?>
<html>
	<head>
	<style>
body {
   
	 background: #FFFFCC;
    
}
</style>


<meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/styles1.css">
   <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   <script src="script1.js"></script>
	<title>Linckt Orders</title>
	</head>
	<body>
	
	<img src="../css/banner.png" alt="banner" style="width:1240px;">
		<div id='cssmenu'>
	<ul>
	<li><a href='home.php'>Home</a></li>
	<li class='active'><a href='slorders.php'>Linckt Orders</a></li>
	<li><a href='../logout.php'>Logout</a></li>	</ul>
	</div>
	<form method=post>
	
	<?php
	extract($_GET);
	
	$sql = "SELECT purchase_orderline.po_orderproductqty, purchase_orderline.products_pcode, purchase_orderline.productunit, purchase_order.status FROM purchase_orderline, purchase_order where purchase_orderline.purchase_order_id='". $id ."' AND purchase_order.id='" . $id ."'";
	 
	$select = mysql_query($sql, $con);

	if ($select) {
		echo "<h2 align=center>Order Details</h2><table border=1 align=center ><tr><td colspan=3 align=center>Purchase Order Number 2014-00".$id."</td></tr>";
		
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
		
			extract($row);
			echo "<tr><td>" . $products_pcode . "</td><td>$po_orderproductqty</td><td>$productunit</td></tr>";

		}
		echo "<tr><td colspan=3 align=center>Status: <select name='status'>".
		"<option value='$status'>$status</option>".
		"<option value='For Pick Up'>For Pick Up</option>".		
		"</select></td></tr>";
		echo "<tr><td colspan=3 align=center><input align=center type='submit' name='return' value='Update Status'/>".
		"<input type='hidden' name='id' value='$id'/></td></tr></table>";
	}	
		echo $id;
		echo $status;
		echo "<h3 align=center>$message</h3>"
	?>
	
	</form>
	</body>
</html>