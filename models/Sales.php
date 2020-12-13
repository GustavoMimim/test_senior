<?php
class Sale
{
    public function __construct($id, $confirm, $date, $total_value)
    {
        $this->id          = $id;
        $this->confirm     = $confirm;
        $this->date        = $date;
        $this->total_value = $total_value;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT S.id, IF( S.confirm = 1, "Sim", "Não" ) AS confirm , S.date, IFNULL( SUM( price * quantity ), 0 ) AS total_value FROM sales AS S LEFT JOIN item_sales AS I ON I.id_sale = S.id GROUP BY S.id');

        foreach ($req->fetchAll() as $sales) {
            $list[] = new Sale($sales['id'], $sales['confirm'], $sales['date'], 'R$ ' . number_format($sales['total_value'], 2, ',', ' '));
        }

        return $list;
    }

    public static function insert( $request )
    {
        $db = Db::getInstance();

        $return = $db->prepare( 'INSERT INTO sales (description, price, active) VALUES (:description, :price, :activated)' );
        $return->bindValue( ':description', $request['description'] );
        $return->bindValue( ':price', $request['price'] );
        $return->execute();
    }

    public static function delete( $id )
    {
        $db = Db::getInstance();

        $id = intval($id);

        $return = $db->prepare( 'UPDATE saless SET active = 0 WHERE id = :id' );
        $return->bindParam( ':id', $id );
        $return->execute();
    }
}
