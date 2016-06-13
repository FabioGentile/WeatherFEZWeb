<?php
    require_once('session_check.php');
    require_once('WebServiceClient.php');
    
    setError();

    if (empty($_POST['username_p']) || empty($_POST['password_p'])) {
        setError(ERR_GENERIC, "Username o password mancanti");
        Redirect('reg.php');
    }

    $usr = trim($_POST['username_p']);
    $pwd = $_POST['password_p'];
    
    //ci sono simboli nell'username
    if (preg_match(ALFANUM_REGEXP, $usr)) { 
        setError(ERR_GENERIC, htmlspecialchars("L'username contiene caratteri non validi, inserire solo lettere numeri e _"));
        Redirect('reg.php');
    }

    //check lunghezza username
    if (strlen($usr) > MAX_USN_LEN) { 
        setError(ERR_GENERIC, htmlspecialchars("L'username e troppo lungo, lunghezza max " . MAX_USN_LEN . " caratteri"));
        Redirect('reg.php');
    }

    //check lunghezza pwd
    if (strlen($pwd) > MAX_PWD_LEN) { 
        setError(ERR_GENERIC, htmlspecialchars("La password inserita e troppo lunga, lunghezza max " . MAX_PWD_LEN . " caratteri"));
        Redirect('reg.php');
    }

    try {
	//Richiamo il WS
	$token = WebServiceClient::register($usr, $pwd);
		
	if($token === null || $token === ""){
	    setError(ERR_LOGIN, "Registration failed");	    
	    Redirect('reg.php');
	}

        //istanzio la 'sessione' user
        $_SESSION['token'] = $token;        
	$_SESSION['username'] = $usr;
        setError();
    }
    catch (Exception $e) {
        setError(ERR_LOGIN, "Registration failed: " . $e->getMessage());
	
        Redirect('reg.php');
    }

    //Accesso effettuato
    //Entro nella sezione riservata
    Redirect('pers_temp.php'); 
    
?>   