<?php
class TypeUser
{
	public function __construct($id, $description)
	{
		$this->id          = $id;
		$this->description = $description;
	}

	public static function all()
	{
		$list = [];
		$db = Db::getInstance();
		$req = $db->query('SELECT id, description FROM type_users');

		foreach ($req->fetchAll() as $type) {
			$list[] = new TypeUser($type['id'], $type['description']);
		}

		return $list;
	}
}
