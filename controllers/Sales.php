<?php
class SalesController
{

    public function __construct()
    {
        require_once( 'models/sales.php' );
        require_once( 'models/products.php' );
    }

    public function index()
    {
        $sales = Sale::all();
        require_once( 'views/sales/index.php' );
    }

    public function insert()
    {
        if( empty( $_POST ) ) {
            $products = Product::all();
            require_once( 'views/sales/new.php' );
        } else {            
           Product::insert( $_POST );
           unset( $_POST );
           Redirect( '?controller=sales&action=index' );
        }
    }

    public function delete()
    {      
        if ( ! isset( $_GET['id'] ) )
            return error( 'Não foi possível encontrar o produto á ser removido' );

        Product::delete( $_GET['id'] );

        Redirect( '?controller=sales&action=index' );
    }
}
