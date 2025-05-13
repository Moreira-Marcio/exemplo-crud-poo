<?php

namespace ExemploCrud\Services;

use ExemploCrud\Database\ConexaoBD;
use Exception;
use ExemploCrud\Models\Fabricante;
use PDO;
use Throwable;


final  class FabricanteServico
{
    private PDO $conexao;

    public function __construct()
    {

        $this->conexao = ConexaoBD::getConexao();
    }

    public function listarTodos(): array
    {
        $sql = "SELECT * FROM fabricantes ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();

            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar fabricante: " . $erro->getMessage());
        }
    }

    public function inserir(Fabricante $fabricante): void
    {

        $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $fabricante->getNome(), PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: " . $erro->getMessage());
        }
    }

    public function buscarPorId(int $id): ?array // ?array indica que pode retornar null
    {
        $sql = "SELECT * FROM fabricantes WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
            // guardamos oresultado da operação fetch em uma variavel
           // $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            //se o resultado for verdadeiro,retornamos ele.senão retornamos null
            //return $resultado ? $resultado: null; // Retorna null se não encontrar

            /* Usamos o fetch para garantir o retorno
        de um único array associativo com o resultado */
            return $consulta->fetch(PDO::FETCH_ASSOC) ?: null;//ternario simplificado usando o 'elvis operator'
        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar fabricante: " . $erro->getMessage());
        }
    }

    public function atualizar(Fabricante $fabricante): void
    {
        $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $fabricante->getNome(), PDO::PARAM_STR);
            $consulta->bindValue(":id", $fabricante->getId(), PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao atualizar fabricante: " . $erro->getMessage());
        }
    }

    public function excluir(int $id): void
    {
        $sql = "DELETE FROM fabricantes WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Throwable $erro) {
            throw new Exception("Erro ao excluir fabricante: " . $erro->getMessage());
        }
    }


}
