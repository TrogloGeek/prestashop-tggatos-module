<?php
require_once implode(DIRECTORY_SEPARATOR, array(dirname(dirname(dirname(dirname(__FILE__)))), 'config', 'config.inc.php'));

function tggatos_registerRequestValue($name, $value)
{
	$_GET[$name] = $value;
	$_POST[$name] = $value;
	$_REQUEST[$name] = $value;
}

function tggatos_autodispatch($file)
{
	$controller = basename($file, '.pub.php');
	if (version_compare(_PS_VERSION_, '1.5', '>=')) {
		//PrestaShop 1.5+
		eval('class TggAtosModuleFrontController extends ModuleFrontController {}');
		foreach (array('controller' => $controller, 'fc' => 'module', 'module' => 'tggatos') as $name => $value)
			tggatos_registerRequestValue($name, $value);
		Dispatcher::getInstance()->dispatch();
	} else {
		//PrestaShop 1.4
		require_once implode(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'ps14', 'classes', 'TggAtosModuleFrontController.php'));
		require_once implode(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'controllers', 'front', $controller.'.php'));
		$controller = 'TggAtos'.Tools::toCamelCase(str_replace('-', '_', $controller), true);
		//require_once implode(DIRECTORY_SEPARATOR, array(dirname(dirname(__FILE__)), 'ps14', 'controllers', 'front', $controller.'.php'));
		ControllerFactory::getController($controller.'ModuleFrontController')->run();
	}
}
