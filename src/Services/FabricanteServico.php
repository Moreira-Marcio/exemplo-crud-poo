<?php 

namespace ExemploCrud\Services;

use ExemploCrud\ConexaoBD;
use Exception;
use PDO;
use Throwable;

final  class FabricanteServico
{
    private PDO $conexao;

    public function __construct() {
        $this->conexao = ConexaoBD::getConexao();
    }

    public function listarTodos():array {
        $sql = "SELECT * FROM fabricantes WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
    
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Throwable $erro) {
            throw new Exception("Erro ao carregar fabricante: ".$erro->getMessage());
        }  
    }
}
