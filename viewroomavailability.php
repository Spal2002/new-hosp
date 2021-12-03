<html>
	<head>
		<title>Room Allocation</title>
		<link rel = "stylesheet" href = "css/viewroomavailability.css" />
	</head>
	<body>

	<?php
		$servername = "localhost";
		$username = "root";
		$password = "6530";			//Enter your MySQL password here
		$dbname = "hospitaldbms";	//Enter the name of the database, which in this case is 'hospitaldbms'

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
   			die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM rooms;";
		$result = $conn->query($sql);
		
		echo '<div id = "home1">
			<header>
				<img src = "img/logo.png" alt = "Logo" />
   				<h1>NMIT HOSPITALS</h1>
				<h2>A One-Stop Solution To Keep You Healthy</h2>
			</header>
		</div>';
		
		if ($result->num_rows > 0)
		{
		echo '<div class = "home2">';
    			echo "<table><tr><th>Room ID</th><th>Room Type</th><th>Number Of Beds</th><th>Number Of Beds Occupied Currently</th><th>Charges Per Night Per Bed</th></tr>";
   			// output data of each row
    			while($row = $result->fetch_assoc()) {
        			echo "<tr><td>" . $row["room_id"]. "</td><td>" . $row["room_type"] . "</td><td>" . $row["number_of_beds"]. "</td><td>" . $row["number_of_patients"]. "</td><td>" . $row["charges_per_night"]. "</td></tr>";
    			}
    			echo "</table>";
		}
		else
		{
   			 echo "0 results";
		}
		$conn->close();
		echo '</div>';
		echo '<div id = "home3">
			<footer>
				<ul>
					<li>Contact number: 080-23450917, 080-23450918, 080-23450919, 080-23334565</li>
					<li>&copy; NMIT Foundation for Medical Education and Research (NMITMER). All rights reserved.</li>
				</ul>
			<footer>
		</div>';
	?> 
	
	</body>
</html>
