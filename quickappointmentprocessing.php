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
	
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$contact = $_POST["contact"];
	$doctorid = $_POST["doctorid"];
	
	$checkemployeeexists = "select * from employee where employee_id = ".$doctorid.";";
    	$result1 = $conn->query($checkemployeeexists);
    	if($result1->num_rows == 0)
	{
		echo "<script> 
    		 		alert('The entered Employee ID does not exist. Please re-enter details.');
    				 document.location = 'quickappointment.html';
    			</script>";
    		exit;
    	}
    	else
    	{
    		$row1 = $result1->fetch_assoc();
    		if($row1["department_id"] == 12 || $row1["department_id"] == 17 || $row1["department_id"] == 7)
    		{
    			echo "<script> 
    		 		alert('The entered Employee ID does not belong to a doctor. Please re-enter details.');
    				 document.location = 'quickappointment.html';
    			</script>";
    			exit;
    		}
    	}
    	
    	$query2 = "select * from quickappointments where app_date = curdate() and doctor_id = ".$doctorid.";";
    	$result2 = $conn->query($query2);
    	if($result2->num_rows > 4)
    	{
    		echo "<script> 
    		 			alert('All appointment slots for the requested doctor have already been booked. Please try again tomorrow.');
    		 			document.location = 'home.html';
    			</script>";
    		exit;
    	}
    	
    	$query4 = "select * from quickappointments where app_date = curdate() and doctor_id = ".$doctorid." and first_name = '".$firstname."' and last_name = '".$lastname."' and mobile_number = '".$contact."';";
    	$result4 = $conn->query($query4);
    	if($result4->num_rows > 0)
    	{
    		echo "<script> 
    		 			alert('Your appointment has already been confirmed.');
    		 			document.location = 'home.html';
    			</script>";
    		exit;
    	}
    	
	$query3 = "INSERT INTO quickappointments(first_name, last_name, app_date, doctor_id, mobile_number) values('".$firstname."','".$lastname."',curdate(),".$doctorid.",'".$contact."');";
	$result3 = $conn->query($query3);
	if($result3)
	{
                	echo "<script> 
    		 			alert('An appointment with the requested doctor is confirmed for today. Thank you for using our services.');
    		 			window.close();
    			</script>";
        }
        else
        {
               echo "ERROR";
               printf("\nErrormessage: %s\n", mysqli_error($conn));
       	}
?>
