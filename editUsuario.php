<?php

session_start();
if (empty($_SESSION)) {
	header("Location:login.php");
	exit;
}

//pegando os dados no json
$usuario = file_get_contents('usuarios.json');

$usuariodec = json_decode($usuario, true);

//achando a posicao do email
$posicao = array_search($_GET["email"], array_column($usuariodec, "email"));

//se algo for passado pelo formulario
if ($_POST) {

	$usuariodec[$posicao]["nome"] = $_POST["nome"];
	$usuariodec[$posicao]["email"] = $_POST["email"];

	if ($_POST["senha"]) {

		
		//fazendo um if para verificar a senha
		if ($_POST["senha"] != $_POST["confirmasenha"]) {
			echo "Confirmação de senha inválida";
		} else {
			
			$usuariodec[$posicao]["senha"] = password_hash($_POST["senha"], PASSWORD_DEFAULT);
		}
	}

	//inserindo os dados alterados no json
	$alterar = json_encode($usuariodec);

	file_put_contents('usuarios.json', $alterar);
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

	<div class="stick-top">
		<?php require('./includes/navbar.php'); ?>
	</div>
</head>

<body>


	<main class="container">



		<!-- início do cadastro -->
		<div>




			<div class="mt-4">
				<h1>Editar Usuário</h1>

				<form method="post" enctype="multipart/form-data">

					<div class="form-group">
						<label for="nome">Nome:</label>
						<input type="text" class="form-control" id="nome" name="nome" value="<?php echo $usuariodec[$posicao]["nome"]; ?>">

					</div>

					<div class="form-group">
						<label for="email">E-mail:</label>
						<input type="email" class="form-control" id="email" name="email" value="<?php echo $usuariodec[$posicao]["email"]; ?>">
					</div>

					<div class="form-group">
						<label for="senha">Senha</label>
						<div style=font-size:14px;>Mínimo 6 caracterres</div>
						<input type="password" class="form-control" id="senha" name="senha" value="">
					</div>

					<div class="form-group">
						<label for="confirmasenha">Confirmar Senha</label>
						<input type="password" class="form-control" id="confirmasenha" name="confirmasenha" value="">
					</div>
					<button class="btn btn-warning btn-block mt-2" type="submit">Editar</button>
				</form>



			</div>
	</main>


</body>

</html>