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
	<li class='active'><a href='lorders.php'>Linckt Orders to Supplier</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
	<form method=post>
	<?php
	extract($_GET);
	
	 $sql = "SELECT purchase_order.id, users.ufirstname, users.ulastname, client_company.companyname FROM purchase_order, users, client_company where purchase_order.client_id=users.id AND users.company_id=client_company.id AND purchase_order.status<>'pending'";
	 
	$select = mysql_query($sql, $con);

	if ($select) {
		echo "<br><br><table align=center><tr><td><h2 align=center>Order Requests</h2></td></tr>";
		$totalamount=0;
		
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
		
			extract($row);
			echo "<tr><td><a href='lorderdetails.php?id=" . $id . "'>Purchase Order Number 2014-00". $id . "-" . $companyname . "</a></td></tr> ";
		}
		echo "</table>";
	}else{
	echo "<h1 align=center>No Confirmed Orders Yet</h1>";
	}
	
	?>
	
	</form>
	</body>
</html>