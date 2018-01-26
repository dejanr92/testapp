<?php
session_start();
include('../config.php');
include('../inc/header.inc.php');

if(!empty($_SESSION['studentlogged'])){
	echo "Hello ".$_SESSION['studentlogged']."!</br>";
	echo "Proceed to <a href='classes.php'>list of classes</a> or <a href='index.php?logout=1'>Logout</a>";
	if(isset($_GET['logout'])){
		unset($_SESSION['studentlogged']);
		unset($_SESSION['studentid']);
		header("Location: index.php");
	}

}
else{
	if(isset($_POST['username']) && isset($_POST['password'])){
		$conn = mysqli_connect($sql_server, $sql_username, $sql_password, $sql_database);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$query = "SELECT `password`,`id` FROM `students` WHERE `username`='$username'";

		if($result = $conn->query($query)){
			$row= $result->fetch_assoc();
			if(password_verify($_POST['password'], $row['password'])){
				$_SESSION['studentlogged']=$username;
				$_SESSION['studentid']=$row['id'];
				header("Location: index.php");
			}
			else{
				echo "Invalid password! Go <a href='index.php'>back</a> and try again";
			}
		}

	}
	else{
		$title = "Student Login!";
		require('../inc/loginform.inc.php');
	}
}
include('../inc/footer.inc.php');
