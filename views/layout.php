<DOCTYPE html>
	<html>

	<head>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="?controller=sales&action=index">Vendas</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarText">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" aria-current="page" href="?controller=users&action=index">Usuários</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="?controller=products&action=index">Produtos</a>
						</li>
					</ul>
					<span class="navbar-text">
						Desenvolvido por Gustavo Bergamo Mimim
					</span>
				</div>
			</div>
		</nav>

		<div class="container">
			<?php require_once('routes.php'); ?>
		</div>

		<script>
			feather.replace()
		</script>

		<style>
			.btn-icon-danger:hover {
				color: #dc3545;
			}
			.btn-icon-primary:hover {
				color: #0d6efd;
			}
			.margin-b-20 {
				margin-bottom: 20px;
			}
		</style>
	</body>

	</html>