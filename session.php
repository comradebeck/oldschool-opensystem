<?php
	require('configure.php');
	session_start();
	echo $_SESSION[GLOBAL_SESSION_USERGRANTS];
?>