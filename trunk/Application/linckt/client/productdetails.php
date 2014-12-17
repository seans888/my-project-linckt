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
	<title>Products</title>
	</head>
	<body>
	
	<img src="../css/banner.png" alt="banner" style="width:1240px;">
		<div id='cssmenu'>
	<ul>
	<li><a href='home.php'>Home</a></li>
	<li class='active'><a href='products.php'>Linckt Products</a></li>
	<li><a href='porder.php'>Place an Order</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
	
	<h2>Linckt Products</h2>
	<?php
	extract($_GET);
	
	 $sql = "SELECT * FROM products where pcode='". $id ."'";	
		
	$select = mysql_query($sql, $con);

	if ($select) {
		echo "<table border=1>";
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
		
			extract($row);
			echo "<tr><td>" . $pcategory . "</td></tr>";
			echo "<td>Linckt-" . $pcode . " "  . $pname .  "</td> ";
			echo "<tr><td>" . $pdescription . "</td></tr>";
			
	}
	echo "</table>";
	}
	?>
	</body>
</html>