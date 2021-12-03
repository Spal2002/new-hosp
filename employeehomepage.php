<html>
	<head>
		<title>Your Home Page</title>
		<link rel = "stylesheet" href = "css/employeehomepage.css" />
		<script language="Javascript" type="text/javascript">
			function onlyAlphanumeric(e, t) {
           		 	try {
               				if (document.event) {
               				     var charCode = document.event.keyCode;
               				 }
               			 	else if (e) {
                   					 var charCode = e.which;
                				}
               				 	else { return true; }
                			if((charCode > 47 && charCode < 58) || (charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode == 44) || (charCode == 46) || (charCode == 32))
                   				 return true;
                			else
                   				 return false;
            				}
            			catch (err) {
                		alert(err.Description);
            			}
        		}
        	</script>
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
	
			$employeeid = $_SESSION['empid'];
	
			echo '<div id = "employee1">
					<header>
						<img src = "img/logo.png" alt = "Logo" />
   						<h1>NMIT HOSPITALS</h1>
						<h2>A One-Stop Solution To Keep You Healthy</h2>
					</header>
				</div>';
			echo '<div class = "employee2">';
	
			$query1 = "select * from employee where employee_id = ".$employeeid.";";
			$result1 = $conn->query($query1);
			if($result1->num_rows == 0)
			{
				 echo "0 results";
			}
			else
			{
				$row1 = $result1->fetch_assoc();
				$departmentid = $row1["department_id"];
				$firstname = $row1["first_name"];
				$lastname = $row1["last_name"];
				$dob = $row1["dob"];
				$email = $row1["email"];
				$gender = $row1["gender"];
				$contact = $row1["contact_number"];
				$qualifications = $row1["qualifications"];
				$num_of_patients = $row1["number_of_patients"];
		
				echo '	<h2>Employee Details:</h2>
					<label for = "employeeid">Employee ID:</label>
					<input type = "text" id = "employeeid" value = "'.$employeeid.'" readonly />
					<br />
					<label for = "departmentid">Department ID:</label>
					<input type = "text" id = "departmentid" value = "'.$departmentid.'" readonly />
					<br />
					<label for = "firstname">First Name:</label>
					<input type = "text" id = "firstname" value = "'.$firstname.'" readonly />
					<br />
					<label for = "lastname">Last Name:</label>
					<input type = "text" id = "lastname" value = "'.$lastname.'" readonly />
					<br />
					<label for = "dob">Date of Birth (YYYY/MM/DD):</label>
					<input type = "text" id = "dob" value = "'.$dob.'" readonly />
					<br />
					<label for = "email">E-mail ID:</label>
					<input type = "text" id = "email" value = "'.$email.'" readonly />
					<br />
					<label for = "gender">Gender:</label>
					<input type = "text" id = "gender" value = "'.$gender.'" readonly />
					<br />
					<label for = "contact">Contact Number:</label>
					<input type = "text" id = "contact" value = "'.$contact.'" readonly />
					<br />
					<label for = "qualifications">Qualifications:</label>
					<input type = "text" id = "qualifications" value = "'.$qualifications.'" readonly />
					<br />';
					if($departmentid != 12 || $departmentid != 17 || $departmentid != 7)
					{
						echo '<label for = "num_of_patients">Number of Patients being handled currently:</label>
							<input type = "text" id = "num_of_patients" value = "'.$num_of_patients.'" readonly />
							<br />
							<br />
							<h2>Patient Details:</h2>';
					
							$query2 = "select p.patient_id, a.first_name, a.last_name, a.dob, a.patient_type, p.room_id, a.date_of_admission, a.gender, a.primary_phone, p.drugs_prescribed from appointments a, patients p where a.appointment_id = p.appointment_id and p.doctor_assigned = ".$employeeid." order by p.patient_id;";
							$result2 = $conn->query($query2);
							if($result2->num_rows == 0)
							{
		 						echo "0 results";
							}
							else
							{
								echo '<table>
    									<tr>
    										<th>Patient ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>Patient Type</th><th>Room ID</th><th>Date of Admission</th><th>Gender</th><th>Mobile Number</th><th>Drugs Prescribed</th>
									</tr>';
   								// output data of each row
    								while($row2 = $result2->fetch_assoc()) {
        								echo '<tr>
        									<td>' . $row2["patient_id"]. '</td><td>' . $row2["first_name"]. '</td><td>' . $row2["last_name"]. '</td><td>' . $row2["dob"]. '</td><td>' . $row2["patient_type"]. '</td><td>' . $row2["room_id"]. '</td><td>' . $row2["date_of_admission"]. '</td><td>' . $row2["gender"]. '</td><td>' . $row2["primary_phone"]. '</td><td>' . $row2["drugs_prescribed"]. '</td>
        								</tr>';
    								}
    								echo '</table>';
    							}
    						echo '<h2>Prescribe Drugs to a Patient:</h2>
    							<form action = "prescribedrugs.php" method = "post">
    								<label for = "drugs">Enter the Patient ID:</label>
    								<input type = "text" id = "drugs" name = "drugs" maxlength = "5" pattern = "[0-9]{1,5}" onkeypress = "return onlyNumbers(event,this);" autocomplete = "off" required />
    								<br />
    								<label for = "drugs1">Enter the drugs to be prescribed:</label>
    								<input type = "text" id = "drugs1" name = "drugs1" maxlength = "150" onkeypress = "return onlyAlpahnumeric(event,this);" autocomplete = "off" required />
    								<br />
    								<input type = "submit" name = "submit" value = "Prescribe Drugs" />
    								<br />
    								
    							</form>';
    						echo '<h2>Consultations For Today:</h2>';
    						
    						$query3 = "select app_id, first_name, last_name, mobile_number from quickappointments where app_date = curdate() and doctor_id = ".$employeeid.";";
    						$result3 = $conn->query($query3);
    						if($result3->num_rows == 0)
    							echo "No appointments for today.";
    						else
    						{
    							echo '<table>
    									<tr>
    										<th>Application ID</th><th>Firt Name</th><th>Last Name</th><th>Mobile Number</th>
    									</tr>';
   								// output data of each row
    								while($row3 = $result3->fetch_assoc()) {
        								echo '<tr>
        									<td>' . $row3["app_id"]. '</td><td>' . $row3["first_name"]. '</td><td>' . $row3["last_name"]. '</td><td>' . $row3["mobile_number"]. '</td>
        								</tr>';
    								}
    							echo '</table>';
    						}
    						echo '<br /><br />';
    					}
			}
			echo '<a href = "employeelogout.php">
					<button id = "logout" type = "button">Logout</button><br /><br />
				</a>';
			echo '</div>';
			
			echo '<div id = "employee3">
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
</html>
