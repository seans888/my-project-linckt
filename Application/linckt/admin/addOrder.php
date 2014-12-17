<?php
										
ob_start();
include("../includes/includeDB.php");
session_start();

if(isset($_SESSION['id'])){
		
}else header('Location: ../login.php');

if(!empty($_POST['return'])){

			try{
				$prodname = @$_POST['prodname'];
				$proddesc = @$_POST['proddesc'];
				$prodcode = @$_POST['prodcode'];
				$prodqty = @$_POST['prodqty'];
				$produnit = @$_POST['produnit'];
				$produnitprice = @$_POST['produnitprice'];
				$prodamnt = @$_POST['prodamnt'];
				$ponumber = $_SESSION['ponumber'];
				$compname = $_SESSION['compname'];
				$dateissued = $_SESSION['dateissued'];
				$empnumber = $_SESSION['empnumber'];
				
				echo $prodname . "<br>";
				echo $proddesc . "<br>";
				echo $prodcode . "<br>";	
				echo $prodqty . "<br>";
				echo $produnit . "<br>";					
				echo $produnitprice . "<br>";
				echo $prodamnt . "<br>";
				echo $ponumber . "<br>";
				echo $compname . "<br>";
				echo $dateissued . "<br>";
				echo $empnumber . "<br>";
				
				extract($_POST);		
				$options = array("location" => "http://localhost:80/linckt/linckt-server.php", 
				"uri" => "http://localhost:80");
	    
				$client = new SoapClient(null, $options);
						
					if ($client->addOrderDetails($prodname, $prodcode, $proddesc, $prodqty, $produnit, $produnitprice, $prodamnt, $empnumber, $ponumber, $compname, $dateissued))
					{
						header("Location: ./addOrder.php");
					}else{
					echo "cant pakshet";
					}
				}catch (SoapFault $e) 
					{
						$message = $e->getMessage();
					}
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
	<title>Welcome!</title>
	</head>
	<body>
	
	<img src="../css/banner.png" alt="banner" style="width:1240px;">
		<div id='cssmenu'>
	<ul>
	<li><a href='home.php'>Home</a></li>
	<li class='active'><a href='orders.php'>Create Orders</a></li>
	<li><a href='clients.php'>Client</a></li>
	<li><a href='lincktOrders.php'>Linckt Orders to Supplier</a></li>
	<li><a href='adminPriv.php'>Admin Priviledges</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
		<form method="post">
		
		<?php
				$compname = $_SESSION['compname']; 
				echo "<h1> $compname </h1>";
				?>
				
				<h3>Product Name: <input type="text" name="prodname" required></h3>
				<h3>Product Code: <input type="text" name="prodcode" required></h3>
				<h3>Product Description: <input type="text" name="proddesc" required></h3>
				<h3>Qty: <input type="text" name="prodqty" required></h3>
				<h3>Unit: <input type="text" name="produnit" required></h3>
				<h3>Unit Price: <input type="text" name="produnitprice" required></h3>
				<h3>Amount: <input type="text" name="prodamnt" required></h3>
				
				
				<input type="submit" value="Add" name="return">
				<input type="submit" value="Submit" name="return">
				<input type="submit" value="Cancel Orders" name="return">
				
		<?php
	
				$sql = "SELECT u_firstname, u_employeenum, id, u_usertype, u_middleinitial, u_lastname FROM users WHERE u_username='$username' AND u_password='$password' LIMIT 1";
				$select = mysql_query($sql, $con);

				$userCount = mysql_num_rows($select);
			
				if ($userCount == 1) {
					while($row = mysql_fetch_array($select)){ 
						$id = $row["id"];
						$firstname = $row["u_firstname"];
						$middleinitial = $row["u_middleinitial"];
						$lastname = $row["u_lastname"];
						$empnumber = $row["u_employeenum"];
						$usertype = $row["u_usertype"];
					}	
					if($usertype=='admin'){
						header('Location: ./admin/home.php');
					}else
						if($usertype=='regular'){
						
							header('Location: ./regular/home.php');
						}else
							if($usertype=='supplier'){
								header('Location: ./supplier/home.php');
							}
					exit();
				} else {
					exit();
					}

		
		
		?>
				
				
				
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