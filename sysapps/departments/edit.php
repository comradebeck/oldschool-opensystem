<?php
	require('../../configure.php');
	$vApplicationName = 'Departments - Edit';
	$vShortName = 'departments';
	require(GLOBAL_FUNC_COMMON);
	
	$vJavaScripts = '<script type="text/javascript" src="'.GLOBAL_URL_JAVASCRIPTS.'tigra_validator.js"></script>'."\r\n";
	require(GLOBAL_INC_HEADER);
	
	require(GLOBAL_DIR_SYSTEMS.$vShortName.'/includes/functions.php');
	$vApplicationContent = fprvEdit($REQUEST['vID']);
	$vSideBar = fpubCreateSideBar($objDBConn, $vShortName);
	
	if (isset($REQUEST['hdnOper']) || $REQUEST['hdnOper']=='TRUE') {
		if ($REQUEST['hdnDepartmentName']==$REQUEST['txtDepartmentName']) {
			$vAppMsg = fprvUpdateDatabase('Edit');
			header('Location: index.php');
		} else {
			if (!fpubCheckDuplicate('tbluseraccounts_departments','fldDepartmentName',$REQUEST['txtDepartmentName'])) {
				$vAppMsg = fprvUpdateDatabase('Edit');
				header('Location: index.php');
			} else {
				$vAppMsg = 'The department ['.$REQUEST['txtDepartmentName'].'] already exist. Please try again...';
			}
		}
	}
		
	require(GLOBAL_INC_MAIN);
	require(GLOBAL_INC_FOOTER);
?>