<?php



include("../wdv341/connect.php");

try {

	$sql ="SELECT dog_id, dog_name, dog_breed, dog_age, dog_description, dog_entry_date FROM ff_dogs";
	
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
<title>Dogs for Foster | Select</title>
<link type="text/css" rel="stylesheet" href="ff.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
<header>
<div>
<img src="ff-icon.png" height="200" width="200"/>
	<h1 class="name">Furry Foster</h1>
	</div>
	
</header>
<div class="container">
<div class="sidebar">
		<ul>
		<li><a href="ff-insert.php">Add a new dog</a></li>
		<li><a href="ff-select.php">Show current foster dogs</a></li>
		<li><a href="ff-login.php">Administrator Page</a></li>
	</ul>
</div>
<div class="main">
<table>
<?php
	echo "<tr class='table-head'>
		<td>ID </td>
		<td>Name </td>
		<td>Breed </td>
		<td>Age </td>
		<td>Description </td>
		<td>Date </td>
			</tr>";
	
foreach($rows as $row) {
			echo "<tr>";
			echo "<td>" . $row['dog_id'] . " </td>";
			echo "<td>" . $row['dog_name'] . " </td>";	
			echo "<td>" . $row['dog_breed'] . " </td>";
			echo "<td>" . $row['dog_age'] . " </td>";
			echo "<td>" . $row['dog_description'] . " </td>";
			echo "<td>" . $row['dog_entry_date'] . " </td>";
			echo "<td class='button'><a href='ff-update.php?dogID=". $row['dog_id'] . "'>
			Update</a> </td>";
			echo "<td class='button'><a href='ff-delete.php?dogID=" . $row['dog_id'] . "'>Delete</a> </td>"; 		
			echo "</tr>";
    }
?>
</table>
</div>

</div>
<footer>
<div class="border">
	

	<h3>Furry Foster</h3>
	<p>222 Ingersoll Ave.</p>
	<p>Des Moines, IA 50312</p>
	</div>
</footer>

</html>





