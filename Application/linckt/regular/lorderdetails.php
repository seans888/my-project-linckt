<?php
										//Client
ob_start();
include("../includes/includeDB.php");
session_start();

if(isset($_SESSION['id'])){
		
}else header('Location: ../login.php');
		
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
	<li><a href='acceptorders.php'>Accept Orders</a></li>
	<li class='active'><a href='lorders.php'>Linckt Orders to Suppliers</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
	<form method=post>
	<h2 align=center>Order</h2>
	<?php
	extract($_GET);
	
	$sql = "SELECT purchase_orderline.purchase_order_id, purchase_orderline.po_orderproductqty, purchase_orderline.products_pcode, purchase_orderline.productunit, purchase_order.status FROM purchase_orderline, purchase_order where purchase_orderline.purchase_order_id='". $id ."' AND purchase_order.id='" . $id ."'";
	 
	$select = mysql_query($sql, $con);

	if ($select) {
		echo "<table border=1 align=center>";
		
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
		
			extract($row);
			echo "<tr><td colspan=3>Purchase Order Number 2014-00".$purchase_order_id."</td></tr><tr><td>" . $products_pcode . "</td><td>".$po_orderproductqty."pc/s.</td><td>$productunit</td></tr>";

		}
		echo "<tr><td colspan=3 align=center>Status: " . $status . "</td></tr></table>";
	}
	
	?>
	
	</form>
	</body>
</html>