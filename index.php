<?php
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "HW4";


			

	// Create connection
	$conn = mysqli_connect($servername, $username, $password);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	//echo "Connected successfully";


	// Create database
	$sql = "CREATE DATABASE IF NOT EXISTS HW4";
	if ($conn->query($sql) === TRUE) {
	    //echo "Database created successfully";
	} else {
	    echo "Error creating database: " . $conn->error;
	}
	$sql = "USE HW4";
	$conn->query($sql);


	// sql to create table
	$sql1 = "CREATE TABLE IF NOT EXISTS Book_Author (
	Book_id VARCHAR(20),
	Author_id VARCHAR(20)
	)";

	// sql to create table
	$sql2 = "CREATE TABLE IF NOT EXISTS Author (
	Author_id VARCHAR(20),
	Author_Name VARCHAR(20)
	)";


	// sql to create table
	$sql = "CREATE TABLE IF NOT EXISTS Book (
	Book_id VARCHAR(20),
	title VARCHAR(20),
	year VARCHAR(4),
	price VARCHAR(10),
	category VARCHAR(10)
	)";

	$conn->query($sql);
	$conn->query($sql1);
	$conn->query($sql2);

	$uri = $_SERVER['REQUEST_URI'];
	$id = explode("/", $uri);

	if (count($id) == 3) {
		$sql = "SELECT b.title, b.year, b.price, b.category, a.Author_Name FROM Book b inner join Book_Author ba on b.Book_id = ba.Book_id inner join Author a on a.Author_id = ba.Author_id where b.Book_id = {$id[2]}";
		$result1 = $conn->query ($sql);
		$result2 = $conn->query ($sql);
		$authors = array();
		while ( $row = $result1->fetch_assoc())  {
			$authors[]=$row["Author_Name"];
		}
		$res = $result2->fetch_assoc();
		unset($res["Author_Name"]);
		$res["authors"] = $authors;
		echo json_encode($res);

	} else {
		$sql	= 'SELECT * FROM Book';
		$result = $conn->query ($sql);
		$dbdata = array();
		//Fetch into associative array
		while ( $row = $result->fetch_assoc())  {
			$dbdata[]=$row;
		}

		//Print array in JSON format
		echo json_encode($dbdata);					  		
	}

	
	



$conn->close();
?>