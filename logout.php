<?php
   require_once('session_check.php');
   require_once('utilis.php');

   session_unset();
   session_destroy();   

   Redirect('index.php',false);
?>