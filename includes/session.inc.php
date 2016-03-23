<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php
	session_start();
	if ($_SESSION[GLOBAL_SESSION_KEY] != GLOBAL_SESSION_VALUE) {		
		header('Location: '.GLOBAL_URL_LOGIN);
		die();
	}
		
	// STORE GLOBAL USED VARIABLES
	$_SYSTEM['svUserInfo']['svUserID'] = $_SESSION['svActiveUserInfo']['fldID'];
	$_SYSTEM['svUserInfo']['svUserName'] = $_SESSION['svActiveUserInfo']['fldUsername'];
	$_SYSTEM['svUserInfo']['svUserGroupID'] = $_SESSION['svActiveUserInfo']['fldUserGroupID'];
?>