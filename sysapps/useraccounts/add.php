<?php
	require('../../configure.php');
	$vApplicationName = 'User Accounts - Add';
	$vShortName = 'useraccounts';
	require(GLOBAL_FUNC_COMMON);
	
	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_validator.js"></script>'."\r\n";
	require(GLOBAL_INC_HEADER);
	
	require(GLOBAL_DIR_SYSTEMS.$vShortName.'/includes/functions.php');	
	$vApplicationContent = fprvAdd();
	$vSideBar = fpubCreateSideBar($objDBConn, $vShortName);
	if (!fpubCheckDuplicate('tbluseraccounts', 'fldUserGroupID',$REQUEST['txtUserGroupID'])) {
			$vAppMsg = fprvUpdateDatabase('Add');	
		} else {
			$vAppMsg = 'The Username ['.$REQUEST['txtUsername'].'] already exist. Please try again...';
		}
		

	
	
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>