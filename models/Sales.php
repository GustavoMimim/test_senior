<?php
class Sale
{
    public function __construct($id, $confirm, $created_at, $updated_at)
    {
        $this->id         = $id;
        $this->confirm    = $confirm;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $query = $db->query( 'SELECT id, IF( confirm = 1, "Sim", "Não" ) AS confirm, DATE_FORMAT(created_at, "%d/%m/%Y %Hh%i") AS created_at, updated_at FROM sales' );

        foreach ($query->fetchAll() as $sales) {
            $list[] = new Sale( $sales['id'], $sales['confirm'], $sales['created_at'], $sales['updated_at'] );
        }

        return $list;
    }

    public static function insert( $request = [] )
    {
        $db = Db::getInstance();

        $query = $db->prepare( 'INSERT INTO sales (confirm, created_at) VALUES (:confirm, now())' );

        $query->bindValue( ':confirm', empty( $request['confirm'] ) ? 0 : $request['confirm']  );
    
        $query->execute();

        return $db->lastInsertId();
    }

    public static function find( $id ) {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare('SELECT id, confirm, DATE_FORMAT(created_at, "%d/%m/%Y %Hh%i") AS created_at, updated_at FROM sales WHERE id = :id');
        $req->execute(array('id' => $id));
        $sale = $req->fetch();

        return new Sale( $sale['id'], $sale['confirm'], $sale['created_at'], $sale['updated_at'] );
    }

    public static function update( $request = [] )
    {
        $db = Db::getInstance();

        $query = $db->prepare( 'UPDATE sales SET confirm = :confirm, updated_at = now() WHERE id = :id' );

        $query->bindValue( ':confirm', $request['confirm'] );
        $query->bindValue( ':id',      $request['id'] );

        $query->execute();

        return $request['id'];     
    }

    public static function delete( $id )
    {
        $db = Db::getInstance();

        $id = intval($id);

        $return = $db->prepare( 'DELETE FROM sales WHERE id = :id' );
        $return->bindParam( ':id', $id );
        $return->execute();
    }
}
