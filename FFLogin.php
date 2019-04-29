<?php 
session_cache_limiter('none');
session_start();
 
	if (isset($_SESSION['validUser']) && $_SERVER['validUser'] == "yes")
	{
		$message = "Welcome Back! " . $_SESSION['userName'];
	} else {
		if (isset($_POST['submitLogin']) ) {
			$inUsername = $_POST['loginUsername'];
			$inPassword = $_POST['loginPassword'];

				
include("../wdv341/connect.php");

try {
	$sql = "SELECT ff_username, ff_password FROM FF_login WHERE ff_id = 1";			
			
			$query = $conn->prepare($sql);
			
			$query->bindValue(1,$inUsername, PDO::PARAM_STR);
			$query->bindValue(2, $inPassword, PDO::PARAM_STR);
		
			$query->execute();
				
			$userRow=$query->fetch(PDO::FETCH_ASSOC);
	
    //echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
			
			
			if ($userRow != "" )	
			{
				$_SESSION['validUser'] = "yes";
				$_SESSION['userName']=$userRow['ff_username'];
				$message = "Welcome Back! ".$userRow['ff_username'];
			} else {
				$_SESSION['validUser'] = "no";					
				$message = "Sorry, there was a problem with your username or password. Please try again.";
			}			
			
			$query=null;
			$conn=null;
		
			}	
	
		else {
			
		}
		
	}

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
<h3><?php echo $message?></h3>

<?php
	if ($_SESSION['validUser'] == "yes")
	{
?>
		<h4>Administrator Options</h4>
        <p><a href="ff-form.php">Add a new *CONTENT*</a></p>
        <p><a href="ff-select.php">Show a list of *CONTENT*</a></p>
        <p><a href="ff-logout.php">Logout</a></p>	
        					
<?php
	} else	{		
?>
			<h3>Please login to the Administrator System</h3>
                <form method="post" name="loginForm" action="ff-login.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
                </form>
                
<?php
	}	
?>
</body>
</html>