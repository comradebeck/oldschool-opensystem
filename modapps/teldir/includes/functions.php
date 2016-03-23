<?php
	function fprvIndex($vConn) {
		$vOutput = '
			<table cellpadding="0" cellspacing="0" border="1" id="idListView">
				<thead>
					<tr>
						<td><strong>ID</strong></td>
						<td><strong>First Name</strong></td>
						<td><strong>Last Name</strong></td>
						<td><strong>Email Address</strong></td>
						<td><strong>Address</strong></td>
						<td><strong>Tel. Number</strong></td>
						<td><strong>Date &amp;Time Added</strong></td>
						<td><strong>Added By</strong></td>
						<td><strong>Status</strong></td>						
						<td><strong>Controls</strong></td>
					</tr>
				</thead>
				<tbody>';
						
		$vSQL = "SELECT 
					tblteldir.*, 
					tbluseraccounts.fldUsername 
				FROM 
					tblteldir, 
					tbluseraccounts 
				WHERE 
					tblteldir.fldAddedBy = tbluseraccounts.fldID 
				ORDER BY
					tblteldir.fldID
				ASC;";		
		$vRows = $vConn->query($vSQL);					
		while ($vRecord = $vConn->fetch_array($vRows)) {
			$vActive = ($vRecord['fldActive']==0?'Inactive':'Active');
			$vOutput .= '
					<tr id="idList_'.$vRecord['fldID'].'">
						<td>'.$vRecord['fldID'].'</td>
						<td>'.$vRecord['fldFirstName'].'</td>
						<td>'.$vRecord['fldLastName'].'</td>
						<td>'.$vRecord['fldEmailAddress'].'</td>
						<td>'.$vRecord['fldAddress'].'</td>
						<td>'.$vRecord['fldTelephoneNumber'].'</td>
						<td>'.$vRecord['fldDateAdded'].'</td>
						<td>'.$vRecord['fldUsername'].'</td>
						<td>'.$vActive.'</td>
						<td><a href="edit.php?vID='.$vRecord['fldID'].'">Edit</a> | <a href="#" onclick="jsConfirmDelete(\''.$vRecord['fldID'].'\');">delete</a></td>
					</tr>';
		}
		$vOutput .=	'
				</tbody>
			</table>
			
			<script type="text/javascript"> 
				tigra_tables(\'idListView\', 1, 0, \'#ffffff\', \'#F1F1F1\', \'#ccccff\', \'#cc99ff\'); 
			</script>';
		return $vOutput;
	}
	
	function fprvAdd($vConn) {
		$aData[1][1] = 'First Name'; 			$aData[1][2] = 'FirstName';
		$aData[2][1] = 'Last Name'; 			$aData[2][2] = 'LastName';
		$aData[3][1] = 'Telephone Number'; 		$aData[3][2] = 'TelephoneNumber';
		$aData[4][1] = 'Email Address';			$aData[4][2] = 'EmailAddress';		
		$aData[5][1] = 'Address';				$aData[5][2] = 'Address';
		
		$vOutput = '
			<form name="frmAddForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return tigra_validator.exec()">
				<table cellpadding="0" cellspacing="0" border="3">
					<tr>
						<td><label for="id'.$aData[1][2].'" id="id'.$aData[1][2].'_label">'.$aData[1][1].'</label></td>
						<td><input type="text" name="txt'.$aData[1][2].'" id="id'.$aData[1][2].'" value="" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[2][2].'" id="id'.$aData[2][2].'_label">'.$aData[2][1].'</label></td>
						<td><input type="text" name="txt'.$aData[2][2].'" id="id'.$aData[2][2].'" value="" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[3][2].'" id="id'.$aData[3][2].'_label">'.$aData[3][1].'</label></td>
						<td><input type="text" name="txt'.$aData[3][2].'" id="id'.$aData[3][2].'" value="" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[4][2].'" id="id'.$aData[4][2].'_label">'.$aData[4][1].'</label></td>
						<td><input type="text" name="txt'.$aData[4][2].'" id="id'.$aData[4][2].'" value="" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[5][2].'" id="id'.$aData[5][2].'_label">'.$aData[5][1].'</label></td>
						<td><input type="text" name="txt'.$aData[5][2].'" id="id'.$aData[5][2].'" value="" /></td>
					</tr>					
					<tr>
						<td><input type="hidden" name="hdnOper" value="TRUE" /></td>
						<td><input type="reset" value="Clear" />&nbsp;<input type="submit" value="Save" /></td>
					</tr>					
				</table>
			</form>
			
			<script>
				var a_fields = {
					\'id'.$aData[1][2].'\' : {\'l\':\''.$aData[1][1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aData[1][2].'_label\'}, 
					\'id'.$aData[2][2].'\' : {\'l\':\''.$aData[2][1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aData[2][2].'_label\'}, 
					\'id'.$aData[3][2].'\' : {\'l\':\''.$aData[3][1].'\',\'r\':true,\'f\':\'phone\',\'t\':\'id'.$aData[3][2].'_label\'}, 
					\'id'.$aData[4][2].'\' : {\'l\':\''.$aData[4][1].'\',\'r\':true,\'f\':\'email\',\'t\':\'id'.$aData[4][2].'_label\'} 
				},
				o_config = {
					\'to_disable\' : [\'Submit\'],
					\'alert\' : 0
				}
				var tigra_validator = new validator(\'frmAddForm\', a_fields, o_config);
			</script>';
		return $vOutput;
	}

	function fprvEdit($vConn, $vID) {
		$vTableName = 'tblteldir';
		$aData[1][1] = 'First Name'; 			$aData[1][2] = 'FirstName';
		$aData[2][1] = 'Last Name'; 			$aData[2][2] = 'LastName';
		$aData[3][1] = 'Telephone Number'; 		$aData[3][2] = 'TelephoneNumber';
		$aData[4][1] = 'Email Address';			$aData[4][2] = 'EmailAddress';
		$aData[5][1] = 'Address';				$aData[5][2] = 'Address';
		
		$vSQL = "SELECT 
					".$vTableName.".fld".$aData[1][2].", 
					".$vTableName.".fld".$aData[2][2].", 
					".$vTableName.".fld".$aData[3][2].", 
					".$vTableName.".fld".$aData[4][2].", 
					".$vTableName.".fld".$aData[5][2]." 
				FROM 
					".$vTableName." 
				WHERE 
					".$vTableName.".fldID='".$vID."' 
				LIMIT 
					1;";
		$vRecord = $vConn->query_first($vSQL);
		$vOutput = '
			<form name="frmAddForm" method="POST" action="'.$_SERVER['PHP_SELF'].'" onsubmit="return tigra_validator.exec()">
				<table cellpadding="0" cellspacing="0" border="1">
					<tr>
						<td><label for="id'.$aData[1][2].'" id="id'.$aData[1][2].'_label">'.$aData[1][1].'</label></td>
						<td><input type="text" name="txt'.$aData[1][2].'" id="id'.$aData[1][2].'" value="'.$vRecord['fld'.$aData[1][2]].'" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[2][2].'" id="id'.$aData[2][2].'_label">'.$aData[2][1].'</label></td>
						<td><input type="text" name="txt'.$aData[2][2].'" id="id'.$aData[2][2].'" value="'.$vRecord['fld'.$aData[2][2]].'" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[3][2].'" id="id'.$aData[3][2].'_label">'.$aData[3][1].'</label></td>
						<td><input type="text" name="txt'.$aData[3][2].'" id="id'.$aData[3][2].'" value="'.$vRecord['fld'.$aData[3][2]].'" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[4][2].'" id="id'.$aData[4][2].'_label">'.$aData[4][1].'</label></td>
						<td><input type="text" name="txt'.$aData[4][2].'" id="id'.$aData[4][2].'" value="'.$vRecord['fld'.$aData[4][2]].'" /></td>
					</tr>
					<tr>
						<td><label for="id'.$aData[5][2].'" id="id'.$aData[5][2].'_label">'.$aData[5][1].'</label></td>
						<td><input type="text" name="txt'.$aData[5][2].'" id="id'.$aData[5][2].'" value="'.$vRecord['fld'.$aData[5][2]].'" /></td>
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
					\'id'.$aData[1][2].'\' : {\'l\':\''.$aData[1][1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aData[1][2].'_label\'}, 
					\'id'.$aData[2][2].'\' : {\'l\':\''.$aData[2][1].'\',\'r\':true,\'f\':\'\',\'t\':\'id'.$aData[2][2].'_label\'}, 
					\'id'.$aData[3][2].'\' : {\'l\':\''.$aData[3][1].'\',\'r\':true,\'f\':\'phone\',\'t\':\'id'.$aData[3][2].'_label\'}, 
					\'id'.$aData[4][2].'\' : {\'l\':\''.$aData[4][1].'\',\'r\':true,\'f\':\'email\',\'t\':\'id'.$aData[4][2].'_label\'} 
				},
				o_config = {
					\'to_disable\' : [\'Submit\'],
					\'alert\' : 0
				}
				var tigra_validator = new validator(\'frmAddForm\', a_fields, o_config);
			</script>';
		return $vOutput;
	}

	function fprvCreateSideBar($vConn, $vShortName) {
		$vAppInfo = fprvGetParentAppID($vConn, $vShortName);
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
					tblapplications.fldPosition;";		
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
	
	function fprvGetParentAppID($vConn, $vShortName) {
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
?>
