<?php
	$servername = "localhost";
	$username = "root";
	$password = "6530";			//Enter your MySQL password here
	$dbname = "hospitaldbms";	//Enter the name of the database, which in this case is 'hospitaldbms'
		
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Check connection
	if ($conn->connect_error)
		die("Connection failed: " . $conn->connect_error);
	
	$choice = $_POST["appchoice"];
	
	if($choice == 1)
	{
		header("Location: appointment.html");
	}
	else
	{
		header("Location: quickappointment.html");
	}
?>
