<?php
$inName="";
$inBreed="";
$inAge="";
$inDescription="";
$inDate="";

$inNameErr="";
$inBreedErrr="";
$inAgeErr="";
$inDescriptionErr="";
$inDateErr="";

$updateDogID=$_GET['dogID'];

	function validateName($inName) {
		global  $inNameErr;
		$inNameErr = "";
		if($inName == "") {
			return false;
			$inNameErr = "Enter dog name";
		}
		return true;
	}
	
	function validateBreed($inBreed) {
		global $inBreedErr;
		$inBreedErr="";
		if($inBreed == "") {
			return false;
			$inBreedErr="Enter a description";
		}
		return true;
	}
	
	
	/*function validateAge($inAge){
		global  $inAgeErr;
		$inAgeErr="";
		if(
			is_numeric($inAge)) {
			return false;
			$inAgeErr="<p>Age must be a number</p>";
		}
		return true;
	}*/

	function validateDescription($inDescription) {
		global $inDescriptionErr;
		$inDescriptionErr="";
		if($inDescription == "") {
			return false;
			$inDescriptionErr="Enter a description";
		}
		return true;
	}

	function validateDate($inDate){
		global  $inDateErr;
		$inDateErr="";
		if($inDate == "") {
			return false;
			$inDateErr="Enter date";
		}
		return true;
	}

	
if(isset($_POST["submitForm"])) {
	
		$inName=$_POST['dog_name'];
		$inBreed=$_POST['dog_breed'];
		$inAge=$_POST['dog_age'];
		$inDescription=$_POST['dog_description'];
		$inDate=$_POST['dog_entry_date'];
		
				
$validForm = true;
		
if (!validateName($inName)){
	$validForm = false;
}
if (!validateDescription($inBreed)){
	$validForm = false;
}
/*if (!validateAge($inAge)){
	$validForm = false;
}*/
if (!validateDescription($inDescription)){
	$validForm=false;
}

if	(!validateDate($inDate)){
	$validForm=false;
}


if($validForm) { //form is valid. run update
	$message = $inName." has been UPDATED.
	<p><br/>Name: $inName</p>
	<p>Breed: $inBreed </p>
	<p>Age: $inAge </p>
	<p>Description: $inDescription </p>
	<p>Date entered into system: $inDate <br/></p>";

	include("../wdv341/connect.php");
	

	try {

		$sql="UPDATE ff_dogs SET dog_name='$inName', dog_breed='$inBreed', dog_age='$inAge', dog_description='$inDescription', dog_entry_date='$inDate' WHERE dog_id='$updateDogID' ";
	
		$stmt = $conn->prepare($sql);
		$stmt->execute();

    }
	
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }

$conn=null;
			
			} else { //FORM NOT VALID-TRY AGAIN
			$message="form is not valid!";
		}
} else { //FORM HAS NOT BEEN SUBMITTED. RUN SELECT
	
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
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dogs for Foster | Update</title>
	<link rel="stylesheet" href="ff.css">  
  	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>    
  	
    <script>
		function clearForm() {
			$('.errMsg').html("");		
			$('input:text').removeAttr('value');
			$('textarea').html("");	
		}
	</script>
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

if(is_array($rows)){
foreach($rows as $row) {
			echo "<tr>";
			echo "<td>" . $row['dog_id'] . " </td>";
			echo "<td>" . $row['dog_name'] . " </td>";	
			echo "<td>" . $row['dog_breed'] . " </td>";
			echo "<td>" . $row['dog_age'] . " </td>";
			echo "<td>" . $row['dog_description'] . " </td>";
			echo "<td>" . $row['dog_entry_date'] . " </td>"; 		
			echo "</tr>";
    }
}
?>
</table>
<br/>
<?php
	
if($validForm) {
?>
	<h3><?php echo $message; ?></h3>
<?php
} else {
?>
	<h3><?php echo $message; 
		
		echo "updating". $inName;
		
		?></h3>


<form name="ff_dogs" method="POST" action="<?php ($_POST['submitForm']. "?dogId=$updateDogID")?>">

	<label for="dog_name">Name </label>
	<input type="text" name="dog_name" value="<?php $inName ?>"/>
		<span class="errMsg"> <?php echo $inNameErr; ?></span><br/>
	
	<label for="dog_breed">Breed </label>
	<input type="text" name="dog_breed" value="<?php echo $inBreed ?>"/>
		<span class="errMsg"> <?php echo $inBreedErr; ?></span><br/>
	
	<label for="dog_age">Age </label>
	<input type="text" name="dog_age" value="<?php echo $inAge ?>"/>
		<span class="errMsg"> <?php echo $inAgeErr; ?></span><br/>
		
	<label for="event_date">Description </label>
	<input type="text" name="dog_description" value="<?php echo $inDescription ?>"/>
		<span class="errMsg"> <?php echo $inDescriptionErr; ?></span><br/>
		
	<label for="event_time">Date entered into system</label>
	<input type="date" name="dog_entry_date" value="<?php echo $inDate ?>"/>
		<span class="errMsg"> <?php echo $inDateErr; ?></span><br/>
		
	<input type="submit" name="submitForm" value="submit"/>
	<input type="reset" name="resetForm" value="reset"/>
	
</form>

<?php
}
?>
</div>
</div>
<footer>
<div class="border">
	<h3>Furry Foster</h3>
	<p>222 Ingersoll Ave.</p>
	<p>Des Moines, IA 50312</p>
	</div>
</footer>
</body>
</html>