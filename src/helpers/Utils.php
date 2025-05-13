<?php 

namespace ExemploCrud\Helpers;

use Throwable;

final class Utils {
    private function __construct() {// usamos o construtor privado vazio bloqueamos  a criação de objeto/instancia
}

    public static function dump(mixed $dados):void {
        echo "<pre>".var_dump($dados)."</pre>";
    }

    public static function formatarPreco( float $valor ):string {
    $precoFormatado = "R$ " .number_format($valor, 2, ",", ".");
    return $precoFormatado;
}
}