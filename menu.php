<ul class="nav nav-pills nav-stacked">
<?php
    $curr_page = basename($_SERVER['PHP_SELF']);

    //Funzione per creare l'entry nel menu, evidenzio la pagina corrente
    function menu_format($target, $current, $desc)
    {
        $ret = sprintf('<li role="presentation" %s><a href="%s">%s</a></li>', ($target == $current) ? "class=\"active\"" : "", $target, $desc);
        return $ret;
    }

    echo menu_format("index.php", $curr_page, "Home");

    if (!$_SESSION['am_i_logged']) { //pagine per i non loggati (login e registra)
        echo menu_format("login.php", $curr_page, "Login");
        echo menu_format("reg.php", $curr_page, "Registration");
    } else { //pagine per i loggati (logout e personale)
        echo menu_format("pers_temp.php", $curr_page, "Temperature");
        echo menu_format("pers_hum.php", $curr_page, "Humidity");
        echo menu_format("pers_press.php", $curr_page, "Pressure");
        echo menu_format("pers_lum.php", $curr_page, "Luminosity");
        
        echo menu_format("logout.php", $curr_page, "Logout");
    }

    unset($curr_page);
?>
</ul>
