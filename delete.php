<?php

 require_once('config.php');

 $id = $_GET['id'];
 
 $conn =mysqli_connect('localhost','root','','blog');

 $sql = "DELETE FROM users WHERE id =$id";
 	if(mysqli_query($conn,$sql)){
	
	 header("Location:index.php");
 
 	} 
 		
 		else {
		
		echo ('No Deleted');
	}

?>

