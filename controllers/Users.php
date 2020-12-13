<?php
class UsersController
{

	public function __construct()
	{
		require_once('models/users.php');
		require_once('models/typeusers.php');
	}

	public function index()
	{
		$users = User::all();
		require_once('views/users/index.php');
	}
	
    public function insert()
    {
        if( empty( $_POST ) ) {
			$types_users = TypeUser::all();
            require_once( 'views/users/new.php' );
        } else {            
           User::insert( $_POST );
           unset( $_POST );
           Redirect( '?controller=users&action=index' );
        }
    }

    public function delete()
    {      
        if ( ! isset( $_GET['id'] ) )
            return error( 'Não foi possível encontrar o produto á ser removido' );

        User::delete( $_GET['id'] );

		Redirect( '?controller=users&action=index' );
    }
}
