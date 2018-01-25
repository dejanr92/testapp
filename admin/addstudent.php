<?php
session_start();

include('../config.php');
include('../inc/header.inc.php');


if(empty($_SESSION['loggedin'])){
	echo "You are not logged in! Please <a href='index.php'>Login!</a>";
	die();
}
else{
	if(isset($_POST['username']) && isset($_POST['password'])){
		$conn = mysqli_connect($sql_server, $sql_username, $sql_password, $sql_database);
		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$query = "INSERT INTO `students` (`username`, `password`) VALUES ('$username', '$password')";
		$conn->query($query);
		echo "Student has been successfully added. Go back to the list <a href='studentlist.php'>here</a>";

	}
	else{

		include('../inc/addstudentform.inc.php');
	}
}
