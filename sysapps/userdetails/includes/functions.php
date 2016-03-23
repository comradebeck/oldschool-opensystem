<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php
	$aTable = array('tbluseraccounts_details',
					'tbluseraccounts_departments');

	$aField = array('LastName',
					'FirstName',
					'DepartmentName',
					'SkypeID',
					'PrimaryEmail',
					'AltEmail',
					'ContactNumber',
					'DirectLine',
					'DateAdded',
					'Active',
					'AddedBy',
					'UserDepartmentID');

	$aDescs = array('Last Name',
					'First Name',
					'Department Name',
					'Skype ID',
					'Primary Email',
					'Alternate Email',
					'Contact Number',
					'Direct Line');

	function fprvIndex() {
		global $aTable, $aField, $aDescs;
		$vSQL = "SELECT 
					".$aTable[0].".*, 
					".$aTable[1].".fld".$aField[2]." 
				FROM "
					.fprvListTables()." 
				WHERE 
					".$aTable[0].".fld".$aField[11]." = ".$aTable[1].".fldID 
				ORDER BY 
					".$aTable[0].".fldID 
				ASC;";
		$vOutput = '<table cellpadding="0" cellspacing="0" border="1" id="idListView">
				<thead>
					<tr>
						<td><strong>ID</strong></td>
						'.fprvListHeaders().'
						<td><strong>Date &amp; Added</strong></td>
						<td><strong>Status</strong></td>
						<td><strong>Added By</strong></td>
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
		global $aTable, $aField, $aDescs;
		$vOutput = '<form name="frmAddForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return tigra_validator.exec()">
						<table cellpadding="0" cellspacing="0" border="1">
							<tr>
								<td><label for="id'.$aField[0].'" id="id'.$aField[0].'_label">'.$aDescs[0].'</label></td>
								<td><input type="text" name="txt'.$aField[0].'" id="id'.$aField[0].'" value="" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[1].'" id="id'.$aField[1].'_label">'.$aDescs[1].'</label></td>
								<td><input type="text" name="txt'.$aField[1].'" id="id'.$aField[1].'" value="" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[11].'" id="id'.$aField[11].'_label">'.$aDescs[2].'</label></td>
								<td>
									<select id="id'.$aField[11].'" name="txt'.$aField[11].'">
										<option value="" selected="selected">-- Please Select --</option>
										'.fprvListDepartmentNames().'
									</select>
								</td>
							</tr>
							<tr>
								<td><label for="id'.$aField[3].'" id="id'.$aField[3].'_label">'.$aDescs[3].'</label></td>
								<td><input type="text" name="txt'.$aField[3].'" id="id'.$aField[3].'" value="" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[4].'" id="id'.$aField[4].'_label">'.$aDescs[4].'</label></td>
								<td><input type="text" name="txt'.$aField[4].'" id="id'.$aField[4].'" value="" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[5].'" id="id'.$aField[5].'_label">'.$aDescs[5].'</label></td>
								<td><input type="text" name="txt'.$aField[5].'" id="id'.$aField[5].'" value="" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[6].'" id="id'.$aField[6].'_label">'.$aDescs[6].'</label></td>
								<td><input type="text" name="txt'.$aField[6].'" id="id'.$aField[6].'" value="" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[7].'" id="id'.$aField[7].'_label">'.$aDescs[7].'</label></td>
								<td><input type="text" name="txt'.$aField[7].'" id="id'.$aField[7].'" value="" /></td>
							</tr>
							<tr>
								<td><input type="hidden" name="hdnOper" value="TRUE" /></td>
								<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Save" /></td>
							</tr>
						</table>
					</form>

					<script>
						var a_fields = {
							\'id'.$aField[0].'\' : {\'l\':\''.$aDescs[0].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[0].'_label\'},
							\'id'.$aField[1].'\' : {\'l\':\''.$aDescs[1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[1].'_label\'},
							\'id'.$aField[11].'\' : {\'l\':\''.$aDescs[2].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[11].'_label\'},
							\'id'.$aField[3].'\' : {\'l\':\''.$aDescs[3].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[3].'_label\'},
							\'id'.$aField[4].'\' : {\'l\':\''.$aDescs[4].'\',\'r\':true,\'f\':\'email\',\'t\':\'id'.$aField[4].'_label\'},
							\'id'.$aField[5].'\' : {\'l\':\''.$aDescs[5].'\',\'r\':true,\'f\':\'email\',\'t\':\'id'.$aField[5].'_label\'},
							\'id'.$aField[6].'\' : {\'l\':\''.$aDescs[6].'\',\'r\':true,\'f\':\'phone\',\'t\':\'id'.$aField[6].'_label\'},
							\'id'.$aField[7].'\' : {\'l\':\''.$aDescs[7].'\',\'r\':true,\'f\':\'phone\',\'t\':\'id'.$aField[7].'_label\'}
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
		global $aTable, $aField, $aDescs;
		$vSQL = "SELECT 
					".$aTable[0].".fld".$aField[0].", 
					".$aTable[0].".fld".$aField[1].", 
					".$aTable[0].".fld".$aField[11].", 
					".$aTable[0].".fld".$aField[3].",  
					".$aTable[0].".fld".$aField[4].", 
					".$aTable[0].".fld".$aField[5].", 
					".$aTable[0].".fld".$aField[6].", 
					".$aTable[0].".fld".$aField[7]." 
				FROM 
					".$aTable[0]." 
				WHERE 
					".$aTable[0].".fldID = '".$vID."' 
				LIMIT 
					1;";
		$vRecord = $objDBConn->query_first($vSQL);

		$vOutput = '<form name="frmAddForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return tigra_validator.exec()">
						<table cellpadding="0" cellspacing="0" border="1">
							<tr>
								<td><label for="id'.$aField[0].'" id="id'.$aField[0].'_label">'.$aDescs[0].'</label></td>
								<td><input type="text" name="txt'.$aField[0].'" id="id'.$aField[0].'" value="'.$vRecord['fld'.$aField[0]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[1].'" id="id'.$aField[1].'_label">'.$aDescs[1].'</label></td>
								<td><input type="text" name="txt'.$aField[1].'" id="id'.$aField[1].'" value="'.$vRecord['fld'.$aField[1]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[11].'" id="id'.$aField[11].'_label">'.$aDescs[2].'</label></td>
								<td>
									<select id="id'.$aField[11].'" name="txt'.$aField[11].'">
										<option value="" selected="selected">-- Please Select --</option>
										'.fprvListDepartmentNames($vRecord['fld'.$aField[11]]).'
									</select>
								</td>
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
								<td><label for="id'.$aField[5].'" id="id'.$aField[5].'_label">'.$aDescs[5].'</label></td>
								<td><input type="text" name="txt'.$aField[5].'" id="id'.$aField[5].'" value="'.$vRecord['fld'.$aField[5]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[6].'" id="id'.$aField[6].'_label">'.$aDescs[6].'</label></td>
								<td><input type="text" name="txt'.$aField[6].'" id="id'.$aField[6].'" value="'.$vRecord['fld'.$aField[6]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[7].'" id="id'.$aField[7].'_label">'.$aDescs[7].'</label></td>
								<td><input type="text" name="txt'.$aField[7].'" id="id'.$aField[7].'" value="'.$vRecord['fld'.$aField[7]].'" /></td>
							</tr>
							<tr>
								<td>
									<input type="hidden" name="hdnOper" value="TRUE" />
									<input type="hidden" name="hdnID" value="'.$vID.'" />
								</td>
								<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Update" /></td>
							</tr>
						</table>
					</form>

					<script>
						var a_fields = {
							\'id'.$aField[0].'\' : {\'l\':\''.$aDescs[0].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[0].'_label\'},
							\'id'.$aField[1].'\' : {\'l\':\''.$aDescs[1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[1].'_label\'},
							\'id'.$aField[11].'\' : {\'l\':\''.$aDescs[2].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[11].'_label\'},
							\'id'.$aField[3].'\' : {\'l\':\''.$aDescs[3].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[3].'_label\'},
							\'id'.$aField[4].'\' : {\'l\':\''.$aDescs[4].'\',\'r\':true,\'f\':\'email\',\'t\':\'id'.$aField[4].'_label\'},
							\'id'.$aField[5].'\' : {\'l\':\''.$aDescs[5].'\',\'r\':true,\'f\':\'email\',\'t\':\'id'.$aField[5].'_label\'},
							\'id'.$aField[6].'\' : {\'l\':\''.$aDescs[6].'\',\'r\':true,\'f\':\'phone\',\'t\':\'id'.$aField[6].'_label\'},
							\'id'.$aField[7].'\' : {\'l\':\''.$aDescs[7].'\',\'r\':true,\'f\':\'phone\',\'t\':\'id'.$aField[7].'_label\'}
						},
						o_config = {
							\'to_disable\' : [\'Submit\'],
							\'alert\' : 0
						}
						var tigra_validator = new validator(\'frmAddForm\', a_fields, o_config);
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
	function fprvListDepartmentNames($vID = NULL) {
		global $objDBConn;
		$vOutput = '';
		$vSel = ' selected="selected"';
		$vSQL = "SELECT fldID, fldDepartmentName FROM tbluseraccounts_departments ORDER BY fldID ASC";
		$vRows = $objDBConn->query($vSQL);
		while ($vRecord = $objDBConn->fetch_array($vRows)) {
			$vOutput .= '<option value="'.$vRecord['fldID'].'"';
			if ($vID==$vRecord['fldID']) $vOutput .= ' selected="selected"';
			$vOutput .= '>'.$vRecord['fldDepartmentName'].'</option>';
		}
		return $vOutput;
	}
	function fprvUpdateDatabase($vOper) {
		global $objDBConn, $REQUEST, $_SESSION;
		$aData['fldLastName'] = $REQUEST['txtLastName'];
		$aData['fldFirstName'] = $REQUEST['txtFirstName'];
		$aData['fldUserDepartmentID'] = $REQUEST['txtUserDepartmentID'];
		$aData['fldSkypeID'] = $REQUEST['txtSkypeID'];
		$aData['fldPrimaryEmail'] = $REQUEST['txtPrimaryEmail'];
		$aData['fldAltEmail'] = $REQUEST['txtAltEmail'];
		$aData['fldContactNumber'] = $REQUEST['txtContactNumber'];
		$aData['fldDirectLine'] = $REQUEST['txtDirectLine'];		
		$aData['fldAddedBy'] = $_SESSION['svActiveUserInfo']['fldID'];
		if ($vOper=='Add') {
			$objDBConn->query_insert("tbluseraccounts_details", $aData);
		} else {
			$objDBConn->query_update("tbluseraccounts_details", $aData, "fldID=".$REQUEST['hdnID']);	
		}
		return 'Database was updated successfully...';
	}
?>