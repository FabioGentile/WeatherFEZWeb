<?php
    require_once('utilis.php');

    session_start();

    //definizione livelli pagine
    $page_sec_level = array(
        "index.php" => create_sec_entry(SEC_PUBLIC),
        "menu.php" => create_sec_entry(SEC_PUBLIC),
        "logout.php" => create_sec_entry(SEC_ONLY_GUEST),
        "session_check.php" => create_sec_entry(SEC_PUBLIC),

        "pers_hum.php" => create_sec_entry(SEC_LOGGED),
        "pers_temp.php" => create_sec_entry(SEC_LOGGED),
        "pers_lum.php" => create_sec_entry(SEC_LOGGED),
        "pers_press.php" => create_sec_entry(SEC_LOGGED),

        "login.php" => create_sec_entry(SEC_ONLY_GUEST),
        "reg.php" => create_sec_entry(SEC_ONLY_GUEST),
        "login_check.php" => create_sec_entry(SEC_ONLY_GUEST),
        "reg_check.php" => create_sec_entry(SEC_ONLY_GUEST)
    );

    //variabili che mi memorizzano lo stato generale dell'interazione con l'utente
    $_SESSION['curr_page_sec_lvl'] = $page_sec_level[basename($_SERVER['PHP_SELF'])]['sec_lvl'];
    $_SESSION['am_i_logged']       = (!isset($_SESSION['token']) || empty($_SESSION['token'])) ? false : true;

    //se la pagina corrente richiede il login, ma nella sessione non ho settato l'user ( = non sono loggato)
    if (!$_SESSION['am_i_logged'] && $_SESSION['curr_page_sec_lvl'] == SEC_LOGGED) {
        setError(ERR_GENERIC, htmlspecialchars("Accesso non autorizzato, login necessario"));
        Redirect("index.php");
    }

    if (!isset($_SESSION['errCode']))
        setError();
?>