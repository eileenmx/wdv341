
<?php

	
function displayDate($inDate) {
	$inDate=date_create("05-19-1995");
	echo date_format($inDate, "m/d/Y"); //1.
}
	displayDate($inDate);

function displayIntDate($inDate) {
	$inDate=date_create("19-05-1995");
	echo date_format($inDate, "d/m/Y"); //2.
}

	displayIntDate($inDate);

	
	function displayFormattedString($inString) { //3.
		$inString="Eileen  ";
		echo strlen($inString); //3a.
		echo trim($inString); //3b.
		echo strtolower($inString); //3c.
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
