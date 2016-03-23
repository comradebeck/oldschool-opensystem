<?php
	ob_start("ob_gzhandler");
	define('GLOBAL_PAGE_START_TIME', 			microtime(TRUE));			// GLOBAL PAGE PARSE TIME
	define('GLOBAL_BASE_CONFIG', TRUE);										// GLOBAL INCLUDE CHECKING CONSTANT
	require('configs/system.conf.php');										// GLOBAL SYSTEM VARIABLE DECLARATIONS
	require('configs/db.conf.php');											// GLOBAL DATABASE CONFIGURATION
	require('configs/filter.conf.php');										// GLOBAL INPUT FILTER CONFIGURATIONS
	define('GLOBAL_DIR_ROOT', 					dirname(__FILE__).'/');		// GLOBAL HOME DIRECTORY
	require('configs/dir.conf.php');										// GLOBAL DIRECTORY STRUCTURE DECLARATIONS
	define('GLOBAL_URL_ROOT', 					'/opensystem/');			// GLOBAL HOME URL
	require('configs/url.conf.php');										// GLOBAL URL STRUCTURE DECLARATIONS
	require('configs/inc.conf.php');										// GLOBAL INCLUDE STRUCTURE DESCLARATIONS
	require('configs/tpl.conf.php');										// GLOBAL TEMPLATE STRUCTURE DESCLARATIONS
	require('configs/file.conf.php');										// GLOBAL FILE (CLASSES, FUNCTIONS, LIBRARIES) DECLARATIONS	
	require('configs/img.conf.php');										// GLOBAL IMAGES DECLARATIONS
	require('configs/session.conf.php');									// GLOBAL SESSION VARIABLE DECALARATIONS
	require('configs/page.conf.php');										// GLOBAL PAGINATION SETTINGS
?>