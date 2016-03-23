<?php
	require('../../configure.php');
	$vApplicationName = 'User Groups';
	$vShortName = 'usergroups';
	require(GLOBAL_FUNC_COMMON);
	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_tables.js"></script>'."\r\n";
	$vJavaScripts .= '<script type="text/javascript" src="'.GLOBAL_URL_SYSTEMS.$vShortName.'/javascripts/functions.js"></script>'."\r\n";
	require(GLOBAL_INC_HEADER);	
	require(GLOBAL_DIR_SYSTEMS.$vShortName.'/includes/functions.php');	

	$vApplicationContent = fprvIndex();
	$vSideBar = fpubCreateSideBar($objDBConn, $vShortName);
	
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>