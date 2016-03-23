<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo GLOBAL_SYSTEM_TITLE; ?> - <?php echo $vApplicationName; ?></title>
<link rel="shortcut icon" href="<?php echo GLOBAL_IMG_FAVICON; ?>" />
<script type="text/javascript" src="javascripts/tigra_validator.js"></script> 
<link href="<?php echo GLOBAL_URL_TEMPLATES; ?>css/style.css" type="text/css" rel="stylesheet"/>

</head>
<body>

	<div id="divPageWrapper">
		<div id="divHeadNav">
			<div id="divHeadNavBottom">	
				<div id="divHeadNavBottom_Logo"></div>
				<div id="divHeadNavBottom_Icons">
				</div>
			</div>
		</div>
		
		<div id="divStatusBarTop"><center><?php echo $vMessage; ?></center></div>

		<div id="divCenterMain">
			<div id="divLoginForm">
				<center>
				<form name="frmLoginForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<table cellpadding="0" cellspacing="0" border="0" id="tableLoginBox">
						<thead>
							<tr id="trLoginBox_Header">
								<td colspan="5"><?php echo GLOBAL_SYSTEM_TITLE; ?> - <?php echo $vApplicationName; ?></td>
							</tr>
							<tr class="trLoginBox_Spacer">
								<td colspan="5"></td>
							</tr>						
						</thead>
						<tbody>
							<tr>
								<td class="tdLoginBox_Spacer" rowspan="3"></td>
								<td style="width: 75px;" align="left">Username</td>
								<td align="left"><input style="width: 170px" type="text" id="idUsername" name="txtUsername" value="<?php if (isset($vUsername)) echo $vUsername; ?>"></td>
								<td id="tdLoginBox_Icon" rowspan="5"></td>
								<td class="tdLoginBox_Spacer" rowspan="3"></td>
							</tr>
							<tr>							
								<td style="width: 75px;" align="left">Password</td>
								<td align="left"><input style="width: 170px" type="password" id="idPassword" name="txtPassword" value="<?php if (isset($vPassword)) echo $vPassword; ?>"></td>							
							</tr>
							<tr>							
								<td style="width: 75px;" align="left"></td>
								<td align="left"><input style="padding-left: 20px; padding-right: 20px" type="submit" name="cmdLogin" value="Login"></td>							
							</tr>						
						</tbody>
						<tfoot>
							<tr class="trLoginBox_Spacer">
								<td colspan="5"></td>
							</tr>						
						</tfoot>
					</table>
				</form>
				<script>
					var a_fields = {
						'idUsername' : {'l':'Username','r':true,'f':'','t':'idUsername_label'}, 
						'idPassword' : {'l':'Password','r':true,'f':'email','t':'idPassword_label'} 
					},
					o_config = {
						'to_disable' : ['Submit'],
						'alert' : 0
					}
					var tigra_validator = new validator('frmLoginForm', a_fields, o_config);
				</script>				
				</center>
			</div>
		</div>
	</div>	
	
	<div id="divFooter">
		Powered by <span id="spanOpenSystem"><a><?php echo GLOBAL_SYSTEM_TITLE; ?></a></span> Version <?php echo GLOBAL_SYSTEM_VERSION; ?>
	</div>
	
</body>
</html>
