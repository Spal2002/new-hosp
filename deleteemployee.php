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
	
	$employeeid = $_POST["deleteemployee"];
	$replacementemployee = $_POST["replacementemployee"];
	
	$query1 = "select * from employee where employee_id = ".$employeeid.";";
	$result1 = $conn->query($query1);
	if($result1->num_rows == 0)
	{
		echo "<script> 
    		 		alert('The entered Employee ID does not exist. Please enter a valiid Employee ID.');
    				 document.location = 'adminhomepage.php';
    			</script>";
    		exit;
    	}
    	
    	if(isset($_POST["replacement_employee"])
    	{
    		$query2 = "select * from employee where employee_id = ".$replacementemployee.";";
		$result2 = $conn->query($query2);
		if($result2->num_rows == 0)
		{
			echo "<script> 
    			 		alert('The entered Replacement Employee ID does not exist. Please enter a valiid Employee ID.');
    					 document.location = 'adminhomepage.php';
    				</script>";
    			exit;
    		}
    		$row2 = $result2->fetch_assoc();
    	}
    	
    	
    	
    	$row1 = $result1->fetch_assoc();
    	$departmentid = $row1["department_id"];
    	
    	$query3 = "update departments set number_of_employees = number_of_employees - 1 where department_id = ".$departmentid.";";
    	$result3 = $conn->query($query3);
    	if(!$result3)
	{
		echo "ERROR";
              	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}
       	
       	$query4 = "update patients set doctor_assigned = ".$replacementemployee." where doctor_assigned = ".$departmentid.";";
    	$result4 = $conn->query($query4);
    	if(!$result4)
	{
		echo "ERROR";
              	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}
    	 
	$query5 = "delete from employeelogin where employee_id = ".$employeeid.";";
       	$result5 = $conn->query($query5);
	if(!$result5)
	{
		echo "ERROR";
              	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}
       	
       	$query6 = "delete from employee where employee_id = ".$employeeid.";";
    	$result6 = $conn->query($query6);
    	if(!$result6)
	{
		echo "ERROR";
              	printf("\nErrormessage: %s\n", mysqli_error($conn));
               	exit;
       	}
       		
       	echo "<script> 
    			alert('The intended employee has been successfully removed.');
    			 document.location = 'adminhomepage.php';
    		</script>";
?>
