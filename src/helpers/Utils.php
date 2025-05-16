<?php

namespace ExemploCrud\Helpers;

use Throwable;

final class Utils
{
    private function __construct()
    { // usamos o construtor privado vazio bloqueamos  a criação de objeto/instancia
    }

    public static function dump(mixed $dados): void
    {
        echo "<pre>" . var_dump($dados) . "</pre>";
    }

    public static function formatarPreco(float $valor): string
    {
        $precoFormatado = "R$ " . number_format($valor, 2, ",", ".");
        return $precoFormatado;
    }

    public static function registrarLog(Throwable $e): void
    {
        date_default_timezone_set('America/Sao_Paulo');

        $mensagem = "[" . date("Y-m-d H:i:s") . "]\n" .
            "Arquivo: " . $e->getFile() . "\n" .
            "Linha: " . $e->getLine() . "\n" .
            "Mensagem: " . $e->getMessage() . "\n\n";


        file_put_contents(__DIR__ . '/../../logs/erros.log', $mensagem, FILE_APPEND);
    }
}
