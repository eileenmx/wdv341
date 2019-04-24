<?php 
session_cache_limiter('none');			//prevents chrome error when using the back button to return to this page.
session_start();
 
	if (isset($_SESSION['validUser']) && $_SERVER['validUser'] == "yes")
	{
		$message = "Welcome Back! " . $_SESSION['userName'];
	} else {
		if (isset($_POST['submitLogin']) ) {
			$inUsername = $_POST['loginUsername'];
			$inPassword = $_POST['loginPassword'];

				
include("connect.php");

try {
	$sql = "SELECT presenters_username, presenters_password FROM presenters
	 WHERE presenters_id = 1";
					
			
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
				$_SESSION['userName']=$userRow['presenters_username'];
				$message = "Welcome Back! ".$userRow['presenters_username'];
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
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>wdv341 | login</title>
<link href="http://eileenmx.com/css/websitess.css" rel="stylesheet" type="text/css" style="text/css">
<link href="http://eileenmx.com/css/head.css" rel="stylesheet" type="text/css">
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
<h1>WDV341 Intro PHP</h1>
<h2>Login page</h2>

<h3><?php echo $message?></h3>

<?php
	if ($_SESSION['validUser'] == "yes")
	{
?>
		<h4>Administrator Options</h4>
        <p><a href="eventsForm.php">Add a new event</a></p>
        <p><a href="selectEvents.php">Show a list of events</a></p>
        <p><a href="logout.php">Logout</a></p>	
        					
<?php
	} else	{		
?>
			<h3>Please login to the Administrator System</h3>
                <form method="post" name="loginForm" action="login.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
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