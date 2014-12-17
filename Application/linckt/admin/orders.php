<?php
ob_start();
include("../includes/includeDB.php");
session_start();

if(isset($_SESSION['id'])){
		
}else header('Location: ../login.php');



if(!empty($_POST['return'])){

			try{
				$compname = @$_POST['compname'];
				$ponumber = @$_POST['ponumber'];
				$companyaddress = @$_POST['companyaddress'];
				$date = @$_POST['date'];
				$_SESSION['dateissued'] = $date;
				
				extract($_POST);		
				$options = array("location" => "http://localhost:80/linckt/linckt-server.php", 
				"uri" => "http://localhost:80");
	    
				$client = new SoapClient(null, $options);
						
					if ($client->addOrder($compname, $companyaddress))
					{
						$_SESSION['compname']  = $compname;
						$_SESSION['ponumber'] = $ponumber;
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
				
				<h1>Client Orders</h1>
				<a href='viewOrders.php' >View All Orders</a>
				<h2> Add Order </h2>
				<h3>Company Name: <input type="text" name="compname" required></h3>
				<h3>Purchase Order #: <input type="text" name="ponumber" required></h3>
				<h3>Delivery Address: <input type="text" name="companyaddress" required></h3>
				<h3>Date: <input type="date" name="date" value= "YYYY-MM-DD" required></h3>
				<input type="submit" value="Submit" name="return">
				
				
				
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