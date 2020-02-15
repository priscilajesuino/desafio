<?php

if ($_POST){

$cadastrarproduto = $_POST;

//pegando dados do json
$produto = file_get_contents('produtos.json');

$produtodec = json_decode($produto, true);

$elementos = count($produtodec);

//criando id
if ($elementos == 0){
  $cadastrarproduto ["id"] = 1;
}else{
  $id = $produtodec[$elementos-1]["id"];
  $cadastrarproduto ["id"] = $id+1;
}

//salvando arquivo
$extensao = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

$nomefile = "produto". $cadastrarproduto ["id"]. "." . $extensao;

$arquivo = $_FILES["file"]["tmp_name"];

$cadastrarproduto["foto"] = "fotosprod/". $nomefile;

$movendo = move_uploaded_file($arquivo, $cadastrarproduto["foto"]);

//inserindo dados no json
$produtodec[] =  $cadastrarproduto;

$inserir = json_encode($produtodec);

file_put_contents('produtos.json' , $inserir);
}
?>




<!DOCTYPE html>
<html lang="en">

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

  <div class="container">
    <div class="mt-3">
      <h2>Adicionar Produto</h2>


      <form method="post" enctype="multipart/form-data">


        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="nome" class="form-control" name="nome"  id="nome" placeholder="Nome" required>
          </div>
          <div class="form-group col-md-6">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" name="preco" id="preco" placeholder="Preço" required>
          </div>
        </div>

        <div class="form-group">
          <label for="descricao">Descrição</label><br>
          <textarea class="form-control" name="descricao" rows="10"></textarea>
        </div>

        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFile" name="file" required>
          <label class="custom-file-label" for="customFile">Escolher arquivo</label>
        </div>

        <button class="btn btn-primary btn-block mt-2" type="submit">Adicionar</button>
      </form>
    </div>










</body>

</html>