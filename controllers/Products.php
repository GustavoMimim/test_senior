<?php
class ProductsController
{

    public function __construct()
    {
        require_once( 'models/products.php' );
    }

    public function index()
    {
        $products = Product::all();
        require_once( 'views/products/index.php' );
    }

    public function insert()
    {
        if( empty( $_POST ) ) {
            require_once( 'views/products/new.php' );
        } else {            
           Product::insert( $_POST );
           unset( $_POST );
           Redirect( '?controller=products&action=index' );
        }
    }

    public function delete()
    {      
        if ( ! isset( $_GET['id'] ) )
            return error( 'Não foi possível encontrar o produto á ser removido' );

        Product::delete( $_GET['id'] );

        Redirect( '?controller=products&action=index' );
    }
}
