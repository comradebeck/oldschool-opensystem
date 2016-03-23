<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php
	$aTable = array('tbluseraccounts_departments');
	
	$aField = array('DepartmentName',
					'Description');

	$aDescs = array('Department Name',
					'Description');

	function fprvIndex() {
		global $aTable, $aField, $aDescs;
		$vSQL = "SELECT 
					".$aTable[0].".* 
				FROM "
					.fprvListTables()." 
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
								<td><textarea name="txt'.$aField[1].'" id="id'.$aField[1].'" /></textarea></td>
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
							\'id'.$aField[1].'\' : {\'l\':\''.$aDescs[1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[1].'_label\'}
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
					".$aTable[0].".fld".$aField[1]." 
				FROM 
					".$aTable[0]." 
				WHERE 
					".$aTable[0].".fldID = '".$vID."' 
				LIMIT 
					1;";
		$vRecord = $objDBConn->query_first($vSQL);

		$vOutput = '<form name="frmAddForm" method="POST" action="'.$_SERVER['PHP_SELF'].'?vID='.$vID.'" onsubmit="return tigra_validator.exec()">
						<table cellpadding="0" cellspacing="0" border="1">
							<tr>
								<td><label for="id'.$aField[0].'" id="id'.$aField[0].'_label">'.$aDescs[0].'</label></td>
								<td><input type="text" name="txt'.$aField[0].'" id="id'.$aField[0].'" value="'.$vRecord['fld'.$aField[0]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[1].'" id="id'.$aField[1].'_label">'.$aDescs[1].'</label></td>
								<td><textarea name="txt'.$aField[1].'" id="id'.$aField[1].'" />'.$vRecord['fld'.$aField[1]].'</textarea></td>
							</tr>							
							<tr>
								<td>
									<input type="hidden" name="hdnOper" value="TRUE" />
									<input type="hidden" name="hdnID" value="'.$vID.'" />
									<input type="hidden" name="hdnDepartmentName" value="'.$vRecord['fld'.$aField[0]].'" />
								</td>
								<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Save" /></td>
							</tr>
						</table>
					</form>

					<script>
						var a_fields = {
							\'id'.$aField[0].'\' : {\'l\':\''.$aDescs[0].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[0].'_label\'},
							\'id'.$aField[1].'\' : {\'l\':\''.$aDescs[1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[1].'_label\'}
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
	function fprvUpdateDatabase($vOper) {
		global $objDBConn, $REQUEST, $_SESSION;
		$aData['fldDepartmentName'] = $REQUEST['txtDepartmentName'];
		$aData['fldDescription'] = $REQUEST['txtDescription'];		
		$aData['fldAddedBy'] = $_SESSION['svActiveUserInfo']['fldID'];
		if ($vOper=='Add') {
			$objDBConn->query_insert("tbluseraccounts_departments", $aData);
		} else {
			$objDBConn->query_update("tbluseraccounts_departments", $aData, "fldID=".$REQUEST['hdnID']);	
		}
		return 'Database was updated successfully...';
	}
?>