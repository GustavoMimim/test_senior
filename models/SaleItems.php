<?php
class SaleItem
{
	public function __construct($id_sale, $id_product, $price, $quantity)
	{
		$this->id_sale    = $id_sale;
		$this->id_product = $id_product;
		$this->price      = $price;
		$this->quantity   = $quantity;
	}

    public static function insert( $item )
    {
        $db = Db::getInstance();

        $return = $db->prepare( 'INSERT INTO sale_items (id_sale, id_product, price, quantity) VALUES (:id_sale, :id_product, :price, :quantity)' );
        $return->bindValue( ':id_sale',    $item->id_sale );
        $return->bindValue( ':id_product', $item->id_product );
        $return->bindValue( ':price',      $item->price );
        $return->bindValue( ':quantity',   $item->quantity );

        $return->execute();
    }

	public static function items_of_sale( $id_sale )
	{
        $list = [];

        $db = Db::getInstance();

        $req = $db->prepare( 'SELECT * FROM sale_items WHERE id_sale = :id_sale GROUP BY id_sale, id_product' );

        $req->bindValue( ':id_sale', $id_sale );

        $req->execute();

        foreach ($req->fetchAll() as $item) {
            $list[] = new SaleItem( $item['id_sale'], $item['id_product'], $item['price'], $item['quantity'] );
        }

        return $list;
    }

	public static function total_value_of_sale( $id_sale )
	{
        $db = Db::getInstance();

        $query = $db->prepare( 'SELECT IFNULL( SUM( price * quantity ), 0) AS total FROM sale_items WHERE id_sale = :id_sale' );

        $query->bindValue( ':id_sale', $id_sale );

        $query->execute();

        $return = $query->fetch();

        return $return['total'];
	}
}
