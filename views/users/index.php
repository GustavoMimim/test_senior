<h1>Usuários</h1>

<table class="table">

	<thead>
		<tr>
			<th scope="col">Código</th>
			<th scope="col">Usuário</th>
			<th scope="col">Tipo</th>
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
			<tr>
			<?php endforeach; ?>
	</tbody>

</table>