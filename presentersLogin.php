<?php 
session_cache_limiter('none');			//This prevents a Chrome error when using the back button to return to this page.
session_start();
 
	if (isset($_SESSION['validUser']) && $_SERVER['validUser'] == "yes")				//is this already a valid user?
	{
		//User is already signed on.  Skip the rest.
		$message = "Welcome Back! " . $_SESSION['userName'];
	} else {
		if (isset($_POST['submitLogin']) ) {
			$inUsername = $_POST['loginUsername'];	//pull the username from the form
			$inPassword = $_POST['loginPassword'];	//pull the password from the form

				
include("connect.php");

try {
	$sql = "SELECT presenters_username, presenters_password FROM presenters
	 WHERE presenters_username = 1 AND presenters_password = 1";
					
			
			$query = $conn->prepare($sql);
			//or die("<p>SQL String: $sql</p>");	//prepare the query
			
			$query->bindValue(1,$inUsername, PDO::PARAM_STR);
			$query->bindValue(2, $inPassword, PDO::PARAM_STR);	//bind parameters to prepared statement
		
			$query->execute();
				//or die("<p>Execution </p>" );
					//echo "done executing";
				
			$userRow=$query->fetch(PDO::FETCH_ASSOC);
	
	
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
			
			
			if ($userRow != "" )		//If this is a valid user there should be ONE row only
			{
				$_SESSION['validUser'] = "yes";				//this is a valid user so set your SESSION variable
				$_SESSION['userName']=$userRow['presenters_username'];
				$message = "Welcome Back!" .$userRow;
				//Valid User can do the following things:
			}
			else
			{
				//error in processing login.  Logon Not Found...
				$_SESSION['validUser'] = "no";					
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}			
			
			$query=null;
			$conn=null;
		
			}	//end if submitted
	
		else {
			//$message="<br/>--Else message reopens form--<br/>";
			//user needs to see form
		}//end else submitted
		
	}//end else valid user

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV341 Intro PHP - Login and Control Page</title>

<!--  User Login Page
            
if user is valid (Session)
	display admin options
else
    if submit
        Get input from $_POST
        Create SELECT QUERY
        Run SELECT to determine if they are valid username/password
        if user if valid
            set Session variable to true
            display admin options
        else
            display error message
            display login form
    else
    display login form
         
-->
</head>

<body>

<h1>WDV341 Intro PHP</h1>

<h2>Presenters Admin System Example</h2>

<h2><?php echo $message?></h2>

<?php
	if ($_SESSION['validUser'] == "yes")	//This is a valid user.  Show them the Administrator Page
	{
		

?>
		<h3>Presenters Administrator Options</h3>
        <p><a href="eventsForm.php">Input New Presenter</a></p>
        <p><a href="selectEvents.php">List of Presenters</a></p>
        <p><a href="presentersLogout.php">Logout of Presenters Admin System</a></p>	
        					
<?php
	} else	{		
?>
			<h2>Please login to the Administrator System</h2>
                <form method="post" name="loginForm" action="presentersLogin.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
                </form>
                
<?php
	}//end of checking for a valid user
			
		
?>

<p>Return to <a href='#'>www.presentationstogo.com</a></p>

</body>
</html>