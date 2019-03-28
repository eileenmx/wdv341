<?php
//Model-Controller Area.  The PHP processing code goes in this area. 

	//Method 1.  This uses a loop to read each set of name-value pairs stored in the $_POST array
	$tableBody = "";		//use a variable to store the body of the table being built by the script
	
	foreach($_POST as $key => $value)		//This will loop through each name-value in the $_POST array
	{
		$tableBody .= "<tr>";				//formats beginning of the row
		$tableBody .= "<td>$key</td>";		//display the name of the name-value pair from the form
		$tableBody .= "<td>$value</td>";	//dispaly the value of the name-value pair from the form
		$tableBody .= "</tr>";				//End this row
	} 
	
	
	//Method 2.  This method pulls the individual name-value pairs from the $_POST using the name
	//as the key in an associative array.  
	
	$inFirstName = $_POST["firstName"];		//Get the value entered in the first name field
	$inLastName = $_POST["lastName"];		//Get the value entered in the last name field
	$inSchool = $_POST["school"];			//Get the value entered in the school field
	$inGender = $_POST["radio"];
	$inClass = $_POST["checkbox"];
	$inDegree = $_POST["select"];
	

?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>wdv341 | form handler</title>
<link href="../../../../Users/eileenmcmanus/website/css/websitess.css" rel="stylesheet" type="text/css" style="text/css">
        <link href="../../../../Users/eileenmcmanus/website/css/head.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="head">
	<h1><a href="index.html">Eileen<br />McManus</a></h1>
	<ul>
	<li><a href="about.html">about</a></li>
	<li><a href="portfolio.html">portfolio</a></li>
	<li><a href="hw/hw.html">homework</a></li>
	</ul>
</div>	
       	
<div class="main-single"> 
<h1>WDV341 Intro PHP</h1>
<h2>Form Handler Result Page</h2>
<p>This page displays the results of the Server side processing. </p>
<p>The PHP page has been formatted to use the Model-View-Controller (MVC) concepts. </p>
<h3>Display the values from the form using Method 1. Uses a loop to process through the $_POST array</h3>
<p>
	<table border='a'>
    <tr>
    	<th>Field Name</th>
        <th>Value of Field</th>
    </tr>
	<?php echo $tableBody;  ?>
	</table>
</p>
<h3>Display the values from the form using Method 2. Displays the individual values.</h3>

<p>First Name: <?php echo $inFirstName; ?></p>
<p>Last Name: <?php echo $inLastName; ?></p>
<p>School: <?php echo $inSchool; ?></p>
<p>Gender: <?php echo $inGender; ?></p>
<p>Class Format: <?php echo $inClass; ?></p>
<p>Degree Type: <?php echo $inDegree; ?></p>

	</div>
		  <footer>
	  <p>Write | mcmanuseileen790@gmail.com<br />
	  	
	  	Call | 515.783.8159<br />
	  	Link | <a href="http://www.linkedin.com/in/eileen-mcmanus" target="_blank">linkedin.com/eileen-mcmanus</a></p>
	  </footer>
</body>
</html>