<?php
	require('../../configure.php');
	$vApplicationName = 'User Groups - Add';
	$vShortName = 'usergroups';
	require(GLOBAL_FUNC_COMMON);
	
	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_validator.js"></script>'."\r\n";
	require(GLOBAL_INC_HEADER);
	
	require(GLOBAL_DIR_SYSTEMS.$vShortName.'/includes/functions.php');	
	$vApplicationContent = fprvAdd();
	$vSideBar = fpubCreateSideBar($objDBConn, $vShortName);
	
	if (isset($REQUEST['hdnOper']) || $REQUEST['hdnOper']=='TRUE') {		
		$aData['fldUserGroupName'] = $REQUEST['txtUserGroupName'];
		$aData['fldDescription'] = $REQUEST['txtDescription'];
		$aData['fldAddedBy'] = $_SESSION['svActiveUserInfo']['fldID'];
		$objDBConn->query_insert("tbluseraccounts_groups", $aData); 
	}
	
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>