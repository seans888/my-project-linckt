<!doctype html>
<html>
	<head>
	<title>Licknt SCM Login</title>
	<link rel="stylesheet" type="text/css" href="./css/loginstyle.css"/>
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
    $sql = "SELECT u_firstname, u_employeenum, id, u_usertype FROM users WHERE u_username='$username' AND u_password='$password' LIMIT 1";
	$select = mysql_query($sql, $con);

	$userCount = mysql_num_rows($select);
	if ($userCount == 1) {
		while($row = mysql_fetch_array($select)){ 
             $id = $row["id"];
			 $firstname = $row["u_firstname"];
			 $empnun = $row["u_employeenum"];
			 $usertype = $row["u_usertype"];
	}	
		session_start();
		 $_SESSION['id'] = $id;
		 $_SESSION['username'] = $username;
		 $_SESSION['firstname'] = $firstname;
		 $_SESSION['empnum'] = $empnum;
		 $_SESSION['usertype'] = $usertype;

		 if($usertype='admin'){
		  header('Location: ./admin/home.php');
		  }else
		  if($usertype='regular'){
		  header('Location: ./linckt/home.php');
		  }else
		  if($usertype='supplier'){
		  header('Location: ./supplier/home.php');
		  }
         exit();
		} else {
		echo 'That information is incorrect, try again';
		exit();
	}
}




?>