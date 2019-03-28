<?php

$inName="";
$inPhone="";
$inEmail="";
$inRegistration="";
$inBadge="";
$inMeals="";
$inComment="";

$inNameErr="";
$inPhoneErr="";
$inEmailErr="";
$inRegistration="";
$inBadgeErrr="";
$inMealsErr="";
$inCommentErr="";

$validForm = false;
	
	

if(isset($_POST["submitForm"]))
{
	$inName="name";
	$inPhone="phone";
	$inEmail="email";
	$inRegistration="registration";
	$inBadge="badge";
	$inMeals="meals";
	$inComment="comment";
	
	function validateName($inName) {
		global $validForm, $inNameErr;
				$inNameErr = "";
				
				if($inName == "")
				{
					$validForm = false;
					$inNameErr = "Name cannot be spaces";
				}
			}//end validateName()
	}

function validatePhone($inPhone) {
	global $validForm, $inPhoneErr;
	$inPhoneErr="";
	
	$inPhone=filter_var($inPhone, FILTER_SANITIZE_);
	$inPhone=filter_var($inPhone, FILTER_VALIDATE_);
	
	if($inPhone === false) {
		$validForm=false;
		$inPhoneErr="Invalid phone number";
	}
}

function validateEmail($inEmail)
			{
				global $validForm, $inEmailErr;	
				$inEmailErr = "";	
				
				// Remove all illegal characters from email
				$inEmail = filter_var($inEmail, FILTER_SANITIZE_EMAIL);

				// Validate e-mail
				$inEmail = filter_var($inEmail, FILTER_VALIDATE_EMAIL);

				if($inEmail === false)
				{
					$validForm = false;
					$inEmailErr = "Invalid email"; 					
				}
			}

function validateRegistration($inRegistration) {
	global $validRegistration, $inRegistrationErr;
	$inRegistrationErr="";
	
	if($inRegistration == "") {
		$validForm=false;
		$inRegistrationErr="You must select an option";
	}
}

function validateBadge($inBadge) {
	global $validBadge, $inBadgeErr;
	$inBadgeErr="";
	
	if ($inBadge == "") {
		$validForm=false;
		$inBadgeErr="You must select one.";
	}
}

function validateMeals($inMeals){
	global $validMeals, $inMealsErr;
	$inMealsErr="";
	
	if ($inMeals == "") {
		$validForm=false;
		$inMealsErr="You must check at least one box.";
	}
}

function validateComment($inComment){
	global $validComment, $inCommentErr;
	$inCommentErr="";
}

$validForm = true;

validateName($inName);
validatePhone($inPhone);
validateEmail($inEmail);
validateRegistration($inRegistration);
validateBadge($inBadge);
validateMeals($inMeals);
validateComment($inComment);
	
if($validForm) { 
	$message = "Form is valid";	
			try {
				require 'database/connectPDO.php';

				$todaysDate = date("Y-m-d");
				
				//Create the SQL command string
				$sql = "INSERT INTO pit_presenters (";
				$sql .= "senderName, ";
				$sql .= "senderPhone, ";
				$sql .= "senderEmail, ";
				$sql .= "senderRegistration, ";
				$sql .="senderBadge, ";
				$sql .="senderMeals, ";
				$sql .="senderComment, ";
				$sql .= "senderDateAdded "; //Last column does NOT have a comma after it.
				$sql .= ") VALUES (:name, :phone, :email, :registration,:dateAdded)";
				
				//PREPARE the SQL statement
				$stmt = $conn->prepare($sql);
				
				//BIND the values to the input parameters of the prepared statement
				$stmt->bindParam(':name', $inName);
				$stmt->bindParam(':phone', $inPhone);		
				$stmt->bindParam(':email', $inEmail);	
				$stmt->bindParam(':registration', $inRegistration);	
				$stmt->bindParam(':badge', $inBadge);
				$stmt->bindParam(':meals', $inMeals);
				$stmt->bindParam(':comment', $inComment);
				$stmt->bindParam(':dateAdded', $todaysDate);	

				$stmt->execute();	
				
				$message = "The sender has registered.";
			}
			
			catch(PDOException $e)
			{
				$message = "There has been a problem. The system administrator has been contacted. Please try again later.";
	
				error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
				error_log(var_dump(debug_backtrace()));
			
				//Clean up any variables or connections that have been left hanging by this error.		
			
				header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
			}

	
} else {
			$message = "Something went wrong";
}
 ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>wdv341 | self posting form</title>
 <link href="../../css/websitess.css" rel="stylesheet" type="text/css" style="text/css">
        <link href="../../css/head.css" rel="stylesheet" type="text/css"> <!--head & navbar-->
      
<style>

#orderArea	{
	width:600px;
	border:thin solid black;
	margin: auto auto;
	padding-left: 20px;
}

#orderArea h3	{
	text-align:center;	
}
.error	{
	color:red;
	font-style:italic;	
}

</style>
</head>

<body>

<div class="head">
	<h1><a href="../../index.html">Eileen<br />McManus</a></h1>
	<ul>
	<li><a href="../../about.html">about</a></li>
	<li><a href="../../portfolio.html">portfolio</a></li>
	<li><a href="../../hw/hw.html">homework</a></li>
	</ul>
</div>	
<div id="main-single">
<h1>WDV341 Intro PHP</h1>
<h2>Unit 5 | Self Posting Form & Unit 6 | Form Validation Assignment
</h2>
<p>&nbsp;</p>
<?php
if(isset($_POST["submitForm"]))
{
?>
	<h4><?php echo $message; ?></h4>

<?php
}
else
{
	//Display the following lines if the page is called from a link. 
	//The user has not seen the form yet and needs to see the form.
	//This will display the form, allow the user to enter data, then submit the form
?>
	<h4><?php echo $message; ?></h4>

<div id="orderArea">
<form name="form3" method="post" action="">
  <h3>Customer Registration Form</h3>

      <p>
        <label for="textfield">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $inName; ?>">
        <span class="errMsg"> <?php echo $inNameErr; ?></span>
      </p>
      <p>
        <label for="textfield2">Phone Number:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $inPhone; ?>">
        <span class="errMsg"> <?php echo $inPhoneErr; ?></span>
      </p>
      <p>
        <label for="textfield3">Email Address: </label>
        <input type="text" name="email" id="email" value="<?php echo $inEmail; ?>">
        <span class="errMsg"> <?php echo $inEmailErr; ?></span>
      </p>
      <p>
        <label for="select">Registration: </label>
        <select name="registration" id="registration" value="<?php echo $inRegistration; ?>">
          <option value="">Choose Type</option>
          <option value="evt01">Attendee</option>
          <option value="evt02">Presenter</option>
          <option value="evt03">Volunteer</option>
          <option value="evt04">Guest</option>
        </select>
        <span class="errMsg"> <?php echo $inRegistrationErr; ?></span>
      </p>
      <p>Badge Holder:</p>
      <p>
        <input type="radio" name="badge" id="radio" value="clip">
        <label for="clip">Clip</label> <br>
        <input type="radio" name="badge" id="radio2" value="lanyard">
        <label for="lanyard">Lanyard</label> <br>
        <input type="radio" name="badge" id="radio3" value="magnet">
        <label for="magnet">Magnet</label>
        <span class="errMsg"> <?php echo $inBadgeErr; ?></span>
      </p>
      <p>Provided Meals (Select all that apply):</p>
      <p>
        <input type="checkbox" name="meals" <?php if (isset($meals) && $meals=="friday") echo "checked";?>
        id="friday">
        <label for="friday">Friday Dinner</label><br>
        <input type="checkbox" name="meals" <?php if (isset($meals) && $meals=="saturday") echo "checked";?>
        id="saturday">
        <label for="saturday">Saturday Lunch</label><br>
        <input type="checkbox" name="meals" <?php if (isset($meals) && $meals=="sunday") echo "checked";?>
        id="sunday">
        <label for="sunday">Sunday Award Brunch</label>
        <span class="errMsg"> <?php echo $inMealsErr; ?></span>
      </p>
      <p>
        <label for="textarea">Special Requests/Requirements: (Limit 200 characters)<br>
        </label>
        <textarea name="comment" cols="40" rows="5" id="comment"></textarea>
        <span class="errMsg"> <?php echo $inCommentErr; ?></span>
      </p>
   
  <p>
    <input type="submit" name="submitForm" id="submitForm" value="Submit">
    <input type="reset" name="reset" id="button4" value="Reset">
  </p>
</form>

</div>
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