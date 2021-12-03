<html>
	<head>
		<title>Patient Details</title>
		<link rel = "stylesheet" href = "css/viewpatients.css" />
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

		$sql1 = "select p.patient_id, p.appointment_id, p.room_id, p.doctor_assigned, a.first_name, a.last_name, a.address, a.city, a.state, a.pin, a.primary_phone, a.email, a.gender, a.dob, a.insurance, a.insurance_number, a.patient_type, a.date_of_admission from appointments a, patients p where a.appointment_id = p.appointment_id order by p.patient_id;";
		$result1 = $conn->query($sql1);
		if(!$result1)
		{
			echo "ERROR";
               		printf("\nErrormessage: %s\n", mysqli_error($conn));
      	 	}
      	 		
		echo '<div id = "home1">
			<header>
				<img src = "img/logo.png" alt = "Logo" />
   				<h1>NMIT HOSPITALS</h1>
				<h2>A One-Stop Solution To Keep You Healthy</h2>
			</header>
		</div>';
		echo '<div class = "home2">';
		if ($result1->num_rows > 0) {
    			echo '<table>
    				<tr>
    					<th>Patient ID</th><th>Appointment ID</th><th>Room ID</th><th>Doctor Assigned</th><th>First Name</th><th>Last Name</th><th>Address</th><th>City</th><th>State</th><th>PIN</th><th>Contact Number</th><th>E-mail ID</th><th>Gender</th><th>Date of Birth</th><th>Insurance</th><th>Insurance Number</th><th>Patient Type</th><th>Date of Admission</th>
    				</tr>';
   			// output data of each row
    			while($row = $result1->fetch_assoc()) {
        			echo '<tr>
        				<td>' . $row["patient_id"]. '</td><td>' . $row["appointment_id"]. '</td><td>' . $row["room_id"]. '</td><td>' . $row["doctor_assigned"]. '</td><td>' . $row["first_name"]. '</td><td>' . $row["last_name"]. '</td><td>' . $row["address"]. '</td><td>' . $row["city"]. '</td><td>' . $row["state"]. '</td><td>' . $row["pin"]. '</td><td>' . $row["primary_phone"]. '</td><td>' . $row["email"]. '</td><td>' . $row["gender"]. '</td><td>' . $row["dob"]. '</td><td>' . $row["insurance"]. '</td><td>' . $row["insurance_number"]. '</td><td>' . $row["patient_type"]. '</td><td>' . $row["date_of_admission"]. '</td>
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
