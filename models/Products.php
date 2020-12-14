<?php
class Product
{
    public function __construct($id, $description, $price)
    {
        $this->id          = $id;
        $this->description = $description;
        $this->price       = $price;
    }

    public static function all()
    {
        $list = [];
        $db = Db::getInstance();
        $req = $db->query('SELECT id, description, price FROM products WHERE active = 1');

        foreach ($req->fetchAll() as $product) {
            $list[] = new Product($product['id'], $product['description'], 'R$ ' . number_format($product['price'], 2, ',', ' '));
        }

        return $list;
    }

    public static function find( $id ) {
        $db = Db::getInstance();
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM products WHERE id = :id');
        $req->execute(array('id' => $id));
        $product = $req->fetch();

        return new Product( $product['id'], $product['description'], $product['price'], $product['active'] );
    }

    public static function insert( $request )
    {
        $db = Db::getInstance();

        $active = isset( $request['activated'] ) ? 1 : 0;

        $return = $db->prepare( 'INSERT INTO products (description, price, active) VALUES (:description, :price, :activated)' );
        $return->bindValue( ':description', $request['description'] );
        $return->bindValue( ':price', $request['price'] );
        $return->bindValue( ':activated', $active );
        $return->execute();
    }

    public static function delete( $id )
    {
        $db = Db::getInstance();

        $id = intval($id);

        $return = $db->prepare( 'UPDATE products SET active = 0 WHERE id = :id' );
        $return->bindParam( ':id', $id );
        $return->execute();
    }
}
