<?php



include("connect.php");

try {

	$sql ="SELECT event_id, event_name, event_description, event_presenter, event_date, event_time FROM wdv341_events";
	
    $stmt = $conn->prepare($sql); 
    $stmt->execute();
	$rows=$stmt->fetchAll();

}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "<table></table>";


?>



<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>wdv341 | select php</title>
<link href="http://eileenmx.com/css/websitess.css" rel="stylesheet" type="text/css" style="text/css">
<link href="http://eileenmx.com/css/head.css" rel="stylesheet" type="text/css">
</head>

<style>
	
	 tr, td {
		border: solid thin #CCCCFF;
		padding: 15px;
		margin: 50px;
		border-radius: 5px;
	}
	
	.table-head {
		font-weight: bold;
		color: #003A95;
	}
	
	.button {
		background-color: #CCCCFF;
	}

	
	</style>

<body>
<div class="head">
	<h1><a href="http://eileenmx.com/index.html">Eileen<br />McManus</a></h1>
	<ul>
	<li><a href="http://eileenmx.com/about.html">about</a></li>
	<li><a href="http://eileenmx.com/portfolio.html">portfolio</a></li>
	<li><a href="http://eileenmx.com/hw/hw.html">homework</a></li>
	</ul>
</div>	
<div class="main-single">
<h1>WDV341 Intro PHP</h1>
<h2>Select Events</h2>
<table>
<?php
	echo "<tr class='table-head'>
		<td>Event ID</td>
		<td>Event Name</td>
		<td>Event Description</td>
		<td>Event Date</td>
		<td>Event Time</td>
			</tr>";
	
foreach($rows as $row) {

			echo "<tr>";
			echo "<td>" . $row['event_id'] . "</td>";
			echo "<td>" . $row['event_name'] . "</td>";	
			echo "<td>" . $row['event_description'] . "</td>";
			echo "<td>" . $row['event_date'] . "</td>";
			echo "<td>" . $row['event_time'] . "</td>";
			echo "<td class='button'><a href='eventUpdate.php?eventID=" . $row['event_id'] . "'>Update</a></td>";
			echo "<td class='button'><a href='deleteEvent.php?eventID=" . $row['event_id'] . "'>Delete</a></td>"; 		
		echo "</tr>";

    }
?>



</table>

</div>
		  <footer>
	  <p>Write | mcmanuseileen790@gmail.com<br />
	  	
	  	Call | 515.783.8159<br />
	  	Link | <a href="http://www.linkedin.com/in/eileen-mcmanus" target="_blank">linkedin.com/eileen-mcmanus</a></p>
	  </footer>
</body>
</html>



