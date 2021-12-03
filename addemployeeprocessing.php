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
	
	$departmentid = $_POST["departmentid"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$day = $_POST["day"];
	$month = $_POST["month"];
	$year = $_POST["year"];
	$email = $_POST["email"];
	$gender = $_POST["gender"];
	$contact = $_POST["contact"];
	$qualifications = $_POST["qualifications"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	if((($month == 2) && (($day == 30) || ($day == 31))) || ((($month == 4) || ($month == 6) || ($month == 9) || ($month == 11)) && ($day == 31)))
	{
		echo "<script> 
    		 		alert('Invalid Date. Please re-enter details.');
    		 		document.location = 'addemployee.php';
    		      </script>";
    		exit;
    	}
    	$leap = 0;	
	if(((($year%4) == 0) && (($year%100) != 0))|| (($year%400) == 0))
		$leap =1;
	if(($leap == 0) && ($month == 2) && ($day == 29))
	{
		echo "<script> 
    		 		alert('Invalid Date. Please re-enter details.');
    		 		document.location = 'addemployee.php';
    		      </script>";
    		exit;
    	}
    	
    	$checkemployeeexists = "SELECT * FROM employee WHERE department_id = ".$departmentid." and first_name = '".$firstname."' and last_name = '".$lastname."' and dob = '".$year."-".$month."-".$day."' and email = '".$email."' and gender = '".$gender."' and contact_number = '".$contact."' and qualifications = '".$qualifications."';";
       	$result = $conn->query($checkemployeeexists);
       	if($result->num_rows > 0)
	{
		echo "<script> 
    		 		alert('The employee already exists.');
    				 document.location = 'adminhomepage.php';
    			</script>";
    		exit;
    	}
    	
    	$temp_query = "SELECT * FROM departments WHERE department_id = ".$departmentid.";";
    	$temp_result = $conn->query($temp_query);
    	if($temp_result->num_rows == 0)
    	{
    		echo "<script> 
    		 		alert('The Department ID entered is invalid. Plese re-enter details.');
    				 document.location = 'addemployee.php';
    			</script>";
    		exit;
        }
        
        $sql = "select * from employeelogin where username = '".$username."';";
        $sqlresult = $conn->query($sql);
        if($sqlresult->num_rows > 0)
        {
        	echo "<script> 
    		 		alert('The Username entered has already been assigned to another employee. Plese re-enter details.');
    				 document.location = 'addemployee.php';
    			</script>";
    		exit;
        }
        
        $query1 = "INSERT INTO employee(department_id,first_name, last_name, dob, email, gender, contact_number, qualifications) values(".$departmentid.",'".$firstname."','".$lastname."','".$year."-".$month."-".$day."','".$email."','".$gender."','".$contact."','".$qualifications."');";
	$result1 = $conn->query($query1);
	if(!$result1)
        {
               echo "ERROR";
               printf("\nErrormessage: %s\n", mysqli_error($conn));
               exit;
       	}
       	
       	$query2 = "SELECT * FROM employee WHERE department_id = ".$departmentid." and first_name = '".$firstname."' and last_name = '".$lastname."' and dob = '".$year."-".$month."-".$day."' and email = '".$email."' and gender = '".$gender."' and contact_number = '".$contact."' and qualifications = '".$qualifications."';";
       	$result2 = $conn->query($query2);
       	if($result2->num_rows > 0)
	{
		$row = $result2->fetch_assoc();
		$employeeid = $row["employee_id"];
	}
	else
	{
		 echo "ERROR";
               printf("\nErrormessage: 0 results\n");
               exit;
        }
        	
    	$query3 = "INSERT INTO employeelogin(username, password, employee_id) values('".$username."','".$password."',".$employeeid.");";
    	$result3 = $conn->query($query3);
    	if(!$result3)
    	{
    		echo "ERROR";
		printf("\nErrormessage: %s\n", mysqli_error($conn));
		exit;
        }
        
        $query4 = "update departments set number_of_employees = number_of_employees + 1 where department_id = ".$departmentid.";";
        $result4 = $conn->query($query4);
        if(!$result4)
    	{
    		echo "ERROR";
		printf("\nErrormessage: %s\n", mysqli_error($conn));
		exit;
        }
        
    	if($result2)
    	{
                	echo "<script> 
    		 		alert('The employee has been added to the records.');
    				 document.location = 'adminhomepage.php';
    			</script>";
        }
        else
    	{
    		 echo "ERROR";
               printf("\nErrormessage: %s\n", mysqli_error($conn));
       	}
?>	
