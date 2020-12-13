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
	
    public static function insert( $request )
    {
        $db = Db::getInstance();

        $return = $db->prepare( 'INSERT INTO users (username, password, id_type_user) VALUES (:username, :password, :type)' );
        $return->bindValue( ':username', $request['username'] );
        $return->bindValue( ':password', $request['password'] );
        $return->bindValue( ':type', $request['type'] );

        $return->execute();
    }

    public static function delete( $id )
    {
        $db = Db::getInstance();

        $id = intval($id);

        $return = $db->prepare( 'DELETE FROM users WHERE id = :id' );
        $return->bindParam( ':id', $id );
        $return->execute();
    }
}
