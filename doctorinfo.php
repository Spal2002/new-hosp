<html>
	<head>
		<title>Doctor Information</title>
		<link rel = "stylesheet" href = "css/doctorinfo.css" />
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
		
		echo '<div id = "employee1">
			<header>
				<img src = "img/logo.png" alt = "Logo" />
   				<h1>NMIT HOSPITALS</h1>
				<h2>A One-Stop Solution To Keep You Healthy</h2>
			</header>
		</div>';
		
		echo '<div class = "employee2">';
		
		$num_of_departments = 1;
		
		do{
			if($num_of_departments == 12 || $num_of_departments == 17 || $num_of_departments == 7)
				goto a;
			
			$query1 = "SELECT * FROM employee where department_id = ".$num_of_departments.";";
			$result1 = $conn->query($query1);
			
			$query2 = "select * from departments where department_id = ".$num_of_departments.";";
			$result2 = $conn->query($query2);
			if($result2->num_rows > 0)
			{
				$row2 = $result2->fetch_assoc();
				$departmentname = $row2["department_name"];
				echo '<h2>'.$departmentname.':</h2>';
			}
			else
			{
				echo "Department with ID: ".$num_of_departments." does not exist.";
			}
		
			if ($result1->num_rows > 0)
			{
				echo '<table>
    					<tr>
    						<th>Employee ID</th><th>Department ID</th><th>First Name</th><th>Last Name</th><th>Date of Birth</th><th>E-mail ID</th><th>Gender</th><th>Contact Number</th><th>Qualifications</th>
    					</tr>';
   				// output data of each row
    				while($row1 = $result1->fetch_assoc()) {
        				echo '<tr>
        					<td>' . $row1["employee_id"]. '</td><td>' . $row1["department_id"]. '</td><td>' . $row1["first_name"] . '</td><td>' . $row1["last_name"]. '</td><td>' . $row1["dob"]. '</td><td>' . $row1["email"]. '</td><td>' . $row1["gender"]. '</td><td>' . $row1["contact_number"]. '</td><td>' . $row1["qualifications"]. '</td>
        				</tr>';
    				}
    				echo '</table>';
			}
			else
   				 echo "0 results";
   			 
   			a: $num_of_departments++;
   		
   		}while($num_of_departments < 18);
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
