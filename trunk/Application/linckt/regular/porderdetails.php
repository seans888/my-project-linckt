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
	<title>Orders</title>
	</head>
	<body>
	
	<img src="../css/banner.png" alt="banner" style="width:1240px;">
		<div id='cssmenu'>
	<ul>
	<li><a href='home.php'>Home</a></li>
	<li class='active'><a href='acceptorders.php'>Accept Orders</a></li>
	<li><a href='lorders.php'>Linckt Orders to Supplier</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
	<form method=post>
	<?php
	extract($_GET);
	
	 $sql = "SELECT * FROM purchase_orderline where purchase_order_id='". $id ."'";	
	 
	$select = mysql_query($sql, $con);

	if ($select) {
		echo "<br><br><br><br><table border=1 align=center><tr><td colspan=5 align=center><h2>Order Details</h2></td></tr>";
		$totalamount=0;
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
		
			extract($row);
			echo "<tr><td>" . $products_pcode . "</td><td>$po_orderproductqty</td><td>$productunit</td><td>$productunitcost</td><td>" . $amount = $po_orderproductqty*$productunitcost . "</td></tr>";
			$totalamount=$totalamount+$amount;
		}
		echo "<tr><td colspan=5>Total Amount: " . $totalamount . "</td></tr>";
		echo "<tr><td colspan=5 align=center><input type=hidden name='key' value='$id'><input type=submit name='return' value='Confirm'/></td></tr></table>";
	}
	
	?>
	
	</form>
	</body>
</html>
<?php
if(!empty($_POST['return'])){
extract($_POST);
	
	$empid = $_SESSION['id'];
	
	 $sql = "Update purchase_order set lincktemp_id='$empid', status='On Process' where id='$id'";	
	 
	$select = mysql_query($sql, $con);
	
	if($select)
	echo "<h3 align=center>Order confirmed, product request to supplier sent!</h3>";
}
?>