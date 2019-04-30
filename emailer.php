<?php
include("emailerClass.php");
$testEmail = new emailer();
$testEmail->setSender("eileenmx@eileenmx.com");
$testEmail->setTo("mcmanuseileen790@gmail.com");
$testEmail->setSubject("Testing 123");
$testEmail->setMessage("Hi.");
if ($testEmail->sendMessage()){
  echo "Sent <br />";
} else {
  echo "Failure to send <br />";
}

$clientEmail = new emailer();
$clientEmail->setSender("eileenmx@eileenmx.com");
$clientEmail->setTo("mcmanuseileen790@gmail.com");
$clientEmail->setSubject("Testing 123");
$clientEmail->setMessage("Hi.");

if ($clientEmail->sendMessage()){
  echo "Sent <br />";
} else {
  echo "Failure to send <br />";
}
?>

<p>Sender Name: <?php echo $testEmail->getSender();?></p>
<p>To Name: <?php echo $testEmail->getTo();?></p>
<p>Subject: <?php echo $testEmail->getSubject();?></p>
<p>Message: <?php echo $testEmail->getMessage();?></p>