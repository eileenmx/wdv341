<?php 
$inName="";
$inDescription="";
$inPresenter="";
$inDate="";
$inTime="";

$inNameErr="";
$inDescriptionErr="";
$inPresenterErr="";
$inDateErr="";
$inTimeErr="";


	
	


	function validateName($inName) {
		global  $inNameErr;
		$inNameErr = "";
		if($inName == "") {
			return false;
			$inNameErr = "Enter event name";
		}
		return true;
	}
	
	function validateDescription($inDescription) {
		global $inDescriptionErr;
		$inDescriptionErr="";
		if($inDescription == "") {
			return false;
			$inDescriptionErr="Enter a description";
		}
		return true;
	}
	
	function validatePresenter($inPresenter){
		global  $inPresenterErr;
		$inPresenterErr="";
		if($inPresenter == "") {
			return false;
			$inPresenterErr="Enter presenter";
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

	function validateTime($inTime){
		global  $inTimeErr;
		$inTimeErr="";
		if($inTime == "") {
			return false;
			$inTimeErr="Enter time";
		}
		return true;
	}

	
if(isset($_POST["submitForm"])) {
	
		$inName=$_POST['event_name'];
		$inDescription=$_POST['event_description'];
		$inPresenter=$_POST['event_presenter'];
		$inDate=$_POST['event_date'];
		$inTime=$_POST['event_time'];
		
				
$validForm = true;
		
echo "<br/>Event Name: $inName	<br/>";
echo "Event Description: $inDescription <br/>";
echo "Event Presenter: $inPresenter <br/>";
echo "Event Date: $inDate <br/>";
echo "Event Time: $inTime <br/>";

		
if (!validateName($inName)){
	$validForm = false;
}
if (!validateDescription($inDescription)){
	$validForm = false;
}
if (!validatePresenter($inPresenter)){
	$validForm = false;
}
if (!validateDate($inDate)){
	$validForm=false;
}

if	(!validateTime($inTime)){
	$validForm=false;
}


if($validForm) { 
	$message = "Form is valid";	

	include("connect.php");
	

try {

	$sql="INSERT INTO wdv341_events (event_name, event_description, event_presenter, event_date, event_time) VALUES (:event_name, :event_description, :event_presenter, :event_date, :event_time)";
	
	$stmt = $conn->prepare($sql);
		
	
		$stmt->bindParam(':event_name', $inName);
		$stmt->bindParam(':event_description', $inDescription);
		$stmt->bindParam(':event_presenter', $inPresenter);
		$stmt->bindParam(':event_date', $inDate);
		$stmt->bindParam(':event_time', $inTime);
	
		$stmt->execute();

    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    }

$conn=null;
			
			}
		else {
			$message="Form is invalid";
		}

}

?>





<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>wdv341 | events form</title>
<link href="http://eileenmx.com/css/websitess.css" rel="stylesheet" type="text/css" style="text/css">
        <link href="http://eileenmx.com/css/head.css" rel="stylesheet" type="text/css">
<style>
	.errMsg {
		color: red;
	}
	
	</style>

</head>

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
<h1>WDV321 Advanced JavaScript</h1>
<h2>Events Form</h2>

<?php
	
if($validForm)
	
{
?>
	<h4><?php echo $message; ?></h4>

<?php
}
else
{

?>
	<h4><?php echo $message; ?></h4>


<form name="wdv341_events" method="POST" action="<?php ($_POST['submit'])?>">

	<label for="event_name">Event Name</label>
	<input type="text" name="event_name" value="<?php echo $inName ?>"/>
		<span class="errMsg"> <?php echo $inNameErr; ?></span><br/>
	
	<label for="event_description">Event Description</label>
	<input type="text" name="event_description" value="<?php echo $inDescription ?>"/>
		<span class="errMsg"> <?php echo $inDescriptionErr; ?></span><br/>
	
	<label for="event_presenter">Event Presenter</label>
	<input type="text" name="event_presenter" value="<?php echo $inPresenter ?>"/>
		<span class="errMsg"> <?php echo $inPresenterErr; ?></span><br/>
		
	<label for="event_date">Event Date</label>
	<input type="date" name="event_date" value="<?php echo $inDate ?>"/>
		<span class="errMsg"> <?php echo $inDateErr; ?></span><br/>
		
	<label for="event_time">Event Time</label>
	<input type="time" name="event_time" value="<?php echo $inTime ?>"/>
		<span class="errMsg"> <?php echo $inTimeErr; ?></span><br/>
		
	<input type="submit" name="submitForm" value="submit"/>
	<input type="reset" name="resetForm" value="reset"/>
	
</form>
<?php
}
?>
</div>
  <footer>
	  <p>Write | mcmanuseileen790@gmail.com<br />
	  	
	  	Call | 515.783.8159<br />
	  	Link | <a href="http://www.linkedin.com/in/eileen-mcmanus" target="_blank">linkedin.com/eileen-mcmanus</a></p>
	  </footer>
</body>
</html>