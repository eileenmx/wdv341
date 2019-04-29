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


if($validForm) { 
	$message = $inName." has been entered into the database
	<p><br/>Name: $inName</p>
	<p>Breed: $inBreed </p>
	<p>Age: $inAge </p>
	<p>Description: $inDescription </p>
	<p>Date entered into system: $inDate <br/></p>";

	include("../wdv341/connect.php");
	

	try {

		$sql="INSERT INTO ff_dogs (dog_name, dog_breed, dog_age, dog_description, dog_entry_date) VALUES (:dog_name, :dog_breed, :dog_age, :dog_description, :dog_entry_date)";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam(':dog_name', $inName);
		$stmt->bindParam(':dog_breed', $inBreed);
		$stmt->bindParam(':dog_age', $inAge);
		$stmt->bindParam(':dog_description', $inDescription);
		$stmt->bindParam(':dog_entry_date', $inDate);
	
		$stmt->execute();

    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }

$conn=null;
			
			}
		else {
			$message="Check for errors in your entry & try again";
		}

}

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Dogs for Foster | Insert</title>
<link type="text/css" rel="stylesheet" href="ff.css"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	.errMsg {
		color: red;
	}
	</style>

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
<?php
	
if($validForm)
	
{
?>
	<h3><?php echo $message; ?></h3>

<?php
}
else
{

?>
	<h3><?php echo $message; ?></h3>


<form name="ff_dogs" method="POST" action="<?php ($_POST['submit'])?>">

	<label for="dog_name">Name </label>
	<input type="text" name="dog_name" value="<?php echo $inName ?>"/>
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