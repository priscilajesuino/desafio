<?php


if ($_POST){

	session_start();
//pegando os dados no json
$usuario = file_get_contents('usuarios.json');

$usuariodec = json_decode($usuario, true);

//achando a posicao do email
$posicao = array_search($_POST["email"], array_column($usuariodec,"email"));

if
(password_verify($_POST["senha"], $usuariodec[$posicao]["senha"]))
{ 
	$_SESSION["ok"] = true;
	header("Location:indexProduto.php");
	
} else{
	echo "senha inválida";
}
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
<nav class="navbar navbar-dar" style="background-color: black; color: white"><h4>
&lt;Desafio PHP/&gt;
</h4>


</nav>

	<main class="container">

		

		<!-- início do login -->
		<div class="row">
			<div class="col-6 offset-3 my-4">

				<form method="post">

					<div class="form-group">
						<label for="nome">E-mail</label>
						<input type="text" class="form-control <?= $nomeOK ? '' : 'is-invalid'; ?>" id="email" name="email" placeholder="usuario" required>
						<div class="invalid-feedback">Digite um E-mail válido</div>
					</div>

					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="password" class="form-control" id="senha" name="senha" placeholder="senha" required>
                    </div>
                    
                    <div>
                        <a href="createUsuario.php">Ainda não tenho cadastro</a>
                    </div>
					<button class="btn btn-primary btn-block mt-2" type="submit">Logar</button>
				</form>
			</div>

		</div>
	</main>
	<div style="height: 270px;">

	</div>
	
</body>

</html>
