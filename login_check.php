<?php
    require_once('session_check.php');
    require_once('WebServiceClient.php');

    setError();

    //SESSION[user] non settato, l'utente e' arrivato qua perche' vuole fare il login
    if (empty($_POST['username_p']) || empty($_POST['password_p'])) {
        setError(ERR_NO_USN_PWD, "Username o password non presenti");
        Redirect('login.php');
    }

    $pwd = $_POST['password_p'];
    $usr = $_POST['username_p'];

    if (preg_match(ALFANUM_REGEXP, $usr)) { //ci sono simboli nell'username
        setError(ERR_UNSAFE_STRING, htmlspecialchars("L'username contiene caratteri non validi, inserire solo lettere numeri e _"));
        Redirect('login.php');
    }

    if (strlen($usr) > MAX_USN_LEN) { //check lunghezza username
        setError(ERR_USN_TOO_LONG, htmlspecialchars("L'username e troppo lungo, lunghezza max " . MAX_USN_LEN . " caratteri"));
        Redirect('login.php');
    }

    if (strlen($pwd) > MAX_PWD_LEN) { //check lunghezza pwd
        setError(ERR_PWD_TOO_LONG, htmlspecialchars("La password inserita e troppo lunga, lunghezza max " . MAX_PWD_LEN . " caratteri"));
        Redirect('login.php');
    }

    try {
	$token = WebServiceClient::login($usr, $pwd);	
	
	if($token === null || $token === ""){
	    setError(ERR_LOGIN, "Login failed, check credentials");	    
	    Redirect('login.php');
	}

        //istanzio la 'sessione' user
        $_SESSION['token'] = $token;
	$_SESSION['username'] = $usr;
        setError();
    }
    catch (Exception $e) {
        setError(ERR_LOGIN, "Login failed: " . $e->getMessage());
	
        Redirect('login.php');
    }

    Redirect('pers_temp.php'); //accesso effettuato
?>