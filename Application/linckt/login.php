<!doctype html>
<html>
	<head>

	<title>Linckt SCM Login</title>
	<link rel="stylesheet" type="text/css" href="./css/loginstyle.css"/>
			<style>
html, body {
   
	 background: #FFFFCC;
    
}
</style>
	</head>
	
	<body>
	
	<h1>Linckt Enterprise SCM System</h1>
	
	<div id="container">
	<form method="post">
	
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <div id="lower">
                <input type="checkbox"><label class="check" for="checkbox">Keep me logged in</label>
                <input type="submit" value="Login">
            </div>
        </form>
	 </div>
	 <?php
	 $message;
	 if(!empty($message))
	 echo "<h3>".$message."</h3>";
	 ?>
	</body>
</html>

<?php 
include("./includes/includeDB.php");

if (isset($_POST["username"]) && isset($_POST["password"])) {
	$username = /*preg_replace('#[^A-Za-z0-9]#i', '',*/ $_POST["username"];
	/*);*/
	$password = /*preg_replace('#[^A-Za-z0-9]#i', '',*/ $_POST["password"];
	/*);*/
	//$md5password_login = md5($password);
    $sql = "SELECT ufirstname, id, usertype, ulastname, username FROM users WHERE username='$username' AND upassword='$password' LIMIT 1";
	$select = mysql_query($sql, $con);

	$userCount = mysql_num_rows($select);
	if ($userCount == 1) {
		while($row = mysql_fetch_assoc($select)){ //fetch_assoc
			extract($row);
			 
	}	
		session_start();
		 $_SESSION['id'] = $id;
		 $_SESSION['username'] = $username;
		 $_SESSION['firstname'] = $ufirstname;
		 $_SESSION['lastname'] = $ulastname;
		 $_SESSION['id'] = $id;
		 $_SESSION['usertype'] = $usertype;

		 if($usertype=='admin'){
		  header('Location: ./admin/home.php');
		  }else
		  if($usertype=='lincktemp'){
		  header('Location: ./regular/home.php');
		  }else
		  if($usertype=='supplier'){
		  header('Location: ./supplier/home.php');
		  }
		  if($usertype=='client'){
		  header('Location: ./client/home.php');
		  }
         exit();
		} else {
		$message = 'That information is incorrect, try again';
		exit();
	}
}




?>