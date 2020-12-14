<div class="row align-items-center">    
	<div class="col ">
		<h1>Produtos</h1>
	</div>
	<div class="col text-end">
        <a href="?controller=products&action=insert" class="btn btn-primary">Adicionar <i data-feather="file-plus"></i></a>
	</div>
</div>

<table class="table">

    <?php if ( empty ( $products ) ) : ?>

        <h4>Ainda não existe nenhum registro no sistema.</h4>

    <?php else : ?>
        <thead>
            <tr>
                <th scope="col">Código</th>
                <th scope="col">Descrição</th>
                <th scope="col">Preço</th>
                <th scope="col">Ações</th>
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
                    <td>
                        <a href="?controller=products&action=delete&id=<?php echo $product->id; ?>" class="btn btn-icon-danger"><i data-feather="x-square"></i></a>
                    </td>
                <tr>
            <?php endforeach; ?>
        </tbody>
    <?php endif; ?>

</table>