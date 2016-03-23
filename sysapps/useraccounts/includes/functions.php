<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>

<?php
	$aTable = array('tbluseraccounts',
					'tbluseraccounts_details',
					'tbluseraccounts_groups');
	
	$aField = array('FirstName',
					'LastName',
					'UserGroupName',
					'Username',
					'Password',
					'UserGroupID',
					'UserDetailsID');

	$aDescs = array('First Name',
					'Last Name',
					'Group Name',
					'Username',
					'Password');
	function fprvIndex() {
		global $aTable, $aField, $aDescs;
		$vSQL = "SELECT 
					".$aTable[0].".*, 
					".$aTable[1].".fldFirstName, 
					".$aTable[1].".fldLastName, 
					".$aTable[2].".fldUserGroupName  
				FROM "
					.fprvListTables()." 
				WHERE 
					".$aTable[0].".fld".$aField[6]." = ".$aTable[1].".fldID AND
					".$aTable[0].".fld".$aField[6]." = ".$aTable[1].".fldID AND 
					".$aTable[0].".fld".$aField[5]." = ".$aTable[2].".fldID 
				ORDER BY 
					".$aTable[0].".fldID 
				ASC;";
		$vOutput = '<table cellpadding="0" cellspacing="0" border="1" id="idListView">
				<thead>
					<tr>
						<td><strong>ID</strong></td>
						'.fprvListHeaders().'
						<td><strong>Date & Time Added</strong></td>
						<td><strong>Added By</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Controls</strong></td>
					</tr>
				</thead>
				<tbody>'.fprvListView($vSQL).'</tbody>
			</table>

			<script type="text/javascript">
				tigra_tables(\'idListView\', 1, 0, \'#ffffff\', \'#F1F1F1\', \'#ccccff\', \'#cc99ff\'); 
			</script>';
		return $vOutput;
	}

	function fprvAdd() {
		global $aTable, $aField, $aDescs, $aRecord;
		$vOutput = '<form name="frmAddForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return tigra_validator.exec()">
						<table cellpadding="0" cellspacing="0" border="1">
							<tr>
								<td><label for="id'.$aField[6].'" id="id'.$aField[6].'_label">Account Owner</label></td>
								<td>
									<select id="id'.$aField[6].'" name="txt'.$aField[6].'">
										<option value="" selected="selected">-- Please Select --</option>
										'.fprvListDetails().'
									</select></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[5].'" id="id'.$aField[5].'_label">'.$aDescs[2].'</label></td>
								<td>
									<select id="id'.$aField[5].'" name="txt'.$aField[5].'">
										<option value="" selected="selected">-- Please Select --</option>
										'.fprvListDepartmentNames().'
									</select></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[3].'" id="id'.$aField[3].'_label">'.$aDescs[3].'</label></td>
								<td><input type="text" name="txt'.$aField[3].'" id="id'.$aField[3].'" value="'.$vRecord['fld'.$aField[3]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[4].'" id="id'.$aField[4].'_label">'.$aDescs[4].'</label></td>
								<td><input type="text" name="txt'.$aField[4].'" id="id'.$aField[4].'" value="'.$vRecord['fld'.$aField[4]].'" /></td>
							</tr>							
							<tr>
								<td><input type="hidden" name="hdnOper" value="TRUE" />
									<input type="hidden" name="hdnID" value="'.$vID.'" />
								</td>
								<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Save" /></td>
							</tr>
						</table>
					</form>

					<script>
						var a_fields = {

							\'id'.$aField[6].'\' : {\'l\':\''.$aDescs[1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[6].'_label\'},
							\'id'.$aField[5].'\' : {\'l\':\''.$aDescs[2].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[5].'_label\'},
							\'id'.$aField[3].'\' : {\'l\':\''.$aDescs[3].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[3].'_label\'},
							\'id'.$aField[4].'\' : {\'l\':\''.$aDescs[4].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[4].'_label\'}
						},
						o_config = {
							\'to_disable\' : [\'Submit\'],
							\'alert\' : 0
						}
						var tigra_validator = new validator(\'frmAddForm\', a_fields, o_config);
					</script>';
		return $vOutput;
	}

	function fprvEdit($vID) {
		global $objDBConn;
		global $aTable, $aField, $aDescription;		
		$vSQL = "SELECT
					tbluseraccounts.fldUsername, 
					tbluseraccounts.fldPassword, 
					tbluseraccounts_details.fldLastName, 
					tbluseraccounts_details.fldFirstName, 
					tbluseraccounts_groups.fldUserGroupName
				FROM
					tbluseraccounts, 
					tbluseraccounts_details, 
					tbluseraccounts_groups
				WHERE
					tbluseraccounts.fldUserDetailsID = tbluseraccounts_details.fldID AND 
					tbluseraccounts.fldUserGroupID = tbluseraccounts_groups.fldID AND
					tbluseraccounts.fldID = ".$vID."
				LIMIT
					1;";
		$vRecord = $objDBConn->query_first($vSQL);
		$vOutput = '<form name="frmEditForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" >
						<table cellpadding="0" cellspacing="0" border="1">
						<tr>
								<td><label for="id'.$aField[6].'" id="id'.$aField[6].'_label">Account Owner</label></td>
								<td>
									<select id="id'.$aField[6].'" name="txt'.$aField[6].'">
										<option value="'.$vRecord['fld'.$aField[6]].'" selected="selected">'.$vRecord['fld'.$aField[0]].'.'.$vRecord['fld'.$aField[1]].'</option>
										'.fprvListDetails().'
									</select></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[5].'" id="id'.$aField[5].'_label">Group Name</label></td>
								<td>
									<select id="id'.$aField[5].'" name="txt'.$aField[5].'">
										<option value="'.$vRecord['fld'.$aField[5]].'" selected="selected">'.$vRecord['fld'.$aField[2]].'</option>
										'.fprvListDepartmentNames().'
									</select></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[3].'" id="id'.$aField[3].'_label">Username</label></td>
								<td><input type="text" name="txt'.$aField[3].'" id="id'.$aField[3].'" value="'.$vRecord['fld'.$aField[3]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[4].'" id="id'.$aField[4].'_label">Password</label></td>
								<td><input type="text" name="txt'.$aField[4].'" id="id'.$aField[4].'" value="'.$vRecord['fld'.$aField[4]].'" /></td>
							</tr>							
							<tr>
								<td><input type="hidden" name="hdnOper" value="TRUE" />
									<input type="hidden" name="hdnID" value="'.$vID.'" />
									<input type="hidden" name="hdnDepartmentName" value="'.$vRecord['fld'.$aField[6]].'" />
									<input type="hidden" name="hdnDepartmentName" value="'.$vRecord['fld'.$aField[5]].'" />
								</td>
								<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Update" /></td>
							</tr>
						</table>
					</form>

					<script>
						var a_fields = {

							
							\'id'.$aField[1].'\' : {\'l\':\''.$aDescs[1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[1].'_label\'},
							\'id'.$aField[2].'\' : {\'l\':\''.$aDescs[2].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[2].'_label\'},
							\'id'.$aField[3].'\' : {\'l\':\''.$aDescs[3].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[3].'_label\'},
							\'id'.$aField[4].'\' : {\'l\':\''.$aDescs[4].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[4].'_label\'}
						},
						o_config = {
							\'to_disable\' : [\'Submit\'],
							\'alert\' : 0
						}
						var tigra_validator = new validator(\'frmEditForm\', a_fields, o_config);
					</script>';
		return $vOutput;
	}



	function fprvListView($vSQL) {
		global $objDBConn;
		global $aField, $aDescs;
		$vOutput = '';
		$vRows = $objDBConn->query($vSQL);
		while ($vRecord = $objDBConn->fetch_array($vRows)) {
			$vActive = ($vRecord['fldActive']==0?'Inactive':'Active');
			$vOutput .= '<tr id="idList_'.$vRecord['fldID'].'">
							<td>'.$vRecord['fldID'].'</td>';
			for ($vLoop=0; $vLoop!=count($aDescs); $vLoop++) $vOutput .= '<td>'.$vRecord['fld'.$aField[$vLoop]].'</td>';
			$vOutput .=    '<td>'.$vRecord['fldDateAdded'].'</td>
							<td>'.$vActive.'</td>
							<td>'.fpubGetAddedBy($vRecord['fldAddedBy']).'</td>
							<td><a href="edit.php?vID='.$vRecord['fldID'].'">Edit</a> | <a href="#" onclick="jsConfirmDelete(\''.$vRecord['fldID'].'\');">delete</a></td>
						</tr>';
		}
		return $vOutput;
	}
	function fprvListTables() {
		global $aTable;
		$vOutput = '';
		for ($vLoop=0; $vLoop!=count($aTable); $vLoop++) {
			$vOutput .= " ".$aTable[$vLoop]." ";
			if ($vLoop!=count($aTable)-1) $vOutput .= ",";
		}
		return $vOutput;
	}
	function fprvListHeaders() {
		global $aDescs;
		$vOutput = '';
		for ($vLoop=0; $vLoop!=count($aDescs); $vLoop++) $vOutput .= '<td><strong>'.$aDescs[$vLoop].'</strong></td>';
		return $vOutput;
	}
	function fprvUpdateDatabase($vOper) {
		global $objDBConn, $REQUEST, $_SESSION;
		$aData['fldUserGroupID'] = $REQUEST['txtUserGroupID'];
		$aData['fldUserDetailsID'] = $REQUEST['txtUserDetailsID'];
		$aData['fldUsername'] = $REQUEST['txtUsername'];
		$aData['fldPassword'] = $REQUEST['txtPassword'];		
		$aData['fldAddedBy'] = $_SESSION['svActiveUserInfo']['fldID'];
		if ($vOper=='Add') {
			$objDBConn->query_insert("tbluseraccounts", $aData);
		} else {
			$objDBConn->query_update("tbluseraccounts", $aData, "fldID=".$REQUEST['hdnID']);	
		}
		return 'Database was updated successfully...';
	}
	function fprvListDepartmentNames($vID = NULL) {
		global $objDBConn;
		$vOutput = '';
		$vSel = ' selected="selected"';
		$vSQL = "SELECT fldID, fldUserGroupName FROM tbluseraccounts_groups ORDER BY fldID ASC";
		$vRows = $objDBConn->query($vSQL);
		while ($vRecord = $objDBConn->fetch_array($vRows)) {
			$vOutput .= '<option value="'.$vRecord['fldID'].'"';
			if ($vID==$vRecord['fldID']) $vOutput .= ' selected="selected"';
			$vOutput .= '>'.$vRecord['fldUserGroupName'].'</option>';
		}
		return $vOutput;
		}
	function fprvListDetails($vID = NULL) {
		global $objDBConn;
		$vOutput = '';
		$vSel = ' selected="selected"';
		$vSQL = "SELECT fldID, fldFirstName, fldLastName FROM tbluseraccounts_details ORDER BY fldID ASC";
		$vRows = $objDBConn->query($vSQL);
		while ($vRecord = $objDBConn->fetch_array($vRows)) {
			$vOutput .= '<option value="'.$vRecord['fldID'].'"';
			if ($vID==$vRecord['fldID']) $vOutput .= ' selected="selected"';
			$vOutput .= '>'.$vRecord['fldFirstName'].'.'.$vRecord['fldLastName'].'</option>';
		}
		return $vOutput;
		}
?>