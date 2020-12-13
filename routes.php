<?php
function call( $controller, $action )
{
	require_once( 'controllers/' . $controller . '.php' );

	switch ( $controller ) {
		case 'users':
			$controller = new UsersController();
			break;
		case 'products':
			$controller = new ProductsController();
			break;	
		case 'sales':
			$controller = new SalesController();
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

function redirect( $url )
{
   header('Location: ' . $url);
   die();
}

$controllers = array(
	'users' => ['index', 'delete', 'insert'],
	'products' => ['index', 'delete', 'insert'],
	'sales' => ['index', 'delete', 'insert']
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
