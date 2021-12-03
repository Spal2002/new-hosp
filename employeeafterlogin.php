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
				
		$username = $_POST["employeeusername"];
		$password = $_POST["employeepassword"];
		
		$query = "SELECT * FROM employeelogin WHERE username = '".$username."' AND password = '".$password."';";  
		$result = $conn->query($query);
    		if($result->num_rows == 0)
    		{
    			 echo "<script> 
    			 		alert('Invalid Username and Password. Please re-enter.');
    			 		document.location = 'employeelogin.php';
    			      </script>";
    			 exit;
       		}
       		else
  		{  
   			 $row = $result->fetch_assoc(); 
    			 $_SESSION['empid'] = $row['employee_id'];
    			 header("Location: employeehomepage.php");
    		}
    		
    		$conn->close();
?>
