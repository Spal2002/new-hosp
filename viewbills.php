<html>
	<head>
		<title>View Generated Bills</title>
		<link rel = "stylesheet" href = "css/viewbills.css" />
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
		
		$query1 = "select * from bills;";
		$result1 = $conn->query($query1);
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
    					<th>Bill ID</th><th>Patient ID</th><th>Number of Days Admitted</th><th>Room Charges</th><th>Consultation Charges</th><th>Surgery Charges</th><th>Miscellaneous Charges</th><th>Insurance Amount</th><th>Total Amount</th>
    				</tr>';
   			// output data of each row
    			while($row = $result1->fetch_assoc()) {
        			echo '<tr>
        				<td>' . $row["bill_id"]. '</td><td>' . $row["patient_id"]. '</td><td>' . $row["number_of_days_admitted"]. '</td><td>' . $row["room_charges"]. '</td><td>' . $row["consultational_charges"]. '</td><td>' . $row["surgery_charges"]. '</td><td>' . $row["miscellaneous_charges"]. '</td><td>' . $row["insurance_amount"]. '</td><td>' . $row["total_amount"]. '</td>
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
					
