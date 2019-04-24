<?php
session_start();

$_SESSION['validUser']='no';
session_unset();
session_destroy();

header('Location: login.php');


?>