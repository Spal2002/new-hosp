<html>
	<head>
		<title>NMIT Hospitals - Home</title>
		<link rel = "stylesheet" href = "css/adminhome.css" />
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
					<li><h2>Department Information:</h2><br /></li>
					<a href = "viewdepartments.php">
						<button type = "button">View Department Information</button><br /><br />
					</a>
					<li><h2>Employee Information:</h2><br /></li>
					<a href = "addemployee.php">
						<button type = "button">Add An Employee</button><br /><br />
					</a>
					<a href = "viewemployees.php">
						<button type = "button">View All Employee Details</button><br /><br />
					</a>
   					<li><h2>Appointments Information:</h2><br /></li>
					<a href = "viewappointments.php">
						<button type = "button">View All Appointments</button><br /><br />
					</a>
					<li><h2>Patient Information:</h2><br /></li>
					<a href = "viewpatients.php">
						<button type = "button">View All Patient Details</button><br /><br />
					</a>
   				</ul>
				<button id = "logout" type = "button" onclick = "window.close()">Logout</button><br /><br />
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
