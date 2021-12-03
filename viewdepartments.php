<html>
	<head>
		<title>Department Details</title>
		<link rel = "stylesheet" href = "css/viewdepartments.css" />
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

		$sql = "SELECT * FROM departments;";
		$result = $conn->query($sql);
		
		echo '<div id = "employee1">
			<header>
				<img src = "img/logo.png" alt = "Logo" />
   				<h1>NMIT HOSPITALS</h1>
				<h2>A One-Stop Solution To Keep You Healthy</h2>
			</header>
		</div>';
		echo '<div class = "employee2">';
		if ($result->num_rows > 0) {
    			echo '<table align = "center">
    				<tr>
    					<th>Department ID</th><th>Department Name</th><th>Number Of Employees</th>
    				</tr>';
   			// output data of each row
    			while($row = $result->fetch_assoc()) {
        			echo '<tr>
        				<td>' . $row["department_id"]. '</td><td>' . $row["department_name"]. '</td><td>' . $row["number_of_employees"] . '</td>
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
		echo '<div id = "employee3">
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
