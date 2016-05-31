<?php

define('HOUR_PERIOD', 1);
define('DAY_PERIOD', 2);
define('WEEK_PERIOD', 3);

define('NEWLINE', "<br />\n");


/**
 * Genero una stringa random (caratteri esadecimali)
 * @param int $len lunghezza della stringa
 * @return string
 */
function random_string($len) {
    $ret = bin2hex(openssl_random_pseudo_bytes($len));
    return substr($ret, 0, $len);
}

/**
 * Stampo un array formattato
 * @param array $array l'array da stampare
 */
function pprint_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre><br>';
}

