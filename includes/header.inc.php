<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php	
	require(GLOBAL_INC_SESSION);
	$vHeaderNavigation = fpubCreateNavigation();
	
	require(GLOBAL_CLASS_DATABASE);
	$objDBConn = new clsDatabase(GLOBAL_DB_HOST, GLOBAL_DB_USER, GLOBAL_DB_PASS, GLOBAL_DB_NAME);
	$objDBConn->connect();
	
	require(GLOBAL_CLASS_INPUTFILTER);
	$objFilter = new clsInputFilter($GLOBAL_FILTER_TAGS, $GLOBAL_FILTER_ATTRIBUTES, 1, 1, 0);	
	$REQUEST = $objFilter->process($_REQUEST);
	
	require(GLOBAL_TPL_HEADER);
?>