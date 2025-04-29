<?php
require_once "../src/funcoes-produtos.php";
$listaDeProdutos=listarProdutos($conexao);
require_once "../src/funcoes-utilitarias.php";
//obtendo valor do parametro via url
$id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);

//chamando a função para carregar os dados de um fabricante
$produtos = listarProdutos($conexao, $id);


?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Visualização</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-2 shadow-lg rounded pb-1">
        <h1><a class="btn btn-dark btn-lg" href="../index.php">Home</a> Produtos | SELECT</h1>

        <hr>
        <h2>Lendo e carregando todos os produtos.</h2>

        <p><a class="btn btn-primary btn-sm" href="inserir.php">Inserir novo produto</a></p>
        
        <div class="row g-1">
        <?php foreach ($listaDeProdutos as $produtos): ?> 
            <div class="col-sm-6 rounded-2 border border-primary border border-3">
                <article class="bg-body-secundary p-2">
                    <h3> Produto: <?=$produtos["produto"]?></h3>
                    <h4>Fabricante do Produto <?=$produtos["fabricante"]?></h4>
                    <p><b>Preço:</b> <?=formatarPreco($produtos["preco"])?></p>
                    <p><b>Quantidade: </b><?=$produtos["quantidade"]?></p>
                    <p><b>Total: </b><?=formatarPreco($produtos["preco"]*$produtos["quantidade"])?></p>
                    <a class="btn btn-warning btn-sm" href="atualizar.php?id=<?=$produtos['id']?>">Atualizar</a>
                    <a class="btn btn-danger" href="excluir.php?id=<?=$produto["id"]?>">Excluir</a>
                </article>
            </div>
          <?php endforeach; ?>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>