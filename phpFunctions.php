
<?php
	
	$date=date_create("05-19-1995");
	echo date_format($date, "mm/dd/Y"); //1.
	
	?>
	
	<?php 
	$date=date_create("19-05-1995");
	echo date_format($date, "dd/mm/Y"); //2.
	
	?>
	
	<?php
	
	function displayFormattedString($inString) { //3.
		echo strlen($inString); //3a.
		echo trim($inString); //3b.
		echo strtolower($iinString); //3c.
	}
	
	displayFormattedString($inString);
	
	function displayFormattedNumber($inNumber) { //4. 
		$inNumber="1234567890";
		echo $inNumber;
	}
	
	displayFormattedNumber($inNumber);
	
	function displayFormattedCurrency($inCurrency) { //5.
		$inCurrency="123456";
		setlocale(LC_MONETARY, "en-US");
		echo money_format("%i", $inCurrency);
	}
	
	displayFormattedCurrency($inCurrency);
	
	?>
