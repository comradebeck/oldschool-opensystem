<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php	
	$aTable[1] = 'tbluseraccounts_groups';
	$aTable[2] = 'tbluseraccounts_details';
	$aTable[3] = 'tbluseraccounts';
	
	$aField[1] = 'ID';							$aDescription[1] = 'ID';
	$aField[2] = 'UserGroupID';					$aDescription[2] = 'User Group ID';
	$aField[3] = 'FirstName';					$aDescription[3] = 'First Name';
	$aField[4] = 'LastName';					$aDescription[4] = 'Last Name';
	$aField[5] = 'Username';					$aDescription[5] = 'Username';
	$aField[6] = 'Password';					$aDescription[6] = 'Password';
	$aField[7] = 'DateAdded';					$aDescription[7] = 'Date Added';
	$aField[8] = 'AddedBy';						$aDescription[8] = 'Added By';
	$aField[9] = 'Status';						$aDescription[9] = 'Status';
												$aDescription[10] = 'Controls';
	
	function fprvIndex() {
		global $aTable, $aField, $aDescription;
		$vSQL = "SELECT 
					".$aTable[3].".*, 
					".$aTable[2].".fld".$aField[3].",
					".$aTable[2].".fld".$aField[4].",
					".$aTable[1].".fld".$aField[2].", 
				FROM 
					".$aTable[3].", 
					".$aTable[2].",
					".$aTable[1]." 
				WHERE 
					".$aTable[1].".fld".$aField[2]." AND
					".$aTable[2].".fld".$aField[3]." AND
					".$aTable[2].".fld".$aField[4]."
					ORDER BY
					".$aTable[1].".fld".$aField[1]."
				ASC;";
		$vOutput = '<table cellpadding="0" cellspacing="0" border="1" id="idListView">
				<thead>
					<tr>
						<td><strong>'.$aDescription[1].'</strong></td>
						<td><strong>'.$aDescription[2].'</strong></td>
						<td><strong>'.$aDescription[3].'</strong></td>
						<td><strong>'.$aDescription[4].'</strong></td>
						<td><strong>'.$aDescription[5].'</strong></td>
						<td><strong>'.$aDescription[6].'</strong></td>
						<td><strong>'.$aDescription[8].'</strong></td>
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
		global $aTable, $aField, $aDescription;
		$vOutput = '<form name="frmAddForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return tigra_validator.exec()">
						<table cellpadding="0" cellspacing="0" border="1">
							<tr>
								<td><label for="id'.$aField[2].'" id="id'.$aField[2].'_label">'.$aDescription[2].'</label></td>
								<td><input type="text" name="txt'.$aField[2].'" id="id'.$aField[2].'" value="" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[3].'" id="id'.$aField[3].'_label">'.$aDescription[3].'</label></td>
								<td><textarea name="txt'.$aField[3].'" id="id'.$aField[3].'"></textarea></td>
							</tr>
							<tr>
								<td><input type="hidden" name="hdnOper" value="TRUE" /></td>
								<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Save" /></td>
							</tr>					
						</table>
					</form>
					
					<script>
						var a_fields = {
							\'id'.$aField[2].'\' : {\'l\':\''.$aDescription[2].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[2].'_label\'}
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
					".$aTable[1].".*, 
					".$aTable[2].".fld".$aField[5]." 
				FROM 
					".$aTable[1].", 
					".$aTable[2]." 
				WHERE 
					".$aTable[1].".fld".$aField[7]." = ".$aTable[2].".fld".$aField[1]." AND
					".$aTable[1].".fld".$aField[1]." = ".$vID."
				LIMIT 
					1;";
		$vRecord = $objDBConn->query_first($vSQL);
		$vOutput = '<form name="frmEditForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return tigra_validator.exec()">
						<table cellpadding="0" cellspacing="0" border="1">
							<tr>
								<td><label for="id'.$aField[2].'" id="id'.$aField[2].'_label">'.$aDescription[2].'</label></td>
								<td><input type="text" name="txt'.$aField[2].'" id="id'.$aField[2].'" value="'.$vRecord['fld'.$aField[2]].'" /></td>
							</tr>
							<tr>
								<td><label for="id'.$aField[3].'" id="id'.$aField[3].'_label">'.$aDescription[3].'</label></td>
								<td><textarea name="txt'.$aField[3].'" id="id'.$aField[3].'">'.$vRecord['fld'.$aField[3]].'</textarea></td>
							</tr>
							<tr>
								<td>
									<input type="hidden" name="hdn'.$aField[1].'" value="'.$vID.'" />
									<input type="hidden" name="hdnOper" value="TRUE" />
								</td>
								<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Update" /></td>
							</tr>					
						</table>
					</form>
					
					<script>
						var a_fields = {
							\'id'.$aField[2].'\' : {\'l\':\''.$aDescription[2].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aField[2].'_label\'}
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
		$vOutput = '';
		$vRows = $objDBConn->query($vSQL);
		while ($vRecord = $objDBConn->fetch_array($vRows)) {
			$vActive = ($vRecord['fldActive']==0?'Inactive':'Active');
			$vOutput .= '<tr id="idList_'.$vRecord['fldID'].'">
							<td>'.$vRecord['fldID'].'</td>
							<td>'.$vRecord['fldUserGroupName'].'</td>
							<td>'.$vRecord['fldDescription'].'</td>
							<td>'.$vRecord['fldDateAdded'].'</td>
							<td>'.$vRecord['fldUsername'].'</td>
							<td>'.$vActive.'</td>
							<td><a href="edit.php?vID='.$vRecord['fldID'].'">Edit</a> | <a href="#" onclick="jsConfirmDelete(\''.$vRecord['fldID'].'\');">delete</a></td>
						</tr>';
		}
		return $vOutput;
	}
	
?>
