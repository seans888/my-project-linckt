<?php
										
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
	<li><a href='home.php'>Home</a></li>
	<li><a href='orders.php'>Create Orders</a></li>
	<li><a href='clients.php'>Client</a></li>
	<li><a href='lincktOrders.php'>Linckt Orders to Supplier</a></li>
	<li class='active'><a href='adminPriv.php'>Admin Priviledges</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
				<h1>Admin Priviledges</h1>
				
        </form>
	</body>
</html>
<?php
	if(isset($_POST["return"])){
	$return = $_POST["return"];
	
		if($return=="Home"){
			header("Location: ./home.php");
		}else if($return=="Logout"){
			header("Location: ../logout.php");
		}else if($return=="Client's Order"){
			header("Location: ./orders.php");
		}else if($return=="Clients"){
			header("Location: ./clients.php");
		}else if($return=="Linckt Order to Supplier"){
			header("Location: ./lincktOrders.php");
		}else if($return=="Admin Priviledges"){
			header("Location: ./adminPriv.php");
		}
	
	}

?>