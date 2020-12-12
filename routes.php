<?php

function call($controller, $action)
{
	require_once('controllers/' . $controller . '.php');

	switch ($controller) {
		case 'users':
			$controller = new UsersController();
			break;
		case 'products':
			$controller = new ProductsController();
			break;		
	}

	$controller->{$action}();

}

function error ($msg)
{
	require_once('controllers/error.php');
	$erro = new ErrorController();
	$erro->index($msg);
}

$controllers = array(
	'products' => ['index'],
	'users' => ['index']
);

if (array_key_exists($controller, $controllers)) {
	if (in_array($action, $controllers[$controller])) {
		call($controller, $action);
	} else {
		error('A função do controller requisitado não foi encontrada.');
	}
} else {
	error('O controller requisitado não foi encontrado.');
}
