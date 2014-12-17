<?php
										//Linckt Employee
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
	
	<?php
	
	$sql1 = "SELECT purchase_order.id, users.ufirstname, users.ulastname, client_company.companyname FROM purchase_order, users, client_company where purchase_order.client_id=users.id AND users.company_id=client_company.id AND purchase_order.status='pending'";
	$select1 = mysql_query($sql1, $con);
	
	if($select1){
	echo "<table align=center><tr><td align=center><h2>Unconfirmed Orders</h2></td></tr>";
		while($row1 = mysql_fetch_assoc($select1)){
			extract($row1);
			
			echo "<tr><td><a href='porderdetails.php?id=" . $id . "'>Purchase Order Number 2014-00". $id . "-" . $companyname . "</a></td></tr> ";
		}
		echo "</table>";
	}
	
	

	?>
	</body>
</html>