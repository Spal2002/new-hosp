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
	
	$del_app = $_POST["deleteappointment"];
	
	$query1 = "select * from appointments where appointment_id = ".$del_app.";";
	$result1 = $conn->query($query1);
	if($result1->num_rows == 0)
	{
		echo "<script> 
    		 		alert('The Appointment requested to be deleted does not exist.');
    				 document.location = 'receptionhomepage.php';
    			</script>";
    		exit;
    	}
    	
    	$query2 = "select * from patients where appointment_id = ".$del_app.";";
    	$result2 = $conn->query($query2);
    	if($result2->num_rows > 0)
    	{
    		echo "<script> 
    		 	alert('The Appointment ID entered is already a patient. Cannot delete this ID.');
    			 document.location = 'receptionhomepage.php';
    		</script>";
    		exit;
    	}
	
	$query3 = "delete from appointments where appointment_id = ".$del_app.";";
	$result3 = $conn->query($query3);
	if(!$result3)
	{
		echo "Error";
		printf("\nErrormessage: %s\n", mysqli_error($conn));
       	}

       	echo "<script> 
    		 	alert('The appointment has been cancelled.');
    			 document.location = 'receptionhomepage.php';
    		</script>";
?>
