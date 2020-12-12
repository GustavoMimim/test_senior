<h1>Produtos</h1>

<table class="table">

    <thead>
        <tr>
            <th scope="col">Código</th>
            <th scope="col">Descrição</th>
            <th scope="col">Preço</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <th scope="row">
                    <?php echo $product->id; ?>
                </th>
                <td>
                    <?php echo $product->description; ?>
                </td>
                <td>
                    <?php echo $product->price; ?>
                </td>
            <tr>
        <?php endforeach; ?>
    </tbody>

</table>