<?php

require_once('config.php');

if(isset ($_POST)) {

	$sql = "INSERT INTO users (id,title, author, content) VALUES ('".$_POST['']."','".$_POST['title']."', '".$_POST['author']."', '".$_POST['content']."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} 
	else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

}

	header("Location:index.php");

?>