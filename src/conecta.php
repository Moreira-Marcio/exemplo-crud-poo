<?php
//parametros de conexao
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "vendas";

/* configuraçoes para conexao de banco de dados*/
//bloco tray/catch
//passamos no tryu tudoque queremosque seja feito(as ações de confi/conexao bd)
try {
    $conexao = new PDO(
        "mysql:host=$servidor;dbname=$banco;charset=utf8",
        $usuario,
        $senha

    );
    $conexao->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (Exception $erro) {
    die("deu ruim: " . $erro->getMessage());
}

//criando conexão com o bando ucando a classe pdo
//pdo (php data object): classe para manipulação de banco de dador



/* configurar pdo para lançar execeçoes/erros caso ocorram */
