<?php
										
ob_start();
include("../includes/includeDB.php");
session_start();

if(isset($_SESSION['id'])){
		
}else header('Location: ../login.php');
		
?>
<html>
	<head>
	<title>Welcome!</title>
	</head>
	<body>
		<form method="post">
		
				<input type="submit" value="Home" name="return">
				<input type="submit" value="Client's Order" name="return">
				<input type="submit" value="Clients" name="return">
				<input type="submit" value="Linckt Order to Supplier" name="return">
				<input type="submit" value="Admin Priviledges" name="return">
				<input type="submit" value="Logout" name="return">
				<h1>Linckt Orders</h1>
				
			 //select something something
			 
			 insert codes to view oders of linckt to their supplier
				
				
				
				
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