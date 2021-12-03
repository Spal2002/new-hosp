<html>
	<head>
		<title>Generate a New Bill</title>
		<link rel = "stylesheet" href = "css/generatebill.css" />
		<script language="Javascript" type="text/javascript">
			function onlyNumbers(e, t) {
           		 	try {
               				if (document.event) {
               				     var charCode = document.event.keyCode;
               				 }
               			 	else if (e) {
                   					 var charCode = e.which;
                				}
               				 	else { return true; }
                			if(charCode > 47 && charCode < 58)
                   				 return true;
                			else
                   				 return false;
            				}
            			catch (err) {
                		alert(err.Description);
            			}
        		}
        	</script>
	</head>
	<body>
		<div id = "bill1">
			<header>
				<img src = "img/logo.png" alt = "Logo" />
   				<h1>NMIT HOSPITALS</h1>
				<h2>A One-Stop Solution To Keep You Healthy</h2>
			</header>
		</div>
		<div id = "bill2">
			<br />
			<form action = "processgeneratedbill.php" method = "post">
				<h2>Enter Patient Bill Information:</h2>
				<label for = "patienttid">Patient ID:</label>
    				<input type = "text" id = "patientid" name = "patientid" maxlength = "5" pattern = "[0-9]{1,5}" required autocomplete = "off" onkeypress = "return onlyNumbers(event,this);" placeholder = "(Mandatory)" />
    				<br />
    				<label for = "consultation">Enter Consultational Charges:</label>
    				<input type = "number"  step = "0.01" min = "0" id = "consultation" name = "consultation" autocomplete = "off" required placeholder = "(Mandatory)" />
    				<br />
    				<label for = "sugery">Enter Surgery Charges:</label>
    				<input type = "number"  step = "0.01" min = "0" id = "surgery" name = "surgery" required autocomplete = "off" placeholder = "(Mandatory)" />
    				<br />
    				<label for = "miscellaneous">Enter Miscellaneous Charges:</label>
    				<input type = "number"  step = "0.01" min = "0" id = "miscellaneous" name = "miscellaneous" required autocomplete = "off" placeholder = "(Mandatory)" />
    				<br />
    				<label for = "insuranceamount">Enter Insurance Amount:</label>
    				<input type = "number"  step = "0.01" min = "0" id = "insuranceamount" name = "insuranceamount" required autocomplete = "off" placeholder = "(Mandatory)" />
    				<br />
    				<input type = "submit" name = "submit" value= "Generate Bill" />
			</form>
		</div>
		<div id = "bill3">
			<footer>
				<ul>
					<li>Contact number: 080-23450917, 080-23450918, 080-23450919, 080-23334565</li>
					<li>&copy; NMIT Foundation for Medical Education and Research (NMITMER). All rights reserved.</li>
				</ul>
			</footer>
		</div>
	</body>
</html>			
