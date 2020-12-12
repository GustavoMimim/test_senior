<?php
class UsersController
{

	public function __construct()
	{
		require_once('models/users.php');
	}

	public function index()
	{
		$users = User::all();
		require_once('views/users/index.php');
	}
}
