<?php
//trazendo os dados do json
$produto = file_get_contents('produtos.json');

$produtodec = json_decode($produto, true);
//achando a posicao do id
$posicao = array_search($_GET["id"], array_column($produtodec,"id"));
//se algo for passado pelo formulario
if($_POST){

$produtodec[$posicao] ["nome"] = $_POST["nome"];
$produtodec[$posicao] ["preco"] = $_POST["preco"];
$produtodec[$posicao] ["descricao"] = $_POST["descricao"];

//inserindo arquivo
$extensao = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

$nomefile = "produto". $cadastrarproduto ["id"]. "." . $extensao;

$arquivo = $_FILES["file"]["tmp_name"];

$cadastrarproduto["foto"] = "fotosprod/". $nomefile;

$movendo = move_uploaded_file($arquivo, $cadastrarproduto["foto"]);

//inserindo os dados alterados no json
$alterar = json_encode($produtodec);

file_put_contents('produtos.json' , $alterar);
}


?>


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
      <h2>Editar Produto</h2>


      <form method="post" enctype="multipart/form-data">


        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $produtodec[$posicao]["nome"]; ?> ">
          </div>
          <div class="form-group col-md-6">
            <label for="preco">Preço</label>
            <input type="number" class="form-control" id="preco" name="preco" value="<?php echo $produtodec[$posicao]["preco"]; ?>">
          </div>
        </div>

        <div class="form-group">
          <label for="descricao">Descrição</label><br>
          <textarea class="form-control" name="descricao" rows="10"><?php echo $produtodec[$posicao]["descricao"]; ?></textarea>
        </div>
        <div>
            <img src="" alt="">
        </div>
        <div class="custom-file">
          <input type="file" class="custom-file-input" id="customFile" name="file">
          <label class="custom-file-label" for="customFile">Escolher arquivo</label>
        </div>

        <button class="btn btn-primary btn-block mt-2" type="submit">Editar</button>
      </form>
    </div>










</body>

</html>