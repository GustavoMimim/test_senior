<h1>Usuários</h1>

<table class="table">

	<thead>
		<tr>
			<th scope="col">Código</th>
			<th scope="col">Usuário</th>
			<th scope="col">Tipo</th>
            <th scope="col">Ações</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($users as $user) : ?>
			<tr>
				<th scope="row">
					<?php echo $user->id; ?>
				</th>
				<td>
					<?php echo $user->username; ?>
				</td>
				<td>
					<?php echo $user->description; ?>
				</td>
				<td>
					<a href="?controller=users&action=delete&id=<?php echo $user->id; ?>" class="btn btn-icon-primary"><i data-feather="x-square"></i></a>
				</td>
			<tr>
		<?php endforeach; ?>
	</tbody>

</table>

<a href="?controller=users&action=insert" class="btn btn-primary">Adicionar <i data-feather="user-plus"></i></a>