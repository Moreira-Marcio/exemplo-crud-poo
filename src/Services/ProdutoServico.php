<?php

namespace ExemploCrud\Services;


use Exception;
use PDO;
use Throwable;
use ExemploCrud\Database\ConexaoBD;
use ExemploCrud\Models\Produto;


final class ProdutoServico
{
    private PDO $conexao;
 

    public function __construct()
    {
        $this->conexao = ConexaoBD::getConexao();
      
    }

    public function listarTodos(): array
    {
        $sql = "SELECT 
                produtos.id, produtos.nome AS produto, 
                produtos.preco, produtos.quantidade,
                (produtos.preco * produtos.quantidade) AS total,
                fabricantes.nome AS fabricante
            FROM produtos INNER JOIN fabricantes
            ON produtos.fabricante_id = fabricantes.id
            ORDER BY produto";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar produtos: " . $erro->getMessage());
        }
    }

    public function inserir(Produto $produto): void
    {
        $sql = "INSERT INTO produtos(nome, preco, quantidade, fabricante_id, descricao) 
                VALUES(:nome, :preco, :quantidade, :fabricante_id, :descricao)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $produto->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":preco", $produto->getPreco(), PDO::PARAM_STR);
            $consulta->bindValue(":quantidade", $produto->getQuantidade(), PDO::PARAM_INT);
            $consulta->bindValue(":fabricante_id", $produto->getFabricanteId(), PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $produto->getDescricao(), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: " . $erro->getMessage());
        }
    }




}