<?php
session_start();
include('../config.php');
include('../inc/header.inc.php');

$classes = array();

if(empty($_SESSION['loggedin'])){
	echo "You are not logged in! Please <a href='index.php'>Login!</a>";
	die();
}

$conn = mysqli_connect($sql_server, $sql_username, $sql_password, $sql_database);

if(!empty($_GET['id'])){
	$id = mysqli_real_escape_string($conn, $_GET['id']);
}
if(!empty($_POST['id'])){
	$id = mysqli_real_escape_string($conn, $_POST['id']);
}
if(!isset($id)){
	die("Please provide ID of the student!");
}

$query = "SELECT `classlist` FROM `classes` WHERE `uid`='$id'";
if($result = $conn->query($query)){
	$row = $result->fetch_assoc();
	$classes = explode(',', $row['classlist']);
}

if(!empty($_POST['classes'])){
	$string = "";
	// Submission received go save it!
	//
	$list = $_POST['classes'];
	foreach ($list as $item){
		$string .= $item.',';
	}
	$string = rtrim($string,',');

	if(!empty($row)){
		$updatequery = "UPDATE `classes` SET `classlist`='$string' WHERE `uid`='$id'";
	}
	else{
		$updatequery = "INSERT INTO `classes` (`uid`, `classlist`) VALUES ('$id', '$string')";
	}
	$conn->query($updatequery);
	header("Location: studentlist.php");
}

include('../inc/selectclassesform.inc.php');
include('../inc/footer.inc.php');


