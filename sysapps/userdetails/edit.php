<?php
	require('../../configure.php');
	$vApplicationName = 'User Details - Edit';
	$vShortName = 'userdetails';
	require(GLOBAL_FUNC_COMMON);
	
	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_validator.js"></script>'."\r\n";
	require(GLOBAL_INC_HEADER);
	
	require(GLOBAL_DIR_SYSTEMS.$vShortName.'/includes/functions.php');
	$vApplicationContent = fprvEdit($REQUEST['vID']);
	$vSideBar = fpubCreateSideBar($objDBConn, $vShortName);
	
	if (isset($REQUEST['hdnOper']) || $REQUEST['hdnOper']=='TRUE') {
		$vAppMsg = fprvUpdateDatabase('Edit');
		header('Location: index.php');
	}
	
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>