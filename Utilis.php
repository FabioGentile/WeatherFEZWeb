<?php
    define('HOUR_PERIOD', 1);
    define('DAY_PERIOD', 2);
    define('WEEK_PERIOD', 3);

    define('NEWLINE', "<br />\n");

    define("ERR_NO_ERROR",0);

    define("MAX_USN_LEN",20);
    define("MAX_PWD_LEN",32);

    //----------DEFINIZIONE LIVELLI SICUREZZA-------------//
    define("SEC_PUBLIC",0);          //pagine pubbliche, (home)
    define("SEC_LOGGED",1);          //pagine visibili solo ai loggati +timeout +ssl
    define("SEC_ONLY_GUEST",2);      //pagine visibili solo ai NON loggati (registrazione, login)

    //---------DEFINIZIONE ALTRE COSE---------------------//
    define("ALFANUM_REGEXP","/\W+/");
    define("ALFANUM_SPACE_REGEXP","/[^a-zA-Z0-9_ ]+/");   //match con tutto tranne alfanum _ e spazio

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
        echo '
        <pre>';
            print_r($array);
            echo '</pre>
        <br>';
    }

    function create_sec_entry($sec_lvl){
        $ret=array(
        "sec_lvl" => $sec_lvl,
        );
        return $ret;
    }

    function Redirect($relUrl){
        $server_path = rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
        $base = 'http://';
        //echo "<br>sono in redirect ->".$base . $_SERVER['HTTP_HOST'] . $server_path . $relUrl;
        header('Location: ' . $base . $_SERVER['HTTP_HOST'] . $server_path . $relUrl); 
        die();
    }

    function setError($errCode=ERR_NO_ERROR, $errMsg=""){
        $_SESSION['errCode'] = $errCode;
        $_SESSION['errMsg'] = $errMsg;
    }