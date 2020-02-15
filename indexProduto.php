<?php

$produto = file_get_contents('produtos.json');

$produtodec = json_decode($produto, true);


//excluir os arquivos
if(isset($_POST["excluir"])){


$posicao = array_search($_POST["id"], array_column($produtodec,"id"));

//delatar foto
unlink($produtodec[$posicao]["foto"]);

//deletando os dados
unset($produtodec[$posicao]);


//reordenando os arrays
$reordena = array_values($produtodec);

//encoda os dados
$encoda = json_encode($reordena);

file_put_contents('produtos.json' , $encoda);


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
<?php require ('./includes/navbar.php');?>
</div>

<div class="container mt-4" >
    <h2>Lista de produtos</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Nome</th>
      <th scope="col">Descrição</th>
      <th scope="col">Preço</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
      <?php
      foreach($produtodec as $produtotable){
      ?>
    <tr>
      <th scope="row"> <?php echo $produtotable["id"];  ?> </th>
      <td> <?php echo $produtotable["nome"];  ?> </td>
      <td> <?php echo $produtotable["descricao"];  ?></td>
      <td>R$ <?php echo $produtotable["preco"];  ?> </td>
      <td>
          
      <a href="editProduto.php?id=<?php echo $produtotable["id"];?>" class="btn btn-primary my-3" type="submit">Editar</a href="editProduto.php?id=<?php ?>">
      <form action="" method="POST">
          <input type="text" name="id" value="<?php echo $produtotable["id"];  ?>" hidden>
          <input class="btn btn-danger my-3" type="submit" value="Excluir" name="excluir">
        </form>
      
      </td>
      
    </tr>
      <?php } ?>
    
    
  </tbody>
</table>
</div>
</body>
</html>