<?php
	require('../../configure.php');
	$vApplicationName = 'Telephone Directory';
	$vShortName = 'teldir';
	require(GLOBAL_FUNC_COMMON);
	
	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_validator.js"></script>'."\r\n";
	require(GLOBAL_INC_HEADER);
	
	require(GLOBAL_DIR_MODULES.$vShortName.'/includes/functions.php');	
	$vApplicationContent = fprvAdd($objDBConn);
	$vSideBar = fprvCreateSideBar($objDBConn, $vShortName);
	
	if (isset($REQUEST['hdnOper']) || $REQUEST['hdnOper']=='TRUE') {		
		$aData['fldFirstName'] = $REQUEST['txtFirstName'];
		$aData['fldLastName'] = $REQUEST['txtLastName'];
		$aData['fldTelephoneNumber'] = $REQUEST['txtTelephoneNumber'];
		$aData['fldEmailAddress'] = $REQUEST['txtEmailAddress'];
		$aData['fldAddedBy'] = $_SESSION['svActiveUserInfo']['fldID'];
		$objDBConn->query_insert("tblteldir", $aData); 
	}
	
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>