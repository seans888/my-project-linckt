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
	<title>Welcome!</title>
	</head>
	<body>
	
	<img src="../css/banner.png" alt="banner" style="width:1240px;">
		<div id='cssmenu'>
	<ul>
	<li class='active'><a href='home.php'>Home</a></li>
	<li><a href='acceptorders.php'>Accept Orders</a></li>
	<li><a href='lorders.php'>Linckt Orders to Supplier</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
	
	<?php
	
	$userfname =  $_SESSION['firstname'];
	$userlname =  $_SESSION['lastname'];
	echo "<h1>Welcome " . $userfname . " " . $userlname . "!</h1>";

	?>
	</body>
</html>