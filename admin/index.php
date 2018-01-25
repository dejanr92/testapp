<?php
session_start();
//echo 'hello there';
include('../config.php');
//
include('../inc/header.inc.php');
if(!empty($_SESSION['loggedin'])){
	echo "<div class='container customtext'>";
	echo "Hello ".$_SESSION['loggedin']."!</br>";
	echo "Proceed to <a href='studentlist.php'>list of students</a> or <a href='index.php?logout=1'>Logout</a>";
	echo "</div>";
	if(isset($_GET['logout'])){
		unset($_SESSION['loggedin']);
		header("Location: index.php");
	}

}
else{
	if(isset($_POST['username']) && isset($_POST['password'])){
		$conn = mysqli_connect($sql_server, $sql_username, $sql_password, $sql_database);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$query = "SELECT `password` FROM `admins` WHERE `username`='$username'";

		if($result = $conn->query($query)){
			$row= $result->fetch_assoc();
			if(password_verify($_POST['password'], $row['password'])){
				$_SESSION['loggedin']=$username;
				header("Location: index.php");
			}
		}

	}
	else{
		$title = "Admin Login!";
		require('../inc/loginform.inc.php');
	}
}
include('../inc/footer.inc.php');
