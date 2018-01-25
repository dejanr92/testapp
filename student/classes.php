<?php
session_start();
include('../config.php');
include('../inc/header.inc.php');

if(empty($_SESSION['studentlogged'])||empty($_SESSION['studentid'])){
	echo "You are not logged in ! Please log in <a href='index.php'>here</a>";
}
else{
	$id = $_SESSION['studentid'];
	$conn = mysqli_connect($sql_server, $sql_username, $sql_password, $sql_database);
	$query = "SELECT `classlist` FROM `classes` WHERE `uid`='$id'";
	if($result = $conn->query($query)){
		$row = $result->fetch_assoc();
		$classes = explode(',', $row['classlist']);
	}
	if(!empty($row)){
		echo "<h2> List of classes: </h2>";
		echo "<div class='classes-list'><ul class='list-group'>";
		foreach ($classes as $item){
			echo "<li class='list-group-item'>$item</li>";
		}
		echo "</div></ul>";
	}
	else{
		echo "You don't have any classes!";
	}

}


include('../inc/footer.inc.php');
