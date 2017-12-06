<?php

if (!isset($_SESSION['s_login'])) {
    header('location: login.php');
    die;
}
class Check {

    private static $Data;
    private static $Data2;
    private static $Format;

    public static function VerificarDocumento($TipoPessoa, $Documento) {
        self::$Data = (string) $TipoPessoa;
        self::$Data2 = (string) $Documento;
        self::$Data = strip_tags(trim(self::$Data));
        self::$Data2 = strip_tags(trim(self::$Data2)); // Elimina possivel mascara
        self::$Data2 = preg_replace('/[^0-9]/', '', self::$Data2);

        if (empty(self::$Data2)):
            return FALSE;
        elseif (self::$Data === 'F' || self::$Data === 'f'):
            if (strlen(self::$Data2) != 11):
                return FALSE;
            elseif (self::$Data2 === '00000000000' ||
                    self::$Data2 === '11111111111' ||
                    self::$Data2 === '22222222222' ||
                    self::$Data2 === '33333333333' ||
                    self::$Data2 === '44444444444' ||
                    self::$Data2 === '55555555555' ||
                    self::$Data2 === '66666666666' ||
                    self::$Data2 === '77777777777' ||
                    self::$Data2 === '88888888888' ||
                    self::$Data2 === '99999999999'):
                return FALSE;
            else:
                for ($t = 9; $t < 11; $t++):
                    for ($d = 0, $c = 0; $c < $t; $c++):
                        $d += self::$Data2{$c} * (($t + 1) - $c);
                    endfor;

                    $d = ((10 * $d) % 11) % 10;

                    if (self::$Data2{$c} != $d):
                        return false;
                    endif;
                endfor;

                return true;
            endif;
        elseif (self::$Data === 'J' || self::$Data === 'j'):
            if (strlen(self::$Data2) != 14):
                return FALSE;
            else:
                for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++):
                    $soma += self::$Data2{$i} * $j;
                    $j = ($j == 2) ? 9 : $j - 1;
                endfor;

                $resto = $soma % 11;

                if (self::$Data2{12} != ($resto < 2 ? 0 : 11 - $resto))
                    return false;

                for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++):
                    $soma += self::$Data2{$i} * $j;
                    $j = ($j == 2) ? 9 : $j - 1;
                endfor;

                $resto = $soma % 11;
                return self::$Data2{13} == ($resto < 2 ? 0 : 11 - $resto);
            endif;
        else:
            return FALSE;
        endif;
    }

}

?>