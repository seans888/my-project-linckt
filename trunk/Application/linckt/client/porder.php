<?php
										//Client
ob_start();
include("../includes/includeDB.php");
session_start();

if(isset($_SESSION['id'])){
		
}else header('Location: ../login.php');

$message = "dipa";
$message2="dipa";

if(@$_POST['order']=='YES'){
	$message="go";
	
	$fdate = mktime(00,00,00,date("m"), date("d"), date("y"));
    $date = date('Y-m-d',$fdate);
	$client = $_SESSION['id'];
	 $sql2 = "Insert into purchase_order(podate, client_id, status) values ('$date', '$client', 'incomplete')";
	$select2 = mysql_query($sql2, $con);
	
	}

	if(@$_POST['order']=='Add Order'){
		
		extract($_POST);
		$message="go";
		$message2="viewna";
	
	}
	
	if(@$_POST['order']=='Cancel Order'){
		
		$message="dipa";
		$message2="dipa";
	
	}
	if(@$_POST['order']=='Place My Order'){
		
		$sql = "Select id from purchase_order";
		$select = mysql_query($sql, $con);
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
			extract($row);
		}
		
		$sql1 = "Update purchase_order set status='pending' where id='$id'";
		$select1 = mysql_query($sql1, $con);
		
		if($select1){
		
			$message="done";
			$message2="done";
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
	<title>Products</title>
	</head>
	<body>
	
	<img src="../css/banner.png" alt="banner" style="width:1240px;">
		<div id='cssmenu'>
	<ul>
	<li><a href='home.php'>Home</a></li>
	<li><a href='products.php'>Linckt Products</a></li>
	<li class='active'><a href='porder.php'>Place an Order</a></li>
	<li><a href='../logout.php'>Logout</a></li>
	</ul>
	</div>
	<?php
	if($message=="dipa"){
	echo "<form method='post'>" .
	"<div align='center' style='border:1px solid black; width:300px; height:200px; margin-left:500px; margin-top:100px;'>".
	"<br><br><h3>Create Purchase Order?</h3>".
	"<input type='submit' value='YES' name='order'/>" .
	"</form></div>";
	
	}

	if($message=="go"){
	echo "<form method='post'><br><br><table align=center>";
	 $sql = "SELECT pcode, pname FROM products";
	$select = mysql_query($sql, $con);

	if($select){
	echo "<tr><td colspan=2 height=50px>Product Name: <select name='product'><option>---</option>";
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
			extract($row);
			echo "<option  value='$pcode'>" . $pcode . " " . $pname . "</option>";
			 
		}
	echo "</select></td></tr>";
	}	
	 echo "<br>" .
	"<tr><td width=150px>Unit:" .
	"<select name='unit'>" .
	"<option>---</option>" .
	"<option value='cans'>Can</option>" .
	"<option value='pails'>Pail</option>" .
	"<option value='drums'>Drum</option>" .
	"</select>" .
	"</td><td>Qty: <input type=number name='qty'/></td></tr><tr><td colspan=2><br><br></td></tr>" .
	"<tr><td><input type=submit name='order' value='Add Order'/></td><td><input type=submit name='order' value='Cancel Order'/></td></tr>" .
	"</table></form>";
	
	if($message2=='viewna'){
	
	 $sql3 = "SELECT id FROM purchase_order";
	$select3 = mysql_query($sql3, $con);

	if($select3){
		while($row3 = mysql_fetch_assoc($select3)){
			extract($row3);
		}
	}
	$po_id=$id;
	 $sql4 = "SELECT productunitprice FROM productunit where productunit='$unit' AND pcode='$product'";
	$select4 = mysql_query($sql4, $con);

	if($select4){
		while($row4 = mysql_fetch_assoc($select4)){
			extract($row4);
		}
	}//$productunitprice
	
	$sql5 = "INSERT into purchase_orderline (po_orderproductqty, productunit, productunitcost, purchase_order_id, products_pcode) values ('$qty', '$unit', '$productunitprice', '$po_id', '$product')";
	$select5 = mysql_query($sql5, $con);

	if($select5){
	}else echo "shet";
	
	$userid = $_SESSION['id'];
	 $sql7 = "SELECT company_id FROM users where id='$userid'";
	 $select7 = mysql_query($sql7, $con);
	 
	if($select7){
		while($row7 = mysql_fetch_assoc($select7)){
			$companyid=$row['company_id'];
		}
		}
	 // $sql8 = "SELECT companyname from client_company where id='$companyid'";
	// $select8 = mysql_query($sql8, $con);

	// if($select8){
		// while($row8 = mysql_fetch_assoc($select8)){
			// extract($row8);
		// }
	// }
	
	 echo "<br><center><h2> Orders</h2></center><form method=post><table border=1 align=center> ";
	 echo "<tr><td colspan=5>Purchase Order Number: 2014-00" . $po_id . "</td></tr>";
	 echo "<tr><td>Product Name</td><td>Qty</td><td>Unit</td><td>Unit Cost</td><td>Amount</td></tr>";
	$sql6 = "SELECT * FROM purchase_orderline where purchase_order_id='$po_id'";
	$select6 = mysql_query($sql6, $con);
	$totalamount=0;
	if($select6){
		while($row6 = mysql_fetch_assoc($select6)){
			extract($row6);
			echo "<tr><td>" . $products_pcode . "</td><td>$po_orderproductqty</td><td>$productunit</td><td>$productunitcost</td><td>" . $amount = $po_orderproductqty*$productunitcost . "</td></tr>";
			$totalamount=$totalamount+$amount;
		}
		echo "<tr><td colspan=5>Total Amount: " . $totalamount . "</td></tr>".
		"<tr><td colspan=5 align=center><input type='submit' name='order' value='Place My Order'</td></tr></table></form>";
	
	
	}
	}
	}
	?>
	<?php
	if($message=='done' && $message2=='done'){
	
	echo "<h1>Order Successful!</h2>";
	
	}
	?>
	</body>
</html>
