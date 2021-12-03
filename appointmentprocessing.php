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
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$pincode = $_POST["pincode"];
	$primaryphone = $_POST["primaryphone"];
	$email = $_POST["email"];
	$gender = $_POST["gender"];
	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$insurance = $_POST["insurance"];
	$insurancenum = $_POST["insurance_num"];
	$patienttype = $_POST["patient_type"];
	$medicalconcern = $_POST["medicalconcern"];
	
	if((($month == 2) && (($day == 30) || ($day == 31))) || ((($month == 4) || ($month == 6) || ($month == 9) || ($month == 11)) && ($day == 31)))
	{
		echo "<script> 
    		 		alert('Invalid Date. Please re-enter details.');
    		 		document.location = 'appointment.html';
    		      </script>";
    	}
    	$leap = 0;	
	if(((($year%4) == 0) && (($year%100) != 0))|| (($year%400) == 0))
		$leap =1;
	if(($leap == 0) && ($month == 2) && ($day == 29))
	{
		echo "<script> 
    		 		alert('Invalid Date. Please re-enter details.');
    		 		document.location = 'appointment.html';
    		      </script>";
    		exit;
    	}
    	
    	if($insurance == "No")
    	{
    		$query = "INSERT INTO appointments(first_name, last_name, address, city, state, pin, primary_phone, email, gender, dob,insurance, patient_type, medical_concerns,date_of_admission) values('".$firstname."','".$lastname."','".$address."','".$city."','".$state."','".$pincode."','".$primaryphone."','".$email."','".$gender."','".$year."-".$month."-".$day."','".$insurance."','".$patienttype."','".$medicalconcern."',curdate());";
		$result = $conn->query($query);
	}
	else if($insurance == "Yes")
	{
		$query = "INSERT INTO appointments(first_name, last_name, address, city, state, pin, primary_phone, email, gender, dob,insurance, insurance_number, patient_type, medical_concerns,date_of_admission) values('".$firstname."','".$lastname."','".$address."','".$city."','".$state."','".$pincode."','".$primaryphone."','".$email."','".$gender."','".$year."-".$month."-".$day."','".$insurance."','".$insurancenum."','".$patienttype."','".$medicalconcern."',curdate());";
			$result = $conn->query($query);
		
	}
	
	if($result)
	{
                	echo "<script> 
    		 			alert('An appointment has been requested. You will be contacted soon.');
    		 			window.close();
    			</script>";
        }
        else
        {
               echo "<script> 
    		 			alert('Please enter a valid insurance number.');
    		 			document.location = 'appointment.html';
    			</script>";
       	}
?>
