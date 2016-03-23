<?php
	require('../../configure.php');
	$vApplicationName = 'Departments - Add';
	$vShortName = 'departments';
	require(GLOBAL_FUNC_COMMON);
	
	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_validator.js"></script>'."\r\n";
	require(GLOBAL_INC_HEADER);
	
	require(GLOBAL_DIR_SYSTEMS.$vShortName.'/includes/functions.php');	
	$vApplicationContent = fprvAdd();
	$vSideBar = fpubCreateSideBar($objDBConn, $vShortName);
	
	if (isset($REQUEST['hdnOper']) || $REQUEST['hdnOper']=='TRUE') {		
		if (!fpubCheckDuplicate('tbluseraccounts_departments', 'fldDepartmentName',$REQUEST['txtDepartmentName'])) {
			$vAppMsg = fprvUpdateDatabase('Add');	
		} else {
			$vAppMsg = 'The department ['.$REQUEST['txtDepartmentName'].'] already exist. Please try again...';
		}
		
	}
	
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>