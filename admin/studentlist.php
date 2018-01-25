<?php
session_start();

include('../config.php');
include('../inc/header.inc.php');


if(empty($_SESSION['loggedin'])){
	echo "You are not logged in! Please <a href='index.php'>Login!</a>";
	die();
}
else{
	if($conn = mysqli_connect($sql_server, $sql_username, $sql_password, $sql_database)){
		$query = "SELECT * FROM `students`";
		$result = $conn->query($query);
		echo "<table class='table'>";
		echo "<thead><tr><th>ID</th><th>Name</th><th>Edit Classes:</th></tr></thead>";
		while ($row = $result->fetch_assoc()){
			echo "<tr><th>".$row['id']."</th><th>".$row['username']."</th><th><a href='studentcourses.php?id=".$row['id']."'>Edit</a></th></tr>";
		}
		echo "</table>";
		echo "</br>";
		echo "You can add a new student <a href='addstudent.php'>here</a>";
	}



}
include('../inc/footer.inc.php');
