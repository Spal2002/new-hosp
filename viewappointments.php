<html>
	<head>
		<title>Appointments</title>
		<link rel = "stylesheet" href = "css/viewappointments.css" />
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

		$sql = "SELECT * FROM appointments;";
		$result = $conn->query($sql);
		
		echo '<div id = "home1">
			<header>
				<img src = "img/logo.png" alt = "Logo" />
   				<h1>NMIT HOSPITALS</h1>
				<h2>A One-Stop Solution To Keep You Healthy</h2>
			</header>
		</div>';
		echo '<div class = "home2">';
		if ($result->num_rows > 0) {
    			echo '<table>
    				<tr>
    					<th>Appointment ID</th><th>First Name</th><th>Last Name</th><th>Address</th><th>City</th><th>State</th><th>PIN</th><th>Contact Number</th><th>E-mail ID</th><th>Gender</th><th>Date of Birth</th><th>Insurance</th><th>Insurance Number</th><th>Patient Type</th><th>Medical Concerns</th>
    				</tr>';
   			// output data of each row
    			while($row = $result->fetch_assoc()) {
        			echo '<tr>
        				<td>' . $row["appointment_id"]. '</td><td>' . $row["first_name"] . '</td><td>' . $row["last_name"]. '</td><td>' . $row["address"]. '</td><td>' . $row["city"]. '</td><td>' . $row["state"]. '</td><td>' . $row["pin"]. '</td><td>' . $row["primary_phone"]. '</td><td>' . $row["email"]. '</td><td>' . $row["gender"]. '</td><td>' . $row["dob"]. '</td><td>' . $row["insurance"]. '</td><td>' . $row["insurance_number"]. '</td><td>' . $row["patient_type"]. '</td><td>' . $row["medical_concerns"]. '</td>
        			</tr>';
    			}
    			echo '</table>';
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
