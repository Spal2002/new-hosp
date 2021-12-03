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
	
	$patientid = $_POST["deletepatient"];
	
	$query1 = "select * from patients where patient_id = ".$patientid.";";
	$result1 = $conn->query($query1);
	if($result1->num_rows > 0)
	{
		$row1 = $result1->fetch_assoc();
		$doctorid = $row1["doctor_assigned"];
		$roomid = $row1["room_id"];
		
		$query2 = "update rooms set number_of_patients = number_of_patients - 1 where room_id = ".$roomid.";";
		$result2 = $conn->query($query2);
		if(!$result2)
		{
			echo "ERROR";
              		printf("\nErrormessage: %s\n", mysqli_error($conn));
               		exit;
       		}
       		
       		$query4 = "update employee set number_of_patients = number_of_patients - 1 where employee_id = ".$doctorid.";";
       		$result4 = $conn->query($query4);
		if(!$result4)
		{
			echo "ERROR";
              		printf("\nErrormessage: %s\n", mysqli_error($conn));
               		exit;
       		}
       		
       		$query5 = "delete from patientlogin where patient_id = ".$patientid.";";
       		$result5 = $conn->query($query5);
		if(!$result5)
		{
			echo "ERROR";
              		printf("\nErrormessage: %s\n", mysqli_error($conn));
               		exit;
       		}
       		
       		$query3 = "delete from patients where patient_id = ".$patientid.";";
       		$result3 = $conn->query($query3);
		if(!$result3)
		{
			echo "ERROR";
              		printf("\nErrormessage: %s\n", mysqli_error($conn));
               		exit;
       		}
       		
       		echo "<script> 
    		 		alert('The intended patient has been successfully removed.');
    				 document.location = 'receptionhomepage.php';
    			</script>";
	}
	else
	{
		echo "<script> 
    		 		alert('The entered Patient ID does not exist. Please enter a valid Patient ID.');
    				 document.location = 'receptionhomepage.php';
    			</script>";
    		exit;
    	}
?>
