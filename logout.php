<?php
   require_once('session_check.php');
   require_once('utilis.php');

   //Cancello i dati della sessione
   session_unset();
   session_destroy();   

   Redirect('index.php');
?>