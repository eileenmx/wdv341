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
				$message = "Welcome Back: ".$userRow['ff_username']."!";
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
<title>Furry Foster Login</title>
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
	<h2><?php echo $message?></h2>
</div>
<div class="main">


<?php
	if ($_SESSION['validUser'] == "yes")
	{
?>
		<h3>Administrator Options</h3>
        <p><a href="ff-insert.php">Add a new dog</a></p>
        <p><a href="ff-select.php">Show current foster dogs</a></p>
        <p><a href="ff-logout.php">Logout</a></p>	
        					
<?php
	} else	{		
?>
		
			<h3>Please login to the Furry Foster's Administrator System</h3>
                <form method="post" name="loginForm" action="ff-login.php" >
                  <p>Username: <input name="loginUsername" type="text" /></p>
                  <p>Password: <input name="loginPassword" type="password" /></p>
                  <p><input name="submitLogin" value="Login" type="submit" /> <input name="" type="reset" />&nbsp;</p>
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