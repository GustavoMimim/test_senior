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
        $req = $db->query('SELECT id, description, price FROM products');

        foreach ($req->fetchAll() as $product) {
            $list[] = new Product($product['id'], $product['description'], 'R$ ' . number_format($product['price'], 2, ',', ' '));
        }

        return $list;
    }

    public static function find($id)
    {
        $db = Db::getInstance();
        
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM products WHERE id = :id');
        
        $req->execute(array('id' => $id));
        $product = $req->fetch();

        return new Product($product['id'], $product['description'], $product['price']);
    }
}
