<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>wdv341 | php basics</title>
</head>

<body>

<?php 
	$yourName="<h1>Eileen</h1>" //1 & 2.create variable yourName & display in h1
		?>
		
<h2><?php echo $yourName ?></h2> <!--3. display yourName in h2-->

<?php						//4. create following variables
		$number1=22;
		$number2=2;
		$total=$number1 + $number2;	//5. display value of each in the total when added
echo $total;
	
		?>
		
	<?php
		//var javaScriptArray=["PHP", "HTML", "JavaScript"]; //6. create an array
	
		echo "'PHP', 'HTML', 'JavaScript'";
	?>
	
<script>
		var javaScriptArray=[<?php echo "'PHP', 'HTML', 'JavaScript'";?>]; //6. create an array

	</script>
		

	

</body>
</html>