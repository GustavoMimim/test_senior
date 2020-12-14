<div class="row align-items-center">    
	<div class="col ">
		<h1>Vendas</h1>
	</div>
	<div class="col text-end">
		<a href="?controller=sales&action=insert" class="btn btn-primary">Adicionar <i data-feather="briefcase"></i></a>
	</div>
</div>

<table class="table">

	<thead>
		<tr>
			<th scope="col">Código</th>
			<th scope="col">Confirmado</th>
			<th scope="col">Data</th>
            <th scope="col">Valor Total</th>
            <th scope="col">Ações</th>
		</tr>
	</thead>

	<tbody>
        <?php foreach ($sales as $sales) : ?>

            <?php $class = $sales->confirm === 'Não' ? 'class="table-danger"' : ''; ?>

			<tr <?php echo $class ?>>
				<th scope="row">
					<?php echo $sales->id; ?>
				</th>
				<td>
					<?php echo $sales->confirm; ?>
				</td>
				<td>
					<?php echo $sales->created_at; ?>
				</td>
				<td>
					<?php echo $sales->total_value; ?>
				</td>
				<td>
					<a href="?controller=sales&action=show&id=<?php echo $sales->id; ?>" class="btn btn-icon-primary"><i data-feather="edit"></i></a>
					<a href="?controller=sales&action=delete&id=<?php echo $sales->id; ?>" class="btn btn-icon-danger"><i data-feather="x-square"></i></a>
				</td>
			<tr>
			<?php endforeach; ?>
	</tbody>

</table>