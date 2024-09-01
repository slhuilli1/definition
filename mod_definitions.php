<?php	
	defined('_JEXEC') or die;
	require_once dirname(__FILE__).'/helper.php';
	$hello = modDefinitions::getDefinitions($params);
	require JModuleHelper::getLayoutPath('mod_definitions');