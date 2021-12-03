<html>
	<head>
		<title>NMIT Hospitals - Home</title>
		<link rel = "stylesheet" href = "css/receptionhomepage.css" />
		</head>
	<body>
		<?php
			echo '<div id = "home1">
				<header>
					<img src = "img/logo.png" alt = "Logo" />
   					<h1>NMIT HOSPITALS</h1>
					<h2>A One-Stop Solution To Keep You Healthy</h2>
				</header>
			</div>';
			echo '<div class = "home2">
				<br />
				<ul>
					<li><h2>Room Information:</h2><br /></li>
					<a href = "viewroomavailability.php">
						<button type = "button">View Room Availability</button><br /><br />
					</a>
					<li><h2>Appointments Information:</h2><br /></li>
					<a href = "viewappointments.php">
						<button type = "button">View All Appointments</button><br /><br />
					</a>
					<form action = "deleteappointment.php" method = "post">
						<h3>Cancel An Appointment</h3><br />
						<label for = "deleteappointment">Enter the Appointment ID of the appointment to be cancelled:</label>
   						<input type = "text" id = "deleteappointment" name = "deleteappointment" maxlength = "5" pattern = "[0-9]{1,5}" autocomplete = "off" onkeypress = "return onlyNumbers(event,this);" /><br />
   						<input type = "submit" name = "submit2" value = "Cancel Appointment" /><br />
   					</form>
   					<li><h2>Patient Information:</h2><br /></li>
					<a href = "addpatient.php">
						<button type = "button">Add A Patient</button><br /><br />
					</a>
					<a href = "viewpatients.php">
						<button type = "button">View All Existing Patient Details</button><br /><br />
					</a>
					<form action = "deletepatient.php" method = "post">
						<h3>Delete A Patient</h3>
						<label for = "deletepatient">Enter the Patient ID of the patient to be deleted:</label>
   						<input type = "text" id = "deletepatient" name = "deletepatient" maxlength = "5" pattern = "[0-9]{1,5}" autocomplete = "off" onkeypress = "return onlyNumbers(event,this);" /><br />
   						<input type = "submit" name = "submit3" value = "Delete Patient" /><br />
   					</form>
					<li><h2>Bill Information:</h2><br /></li>
					<a href = "generatebill.php">
						<button type = "button">Generate A Bill</button><br /><br />
					</a>
					<a href = "viewbills.php">
						<button type = "button">View Generated Bills</button><br /><br />
					</a>
					<br />
					<button id = "logout" type = "button" onclick = "window.close()">Logout</button><br /><br />
				</ul>
			</div>';
			echo '<div id = "home3">
				<footer>
					<ul>
						<li>Contact number: 080-23450917, 080-23450918, 080-23450919, 080-23334565</li>
						<li>&copy; NMIT Foundation for Medical Education and Research (NMITMER). All rights reserved.</li>
					</ul>
				</footer>
			</div>';
		?>
	</body>
</html>
