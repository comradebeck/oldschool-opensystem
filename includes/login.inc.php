<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php 		
	session_start();
	$vApplicationName = 'Login Area';
	
		$vRegAction = trim($REQUEST['action']);
		$vRegUsername = $REQUEST['txtUsername'];
		$vRegPassword = $REQUEST['txtPassword'];	
		
		switch($vRegAction) {
			case 'logout':
				unset($_SESSION);
				session_destroy();
				header('Location: '.GLOBAL_URL_LOGIN);
				die();
				break;
			case 'login':
			default:
				if ($_SESSION[GLOBAL_SESSION_KEY] == GLOBAL_SESSION_VALUE) { 
					header('Location: '.GLOBAL_URL_DASHBOARD); 
					die(); 
				}
				if ($vRegUsername!='' AND $vRegPassword!='') {
					$vLoginErrors = fpubValidateLogin($objDBConn, $vRegUsername, $vRegPassword);
					$vMessage = $vLoginErrors;
					if ($vLoginErrors === TRUE) {
						$_SESSION[GLOBAL_SESSION_KEY] = GLOBAL_SESSION_VALUE;
						header('Location: '.GLOBAL_URL_DASHBOARD); 
						die;
					}
				}
		}
		
	
	
	
	
	require(GLOBAL_TPL_LOGIN);
?>