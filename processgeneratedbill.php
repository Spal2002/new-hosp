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
	
	$patientid = $_POST["patientid"];
	$consultation = $_POST["consultation"];
	$surgery = $_POST["surgery"];
	$miscellaneous = $_POST["miscellaneous"];
	$insuranceamount = $_POST["insuranceamount"];
		
	$query1 = "select * from patients where patient_id = ".$patientid.";";
	$result1 = $conn->query($query1);
	if($result1->num_rows == 0)
	{
		echo "<script> 
    		 		alert('The Patient ID does not exist.');
    				 document.location = 'generatebill.php';
    			</script>";
    		exit;
    	}
    	
    	$row1 = $result1->fetch_assoc();
    	$roomid = $row1["room_id"];
    	
    	$sql = "select * from lastbilldate where patient_id = ".$patientid.";";
    	$result = $conn->query($sql);
    	if($result->num_rows == 0)
    	{
    		echo "0 results";
    		exit;
    	}
    	    	
    	$row = $result->fetch_assoc();
    	$lastbilldate = $row["lastbill"];
    	
    	if($roomid == NULL)
    	{
    		$roomcharges = 0;
    		$numdays = 0;
    		goto a;
    	}
    		
    	$query2 = "select * from rooms where room_id = ".$roomid.";";
    	$result2 = $conn->query($query2);
    	if($result2->num_rows > 0)
    	{
    		$row2 = $result2->fetch_assoc();
    		$chargespernight = $row2["charges_per_night"];
    	}
    	else
    	{
    		echo "ERROR";
               	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}
       		
       	$query3 = "select datediff(curdate(),'".$lastbilldate."') as numdays;";
       	$result3 = $conn->query($query3);
       	if($result3->num_rows > 0)
       	{
       		$row3 = $result3->fetch_assoc();
    		$numdays = $row3["numdays"];
	}
	else
	{
		echo "ERROR";
               	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}		
       	
        $roomcharges = $numdays * $chargespernight;
        
        a:
        
        $temp_query = "select a.insurance from appointments a, patients p where a.appointment_id = p.appointment_id;";
        $temp_result = $conn->query($temp_query);
        $temp_row = $temp_result->fetch_assoc();
        $insurance = $temp_row["insurance"];
        if($insurance == "No")
        	$insuranceamount = 0;
       	$totalcharges = $roomcharges + $consultation + $surgery + $miscellaneous - $insuranceamount;
       	
       	$query4 = "insert into bills(patient_id,number_of_days_admitted, room_charges, consultational_charges, surgery_charges, miscellaneous_charges, insurance_amount, total_amount) values(".$patientid.",".$numdays.",".$roomcharges.",".$consultation.",".$surgery.",".$miscellaneous.",".$insuranceamount.",".$totalcharges.");";
       	$result4 = $conn->query($query4);
       	if(!$result4)
       	{
       		echo "ERROR";
               	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}
       	
       	$query5 = "update lastbilldate set lastbill = curdate() where patient_id = ".$patientid.";";
       	$result5 = $conn->query($query5);
       	if(!$result5)
       	{
       		echo "ERROR";
               	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}		       		
       	
       	echo "<script> 
    		 alert('The bill for the requested Patient ID has been generated.');
    		document.location = 'receptionhomepage.php';
    	</script>";
?>
