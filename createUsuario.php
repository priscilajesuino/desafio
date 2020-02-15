<?php


//pegando os dados no json
$usuario = file_get_contents('usuarios.json');

$usuariodec = json_decode($usuario, true);

if (isset($_POST["adicionar"])) {
	//fazendo um if para verificar a senha
	if ($_POST["senha"] != $_POST["confirmasenha"]) {
		echo "Confirmação de senha inválida";
	} else {
		$dadosusuario = array(
			"nome" => $_POST["nome"],
			"email" => $_POST["email"],
			"senha" => password_hash($_POST["senha"], PASSWORD_DEFAULT)
		);

		//inserir os dados no json
		$usuariodec[] = $dadosusuario;
		$inserirusuario = json_encode($usuariodec);
		file_put_contents('usuarios.json', $inserirusuario);
	}
}

//excluir os usuarios
if(isset($_POST["excluir"])){


	$posicao = array_search($_POST["email"], array_column($usuariodec,"email"));
	
	
	//deletando os dados
	unset($usuariodec[$posicao]);
	
	
	//reordenando os arrays
	$reordena = array_values($usuariodec);
	
	//encoda os dados
	$encoda = json_encode($reordena);
	
	file_put_contents('usuarios.json' , $encoda);
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



</head>

<body>
	<div class="stick-top">
		<?php require('./includes/navbar.php'); ?>
	</div>
	<main class="container">



		<!-- início do cadastro -->
		<div class="row">

			<div class="col-md-5 my-3">
				<div class="card">
					<div class="card-body">

						<ul class="list-group list-group-flush">

							<li class="list-group-item">
								<h3>Usuários</h3>
							</li>

							<?php
							foreach ($usuariodec as $usuariotable) {
							?>
								<li class="list-group-item">
									<p><?php echo $usuariotable["nome"];  ?> </p>
									<p class="mt-2"><?php echo $usuariotable["email"];  ?> </p>
									<div class="btn-group-vertical">

										<a href="editUsuario.php?email=<?php echo $usuariotable["email"]; ?>" class="btn btn-primary my-3" type="submit">Editar</a href="editProduto.php?id=<?php ?>">
										<form action="" method="POST">
											<input type="text" name="email" value="<?php echo $usuariotable["email"];  ?>" hidden>
											<input class="btn btn-danger my-3" type="submit" value="excluir" name="excluir">
										</form>
									</div>
								</li>

							<?php } ?>
						</ul>
					</div>


				</div>

			</div>


			<div class="col-md-7 my-3">
				<h1>Criar Usuário</h1>

				<form method="post">

					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" class="form-control <?= $nomeOK ? '' : 'is-invalid'; ?>" id="usuario" name="nome" placeholder="Nome" required>
						<div class="invalid-feedback">Digite um nome válido</div>
					</div>

					<div class="form-group">
						<label for="email">E-mail:</label>
						<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
					</div>

					<div class="form-group">
						<label for="senha">Senha</label>
						<div style=font-size:14px;>Mínimo 6 caracterres</div>
						<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" minlength="6" required>
					</div>

					<div class="form-group">
						<label for="senha">Confirmar Senha</label>
						<input type="password" class="form-control" id="senha" name="confirmasenha" placeholder="Senha" minlength="6" required>
					</div>
					<button class="btn btn-primary btn-block" type="submit" name="adicionar">Adicionar</button>
				</form>
			</div>


		</div>
	</main>


</body>

</html>