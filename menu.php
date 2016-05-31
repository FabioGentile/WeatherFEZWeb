<ul class="nav nav-pills nav-stacked">
<?php
    $curr_page = basename($_SERVER['PHP_SELF']);

    function menu_format($target, $current, $desc)
    {
        $ret = sprintf('<li role="presentation" %s><a href="%s">%s</a></li>', ($target == $current) ? "class=\"active\"" : "", $target, $desc);
        return $ret;
    }

    echo menu_format("index.php", $curr_page, "Home");

    if (!$_SESSION['am_i_logged']) { //pagine per i non loggati (login e registra)
        echo menu_format("login.php", $curr_page, "Login");
        echo menu_format("reg.php", $curr_page, "Registrati");
    } else { //pagine per i loggati (logout e personale)
        echo menu_format("pers.php", $curr_page, "Pagina Personale");
        echo menu_format("logout.php", $curr_page, "Logout");
    }

    unset($curr_page);
?>
</ul>
