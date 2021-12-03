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
	
	$appointmentid = $_POST["appointmentid"];
	$roomid = $_POST["room_id"];
	$doctorid = $_POST["doctorid"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$checkappointmentexists = "select * from appointments where appointment_id = ".$appointmentid.";";
	$result1 = $conn->query($checkappointmentexists);
	if($result1->num_rows == 0)
	{
		echo "<script> 
    		 		alert('The entered Appointment ID does not exist. Please take an appointment first.');
    				 document.location = 'adminhomepage.php';
    			</script>";
    		exit;
    	}
    	$row1 = $result1->fetch_assoc();
    	
    	$checkemployeeexists = "select * from employee where employee_id = ".$doctorid.";";
    	$result6 = $conn->query($checkemployeeexists);
    	if($result6->num_rows == 0)
	{
		echo "<script> 
    		 		alert('The entered Employee ID does not exist. Please re-enter details.');
    				 document.location = 'addpatient.php';
    			</script>";
    		exit;
    	}
    	else
    	{
    		$row = $result6->fetch_assoc();
    		if($row["department_id"] == 12 || $row["department_id"] == 17 || $row["department_id"] == 7)
    		{
    			echo "<script> 
    		 		alert('The entered Employee ID does not belong to a doctor. Please re-enter details.');
    				 document.location = 'addpatient.php';
    			</script>";
    			exit;
    		}
    	}
    	
    	$checkpatientexists = "select * from patients where appointment_id = ".$appointmentid.";";
	$result7 = $conn->query($checkpatientexists);
	if($result7->num_rows > 0)
	{
		echo "<script> 
    		 		alert('A patient with the entered Appointment ID already exists.');
    				 document.location = 'adminhomepage.php';
    			</script>";
    		exit;
    	}
    	
    	$query14 = "select * from patientlogin where username = '".$username."';";
    	$result14 = $conn->query($query14);
    	if($result14->num_rows > 0)
    	{
    		echo "<script> 
    		 		alert('The Username entered already exists. Please enter something else.');
    				 document.location = 'addpatient.php';
    			</script>";
    		exit;
    	}
    	
    	$patienttype = $row1["patient_type"];
    	if($patienttype == "Outpatient")
    	{
    		$query13 = "insert into patients(appointment_id, doctor_assigned) values(".$appointmentid.",".$doctorid.");";
    		$result13 = $conn->query($query13);
		if(!$result13)
        	{
              		echo "ERROR";
              	 	printf("\nErrormessage: %s\n", mysqli_error($conn));
               		exit;
       		}
       		goto a;
       	}
    	
    	$checkroomexists = "select * from rooms where room_id = ".$roomid.";";
	$result2 = $conn->query($checkroomexists);
	if($result2->num_rows == 0)
	{
		echo "<script> 
    		 		alert('The entered Room ID does not exist. Please re-enter details.');
    				 document.location = 'addpatient.php';
    			</script>";
    		exit;
    	}
    	else
    	{
    		$query3 = "update rooms set number_of_patients = number_of_patients + 1 where room_id = ".$roomid.";";
    		$conn->query($query3);
    		$query4 = "select * from rooms where number_of_beds < number_of_patients;";
    		$result4 = $conn->query($query4);
    		if($result4->num_rows > 0)
    		{
    			echo "<script> 
    		 		alert('The entered Room ID is not currently available. Please enter the Room ID of an available room.');
    				 document.location = 'addpatient.php';
    			</script>";
    			$query5 = "update rooms set number_of_patients = number_of_patients - 1 where room_id = ".$roomid.";";
    			$conn->query($query5);
    			exit;
    		}
    	}
    	
    	$query8 = "insert into patients(appointment_id, doctor_assigned, room_id) values(".$appointmentid.",".$doctorid.",".$roomid.");";
    	$result8 = $conn->query($query8);
	if(!$result8)
        {
               echo "ERROR";
               printf("\nErrormessage: %s\n", mysqli_error($conn));
               exit;
       	}
       	
       	a:
       	$query9 = "update employee set number_of_patients = number_of_patients + 1 where employee_id = ".$doctorid.";";
       	$result9 = $conn->query($query9);
       	if(!$result9)
        {
               echo "ERROR";
               printf("\nErrormessage: %s\n", mysqli_error($conn));
               exit;
       	}	
       	
       	$query11 = "SELECT * FROM patients WHERE appointment_id = ".$appointmentid.";";
       	$result11 = $conn->query($query11);
       	if($result11->num_rows > 0)
	{
		$row = $result11->fetch_assoc();
		$patientid = $row["patient_id"];
	}
	else
	{
		 echo "ERROR";
               	 printf("\nErrormessage: 0 results\n");
                 exit;
        }
        
       	$admitdate = $row1["date_of_admission"];
       	$query10 = "insert into lastbilldate values(".$patientid.",'".$admitdate."');";
       	$result10 = $conn->query($query10);
       	if(!$result10)
       	{
		 echo "ERROR";
               	 printf("\nErrormessage: %s\n", mysqli_error($conn));
                 exit;
        }       	
        
        $query12 = "INSERT INTO patientlogin(username, password, patient_id) values('".$username."','".$password."',".$patientid.");";
    	$result12 = $conn->query($query12);
    	if($result12)
    	{
                	echo "<script> 
    		 		alert('The patient has been successfully added to the existing records.');
    				 document.location = 'receptionhomepage.php';
    			</script>";
        }
        else
    	{
    		 echo "ERROR";
               printf("\nErrormessage: %s\n", mysqli_error($conn));
       	}
?>
