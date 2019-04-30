<?php
	class emailer {
		private $senderAddress;
		private $toAddress;
		private $subject;
		private $message;
		
		function __construct(){
		
		}
		
		function setSender($new_sender) { 
			$this->senderAddress = $new_sender;  
 		}
 
   		function getSender() {
			return $this->senderAddress;
		}
		
		function setTo($new_to) { 
			$this->toAddress = $new_to;  
 		}
 
   		function getTo() {
			return $this->toAddress;
		}
				
		function setSubject($new_subject) { 
			$this->subject = $new_subject;  
 		}
 
   		function getSubject() {
			return $this->subject;
		}
				
		function setMessage($new_message) { 
			$this->message = $new_message;  
 		}
 
   		function getMessage() {
			return $this->message;
		}
		
		function sendMessage(){
		$headers = "From: ".$this->getSender() . "\r\n"; 
		return mail($this->getTo(),$this->getSubject(),$this->getMessage(),$headers);
		}
				
	
	}
?>