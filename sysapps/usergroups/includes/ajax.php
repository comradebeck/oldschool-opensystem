<?php
	require('../../../configure.php');	
	require(GLOBAL_INC_SESSION);
	require(GLOBAL_CLASS_DATABASE);
	$objDBConn = new clsDatabase(GLOBAL_DB_HOST, GLOBAL_DB_USER, GLOBAL_DB_PASS, GLOBAL_DB_NAME);
	$objDBConn->connect();	
	require(GLOBAL_CLASS_INPUTFILTER);
	$objFilter = new clsInputFilter($GLOBAL_FILTER_TAGS, $GLOBAL_FILTER_ATTRIBUTES, 1, 1, 0);	
	$REQUEST = $objFilter->process($_REQUEST);
	
	switch ($REQUEST['vOper']) {
		case 'Delete':
			$vSQL = "DELETE FROM  
						tbluseraccounts
					WHERE 
						tbluseraccounts.fldID = " . $REQUEST['vID'] . " 
					LIMIT 
						1";					
			$objDBConn->query($vSQL);
			if ($objDBConn->affected_rows > 0) {
				echo TRUE;
			}
			break;
	}
?>