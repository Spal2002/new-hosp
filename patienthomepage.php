<html>
	<head>
		<title>Your Home Page</title>
		<link rel = "stylesheet" href = "css/patienthomepage.css" />
	</head>
	<body>
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
		
			session_start();
			
			//echo 1;
			$patient = $_SESSION['patientid'];
			//echo $patient;
			echo '<div id = "patient1">
					<header>
						<img src = "img/logo.png" alt = "Logo" />
   						<h1>NMIT HOSPITALS</h1>
						<h2>A One-Stop Solution To Keep You Healthy</h2>
					</header>
				</div>';
			echo '<div class = "patient2">';
			
			$query1 = "select p.patient_id, p.appointment_id, a.first_name, a.last_name, a.address, a.city, a.state, a.pin, a.primary_phone, a.email, a.gender, a.insurance, a.insurance_number, a.patient_type, a.date_of_admission, p.doctor_assigned, p.room_id, p.drugs_prescribed from appointments a, patients p where a.appointment_id = p.appointment_id and p.patient_id = ".$patient.";";
			$result1 = $conn->query($query1);
			
				$row1 = $result1->fetch_assoc();
				$appointmentid = $row1["appointment_id"];
				$firstname = $row1["first_name"];
				$lastname = $row1["last_name"];
				$address = $row1["address"];
				$city = $row1["city"];
				$state = $row1["state"];
				$pin = $row1["pin"];
				$contact = $row1["primary_phone"];
				$email = $row1["email"];
				$gender = $row1["gender"];
				$insurance = $row1["insurance"];
				$insurancenum = $row1["insurance_number"];
				$patienttype = $row1["patient_type"];
				$admitdate = $row1["date_of_admission"];
				$doctorid = $row1["doctor_assigned"];
				$roomid = $row1["room_id"];
				$drugs = $row1["drugs_prescribed"];
				
				echo '<h2>Patient Details:</h2>
					<label for = "patient">Patient ID:</label>
					<input type = "text" id = "patient" value = "'.$patient.'" readonly />
					<br />
					<label for = "appointmentid">Appointment ID:</label>
					<input type = "text" id = "appointmentid" value = "'.$appointmentid.'" readonly />
					<br />
					<label for = "fname">First Name:</label>
					<input type = "text" id = "fname" value = "'.$firstname.'" readonly />
					<br />
					<label for = "lname">Last Name:</label>
					<input type = "text" id = "lname" value = "'.$lastname.'" readonly />
					<br />
					<label for = "address">Address:</label>
					<input type = "text" id = "address" value = "'.$address.'" readonly />
					<br />
					<label for = "city">City:</label>
					<input type = "text" id = "city" value = "'.$city.'" readonly />
					<br />
					<label for = "state">State:</label>
					<input type = "text" id = "state" value = "'.$state.'" readonly />
					<br />
					<label for = "pin">PIN:</label>
					<input type = "text" id = "pin" value = "'.$pin.'" readonly />
					<br />
					<label for = "contact">Contact Number:</label>
					<input type = "text" id = "contact" value = "'.$contact.'" readonly />
					<br />
					<label for = "email">E-mail ID:</label>
					<input type = "text" id = "email" value = "'.$email.'" readonly />
					<br />
					<label for = "gender">Gender:</label>
					<input type = "text" id = "gender" value = "'.$gender.'" readonly />
					<br />
					<label for = "insurance">Insurance:</label>
					<input type = "text" id = "insurance" value = "'.$insurance.'" readonly />
					<br />
					<label for = "insurancenum">Insurance Number:</label>
					<input type = "text" id = "insurancenum" value = "'.$insurancenum.'" readonly />
					<br />
					<label for = "patienttype">Patient Type:</label>
					<input type = "text" id = "patienttype" value = "'.$patienttype.'" readonly />
					<br />
					<label for = "admitdate">Date of Admission:</label>
					<input type = "text" id = "admitdate" value = "'.$admitdate.'" readonly />
					<br />
					<label for = "doctorid">Doctor Assigned:</label>
					<input type = "text" id = "doctorid" value = "'.$doctorid.'" readonly />
					<br />
					<label for = "roomid">Room ID:</label>
					<input type = "text" id = "roomid" value = "'.$roomid.'" readonly />
					<br />
					<label for = "drugs">Drugs Prescribed:</label>
					<input type = "text" id = "drugs" value = "'.$drugs.'" readonly />
					<br />';
			
			       			
       			$query2 = "select b.bill_id, b.number_of_days_admitted, b.room_charges, b.consultational_charges, b.surgery_charges, b.miscellaneous_charges, b.insurance_amount, b.total_amount from bills b, patients p where p.patient_id = b.patient_id and p.patient_id = ".$patient.";";
			$result2 = $conn->query($query2);
			echo "<h2>Bill Details:</h2>
				<br />";
			if($result2->num_rows > 0)
			{
				echo '<table>
    					<tr>
    						<th>Bill ID</th><th>Number of Days Admitted</th><th>Room Charges</th><th>Consultational Charges</th><th>Surgery Charges</th><th>Miscellaneous Charges</th><th>Insurance Amount</th><th>Total Amount</th>
    					</tr>';
    					while($row2 = $result2->fetch_assoc()) {
        								echo '<tr>
        									<td>' . $row2["bill_id"]. '</td><td>' . $row2["number_of_days_admitted"]. '</td><td>' . $row2["room_charges"]. '</td><td>' . $row2["consultational_charges"]. '</td><td>' . $row2["surgery_charges"]. '</td><td>' . $row2["miscellaneous_charges"]. '</td><td>' . $row2["insurance_amount"]. '</td><td>' . $row2["total_amount"]. '</td>
        									</tr>';
    					}
    					echo '</table>';
    			}
    			else
    			{
    				echo "0 results";
    			}
    			echo '<br /><br />
    				<a href = "patientlogout.php">
					<button id = "logout" type = "button">Logout</button><br /><br />
				</a>';
			echo '</div>';
			
			echo '<div id = "patient3">
				<footer>
					<ul>
						<li>Contact number: 080-23450917, 080-23450918, 080-23450919, 080-23334565</li>
						<li>&copy; NMIT Foundation for Medical Education and Research (NMITMER). All rights reserved.</li>
					</ul>
				<footer>
			</div>';
			$conn->close();
    		?>
    	</body>
<html>
