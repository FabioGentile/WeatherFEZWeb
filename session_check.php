<?php
    require_once('utilis.php');

    session_start();

    /*echo "down:->".$navigator_down."<-<br>up:->".$_SESSION['navigator_up'];
    echo "<-<br>PHP_SELF " . $_SERVER['PHP_SELF']. "<br>HOST: ".$_SERVER['HTTP_HOST'];
    echo "<br>".rtrim(dirname($_SERVER['PHP_SELF']), '/\\') . '/';
    die();*/

    //definizione livelli pagine
    $page_sec_level = array(
        "index.php" => create_sec_entry(SEC_PUBLIC),
        "menu.php" => create_sec_entry(SEC_PUBLIC),
        "logout.php" => create_sec_entry(SEC_PUBLIC),
        "session_check.php" => create_sec_entry(SEC_PUBLIC),

        "pers.php" => create_sec_entry(SEC_LOGGED),

        "login.php" => create_sec_entry(SEC_ONLY_GUEST),
        "reg.php" => create_sec_entry(SEC_ONLY_GUEST),
        "login_check.php" => create_sec_entry(SEC_ONLY_GUEST),
        "reg_check.php" => create_sec_entry(SEC_ONLY_GUEST)
    );

    //variabili che mi memorizzano lo stato generale dell'interazione con l'utente
    //le salvo in sessione perche a questo punto sono certo di avere i cookie abilitati
    $_SESSION['curr_page_sec_lvl'] = $page_sec_level[basename($_SERVER['PHP_SELF'])]['sec_lvl'];
    $_SESSION['am_i_logged']       = (!isset($_SESSION['token']) || empty($_SESSION['token'])) ? false : true;

    //se la pagina corrente richiede il login, ma nella sessione non ho settato l'user (=non sono loggato)
    if (!$_SESSION['am_i_logged'] && $_SESSION['curr_page_sec_lvl'] == SEC_LOGGED) {
        setError(ERR_USER_NOT_LOGGED, htmlspecialchars("Accesso non autorizzato, login necessario"));
        Redirect("index.php");
    }

    if (!isset($_SESSION['errCode']))
        setError();
?>