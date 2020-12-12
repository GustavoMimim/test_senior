<?php
class User
{
	public function __construct($id, $username, $description)
	{
		$this->id          = $id;
		$this->username    = $username;
		$this->description = $description;
	}

	public static function all()
	{
		$list = [];
		$db = Db::getInstance();
		$req = $db->query('SELECT U.id, U.username, T.description FROM users AS U LEFT JOIN type_users AS T ON U.id_type_user = T.id');

		foreach ($req->fetchAll() as $user) {
			$list[] = new User($user['id'], $user['username'], $user['description']);
		}

		return $list;
	}

	public static function find($id)
	{
		$db = Db::getInstance();
		
		$id = intval($id);
		$req = $db->prepare('SELECT * FROM users WHERE id = :id');
		
		$req->execute(array('id' => $id));
		$user = $req->fetch();

		return new User($user['id'], $user['username'], $user['type_user']);
	}
}
