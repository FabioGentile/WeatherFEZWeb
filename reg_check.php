<?php
    require_once('session_check.php');

    setError();

    //SESSION[user] non settato, l'utente e' arrivato qua perche' vuole registrarsi
    if (empty($_POST['username_p']) || empty($_POST['password_p'])) {
        setError(ERR_NO_USN_PWD, "Username o password mancanti");
        Redirect('reg.php');
    }

    $usr = trim($_POST['username_p']);
    $pwd = $_POST['password_p'];

    if (preg_match(ALFANUM_REGEXP, $usr)) { //ci sono simboli nell'username
        setError(ERR_UNSAFE_STRING, htmlspecialchars("L'username contiene caratteri non validi, inserire solo lettere numeri e _"));
        Redirect('reg.php');
    }

    if (strlen($usr) > MAX_USN_LEN) { //check lunghezza username
        setError(ERR_USN_TOO_LONG, htmlspecialchars("L'username e troppo lungo, lunghezza max " . MAX_USN_LEN . " caratteri"));
        Redirect('reg.php');
    }

    if (strlen($pwd) > MAX_PWD_LEN) { //check lunghezza pwd
        setError(ERR_PWD_TOO_LONG, htmlspecialchars("La password inserita e troppo lunga, lunghezza max " . MAX_PWD_LEN . " caratteri"));
        Redirect('reg.php');
    }

    try {
        //chiamo ws reg
    }
    catch (Exception $e) {
        setError(ERR_MYSQL, $e->getMessage() . $sql_er_out);
        db_close_conn();

        Redirect('reg.php');
    }
    Redirect('login.php');

?>   