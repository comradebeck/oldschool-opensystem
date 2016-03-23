<?php if (!defined('GLOBAL_BASE_CONFIG')) { die('Direct access to this file has been disallowed. Please contact your system administrator'); } ?>
<?php
	define('GLOBAL_URL_STYLESHEETS', 			GLOBAL_URL_ROOT.'stylesheets/');
	define('GLOBAL_URL_JAVASCRIPTS', 			GLOBAL_URL_ROOT.'javascripts/');
	define('GLOBAL_URL_TEMPLATES', 				GLOBAL_URL_ROOT.'templates/default/');
	define('GLOBAL_URL_INCLUDES', 				GLOBAL_URL_ROOT.'includes/');
	define('GLOBAL_URL_CLASSES', 				GLOBAL_URL_ROOT.'classes/');
	define('GLOBAL_URL_SYSTEMS', 				GLOBAL_URL_ROOT.'sysapps/');
	define('GLOBAL_URL_MODULES', 				GLOBAL_URL_ROOT.'modapps/');
	define('GLOBAL_URL_IMAGES', 				GLOBAL_URL_ROOT.'images/');
	define('GLOBAL_URL_CONFIGS', 				GLOBAL_URL_ROOT.'configs/');
	define('GLOBAL_URL_UPLOADS', 				GLOBAL_URL_ROOT.'uploads/');

	define('GLOBAL_URL_LOGIN', 					GLOBAL_URL_ROOT.'login.php');
	define('GLOBAL_URL_LOGOUT', 				GLOBAL_URL_ROOT.'login.php?action=logout');
	define('GLOBAL_URL_DASHBOARD',				GLOBAL_URL_SYSTEMS.'dashboard/index.php');
?>