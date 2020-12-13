<h1>Vendas</h1>

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
					<?php echo $sales->date; ?>
				</td>
				<td>
					<?php echo $sales->total_value; ?>
				</td>
				<td>
					<a href="?controller=saless&action=delete&id=<?php echo $sales->id; ?>" class="btn btn-icon-primary"><i data-feather="x-square"></i></a>
				</td>
			<tr>
			<?php endforeach; ?>
	</tbody>

</table>

<a href="?controller=sales&action=insert" class="btn btn-primary">Adicionar <i data-feather="briefcase"></i></a>