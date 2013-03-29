<?php
require_once '../../../config/config.inc.php';

function tggatos_registerRequestValue($name, $value)
{
	$_GET[$name] = $value;
	$_POST[$name] = $value;
	$_REQUEST[$name] = $value;
}

function tggatos_autodispatch($file)
{
	foreach (array('controller' => basename($file, '.pub.php'), 'fc' => 'module', 'module' => 'tggatos') as $name => $value)
		tggatos_registerRequestValue($name, $value);
	Dispatcher::getInstance()->dispatch();
}