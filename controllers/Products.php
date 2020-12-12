<?php
class ProductsController
{

    public function __construct()
    {
        require_once('models/products.php');
    }

    public function index()
    {
        $products = Product::all();
        require_once('views/products/index.php');
    }

    public function show()
    {
        if (!isset($_GET['id']))
            return call('pages', 'error');

        $product = User::find($_GET['id']);
        require_once('views/products/show.php');
    }
}
