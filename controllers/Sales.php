<?php
class SalesController
{

    public function __construct()
    {
        require_once( 'models/sales.php' );
        require_once( 'models/products.php' );
        require_once( 'models/saleitems.php' );
    }

    public function index()
    {
        $sales = Sale::all();

        foreach ($sales as $sale) {
            $total = SaleItem::total_value_of_sale( $sale->id );
            $sale->total_value = 'R$ ' . number_format($total, 2, ',', ' ');
        }

        require_once( 'views/sales/index.php' );
    }

    public function show()
    { 
        if ( ! isset($_GET['id']) )
		    error('Não foi possível encontrar a venda solicitada.');

        $sale     = Sale::find( $_GET['id'] );
        $items    = SaleItem::items_of_sale( $_GET['id'] );
        $products = Product::all();

        // Procuramos as descrições de cada item vendido
        foreach( $items as &$item ) {
            foreach($products as $product) {
                if ($item->id_product == $product->id)
                    $item->description = $product->description;                
            }
        }

        unset ( $item );

        require_once( 'views/sales/new.php' );
    }

    public function insert()
    {
        $saleID = Sale::insert();

        $sale = Sale::find( $saleID );
        $products = Product::all();

        unset( $saleID );

        require_once( 'views/sales/new.php' );
    }

    public function update()
    {

        try {

            if( isset( $_POST['confirm'] ) )
                $request['confirm'] = $_POST['confirm'] === 'on' ? 1 : 0;
            else
                $request['confirm'] = 0;
        
            $request['id'] = $_POST['id'];

            $saleID = Sale::update( $request );

            // Se novos items foram vendidos
            if( isset( $_POST['products-sale-code'] ) ) {

                // Organizamos com o código e quantidade vendida
                foreach( $_POST['products-sale-code'] as $index => $product) {
                    $request['products-sold'][$index]['code']     = $_POST['products-sale-code'][$index];
                    $request['products-sold'][$index]['quantity'] = $_POST['products-sale-quantity'][$index];
                }

                //adicionamos na base de dados com o valor de venda do item
                foreach( $request['products-sold'] as $index => $product_sold) {
                    $product = Product::find( $product_sold['code'] );

                    $item = new SaleItem(
                        $saleID, 
                        $product->id, 
                        $product->price, 
                        $product_sold['quantity']
                    );

                    SaleItem::insert( $item );
                }
            }

            unset( $_POST );

            redirect( '?controller=sales&action=show&id=' . $saleID );

        } catch (Exception $e) {
            error($e);
        }
    }

    public function delete()
    {      
        if ( ! isset( $_GET['id'] ) )
            return error( 'Não foi possível encontrar o produto á ser removido' );

        Sale::delete( $_GET['id'] );

        Redirect( '?controller=sales&action=index' );
    }
}
