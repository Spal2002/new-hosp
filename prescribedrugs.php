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
		
	session_start();
	
	$employeeid = $_SESSION['empid'];
	
	$patientid = $_POST["drugs"];
	$drugs = $_POST["drugs1"];
	
	$query1 = "select patient_id from patients  where doctor_assigned = ".$employeeid." and patient_id = ".$patientid.";";
	$result1 = $conn->query($query1);
	if($result1->num_rows == 0)
	{
		echo "<script> 
    		 		alert('Requested Patient ID does not exist OR is not under your charge. Please enter valid Patient ID.');
    		 		document.location = 'employeehomepage.php';
    		      </script>";
    		exit;
    	}
    	
    	$query2 = "update patients set drugs_prescribed = '".$drugs."' where patient_id = ".$patientid.";";
    	$result2 = $conn->query($query2);
    	if(!$result2)
    	{
    		echo "ERROR";
               printf("\nErrormessage: %s\n", mysqli_error($conn));
               exit;
       	}
       	else
       	{
       		echo "<script> 
    		 		alert('The entered drugs have been prescribed to the intended patient.');
    		 		document.location = 'employeehomepage.php';
    		      </script>";
       		header("Location: employeehomepage.php");
       	}
?>
