<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php
	function fpubVarDump($vVariable) {
		echo '<pre>';
		var_dump($vVariable);
		echo '</pre>';
	}

	function fpubValidateLogin($vConn, $vUsername, $vPassword) {
		global $GLOBAL_FILTER_TAGS, $GLOBAL_FILTER_ATTRIBUTES;
		$vInputs = new clsInputFilter($GLOBAL_FILTER_TAGS, $GLOBAL_FILTER_ATTRIBUTES, 1, 1, 0);
		$vUsername = $vInputs->process($vUsername);
		$vPassword = $vInputs->process($vPassword);
		$vLoginError = fpubVerifyAccess($vConn, $vUsername, $vPassword);
		return $vLoginError;
	}

	function fpubVerifyAccess($vConn, $vUsername, $vPassword) {
		$vSQL = "SELECT 
					tbluseraccounts.fldID, 
					tbluseraccounts.fldUserGroupID, 
					tbluseraccounts.fldUserDetailsID, 
					tbluseraccounts.fldUsername, 
					tbluseraccounts.fldPassword, 
					tbluseraccounts_details.fldFirstName, 
					tbluseraccounts_details.fldLastName 
				FROM 
					tbluseraccounts, 
					tbluseraccounts_details 
				WHERE 
					(tbluseraccounts.fldUsername = '" . $vUsername . "' AND 
					tbluseraccounts.fldPassword = '" . $vPassword . "') AND 
					tbluseraccounts.fldUserDetailsID = tbluseraccounts.fldID AND 
					tbluseraccounts.fldActive = 1 
				LIMIT 
					1";
		$vRecord = $vConn->query_first($vSQL);
		if ($vConn->affected_rows > 0) {
			return fpubCreateSession($vConn, $vRecord);
		} else {
			return 'Access denied. The username or password you entered is incorrect. Please try again.';
		}
	}

	function fpubCreateSession($vConn, $vRecord) {
		$_SESSION[GLOBAL_SESSION_USERINFOS] = $vRecord;
		$vSQL = "SELECT 
					tblapplications_permissions.fldApplicationID, 
					tblapplications.fldApplicationName, 
					tblapplications.fldShortName, 
					tblapplications.fldHiddenSetting, 
					tblapplications.fldParentID, 
					tblapplications.fldSysApp, 
					tblapplications.fldID 
				FROM 
					tblapplications_permissions, 
					tblapplications 
				WHERE 
					tblapplications_permissions.fldApplicationID = tblapplications.fldID AND 
					tblapplications.fldActive = 1 AND 
					tblapplications_permissions.fldActive = 1 AND 
					(tblapplications_permissions.fldUserGroupID=".$_SESSION[GLOBAL_SESSION_USERINFOS]['fldUserGroupID']." OR 
					tblapplications_permissions.fldUserAccountID=".$_SESSION[GLOBAL_SESSION_USERINFOS]['fldID'].") 
				ORDER BY 
					tblapplications.fldPosition 
				ASC";
		$vRows = $vConn->query($vSQL);
		if ($vConn->affected_rows > 0) {
			unset($_SESSION[GLOBAL_SESSION_USERGRANTS]);
			while($vRow = $vConn->fetch_array($vRows)) {
				$_SESSION[GLOBAL_SESSION_USERGRANTS][] = $vRow;
			}
			return TRUE;
		} else {
			return 'You have no active user permissions. Contact your system administrator.';
		}
	}

	function fpubCheckApplicationPermission($vShortName='') {
		if ($vShortName=='') return FALSE;
		if ($_SESSION[GLOBAL_SESSION_USERGRANTS]) {
			foreach ($_SESSION[GLOBAL_SESSION_USERGRANTS] as $vKey => $aLoopModules) {
				if ($aLoopModules['fldShortName']==$vShortName) {
					return TRUE;
				}
			}
		}
		return FALSE;
	}

	function fpubCreateNavigation() {
		$vNavigation = '';
		if (isset($_SESSION[GLOBAL_SESSION_USERGRANTS])) {
			foreach ($_SESSION[GLOBAL_SESSION_USERGRANTS] as $vKey => $vValue) {
				if ($vValue['fldParentID']==0) {
					if ($vValue['fldSysApp']==1) {
						$vPath =  GLOBAL_URL_SYSTEMS.$vValue['fldShortName'];
					} else {
						$vPath =  GLOBAL_URL_MODULES.$vValue['fldShortName'];
					}
					$vNavigation .= '<td class="tdNavIcon"><a href="'.$vPath.'" title="'.$vValue['fldApplicationName'].'"><img src="'.$vPath.'/images/imgNavIcon.png" /></a></td>' . "\r\n";
				}
			}
		}
		return $vNavigation;
	}

	function fpubCreateSideBar($vConn, $vShortName) {
		$vAppInfo = fpubGetParentAppID($vConn, $vShortName);
		$vSQL = "SELECT 
					tblapplications.fldID, 
					tblapplications.fldApplicationName, 
					tblapplications.fldShortName 
				FROM 
					tblapplications 
				WHERE 
					tblapplications.fldActive = 1 AND 
					tblapplications.fldParentID = ".$vAppInfo['fldID']." 
				ORDER BY 
					tblapplications.fldPosition
				ASC;";
		$vOutput = '
			<div class="divMenuBox">
				<div class="divMenuBox_Title" style="padding-top:2px; position:static"><span style="vertical-align:middle">'.$vAppInfo['fldApplicationName'].' Menu</span></div>
				<div class="divMenuBox_Items"><span class="spanMenuBox_Items"><a href="index.php">Home</a></span></div>';
		$vRows = $vConn->query($vSQL);
		while ($vRecord = $vConn->fetch_array($vRows)) {
			$vOutput .= '<div class="divMenuBox_Items"><span class="spanMenuBox_Items"><a href="'.$vRecord['fldShortName'].'">'.$vRecord['fldApplicationName'].'</a></span></div>';
		}
		$vOutput .= '
			</div>';
		return $vOutput;
	}

	function fpubGetParentAppID($vConn, $vShortName) {
		$vSQL = "SELECT 
					tblapplications.fldID, 
					tblapplications.fldApplicationName 
				FROM 
					tblapplications 
				WHERE 
					tblapplications.fldShortName = '".$vShortName."' 
				LIMIT 
					1";
		$vRecord = $vConn->query_first($vSQL);
		return $vRecord;
	}
	
	function fpubGetAddedBy($vID) {
		global $objDBConn;
		$vSQL = "SELECT 
					tbluseraccounts.fldUsername 
				FROM 
					tbluseraccounts 
				WHERE
					tbluseraccounts.fldID = ".$vID."
				LIMIT
					1;";
		$vRecord = $objDBConn->query_first($vSQL);
		return $vRecord['fldUsername'];
	}
	
	function fpubCheckDuplicate($vTable, $vField, $vString) {
		global $objDBConn;
		$vSQL = "SELECT
					".$vTable.".fldID
				FROM 
					".$vTable." 
				WHERE 
					".$vTable.".".$vField." = '".$vString."'
				LIMIT
					1;";
		$objDBConn->query($vSQL); 		
		if($objDBConn->affected_rows>0) { return TRUE; } else { return FALSE; }
	}
?>