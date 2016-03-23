<?php
	require('../../configure.php');
	$vApplicationName = 'Telephone Directory';
	$vShortName = 'teldir';
	require(GLOBAL_FUNC_COMMON);

	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_tables.js"></script>'."\r\n";
	$vJavaScripts .= '<script type="text/javascript" src="'.GLOBAL_URL_MODULES.$vShortName.'/javascripts/functions.js"></script>'."\r\n";	
	require(GLOBAL_INC_HEADER);

	require(GLOBAL_DIR_MODULES.$vShortName.'/includes/functions.php');	
	$vApplicationContent = fprvIndex($objDBConn);
	$vSideBar = fprvCreateSideBar($objDBConn, $vShortName);
	
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>