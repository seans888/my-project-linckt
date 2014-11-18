<!doctype html>

<?php
ob_start();
include("./includes/includeDB.php");
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
	     
                <input type="submit" value="Logout" name="return">
				<input type="submit" value="Client's Order" name="return">
				<input type="submit" value="Clients" name="return">
				<input type="submit" value="Linckt Order to Supplier" name="return">
				
        </form>
		
	</body>
</html>
<?php
if(isset($_POST["return"])){
	$return = $_POST["return"];
	
	if($return=="Logout"){
		header("Location: ../logout.php");
	}
	
	}

?>