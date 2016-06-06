<?php
   require_once('session_check.php');
   $display_err_style= $_SESSION['errCode'] == ERR_NO_ERROR ? 'style="display: none;"' : 'style="display: block;"';

?>
<html lang="en">
    <head>
        <?php require_once('header.php'); ?>
    </head>
    <body>
        <!-- Intestazione -->
        <div class="container-fluid"> 
            <?php require_once('intestazione.php');  ?>
        </div>
        <!-- Corpo -->
        <div class="container">
            <div class="row">
                <div class="col-sm-3 st_menu">
                    <!-- menu laterale -->
                    <?php require_once('menu.php');  ?>
                </div>
		
                <div class="col-sm-9 st_main">
                    <div class="container-fluid">
                        <div class="row">
                            <h2>Benvenuto nella tua pagina personale</h2>
                            <br>
                            <div class="container-fluid">
                                <!-- Alert di errore -->
                                <?php require_once('error_alert.php') ?>
                                <!-- contenuto della pagina -->
                                <div class="row">
                                    <div class="col-md-9">
                                        <h3>DATIIIIIIIIIIIIIIIIII</h3>
                                        <?php
                                            
                                            
					?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
		    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Controlla le tue prenotazioni</h3>
                                <?php //recupero le prenotazioni fatte
                                    try{
                                    
                                    } 
                                    catch (Exception $e) {
                                       $sql_er = mysqli_error($conn);
                                       $sql_er_out = empty($sql_er)? "" : "\nMysql error -> ".$sql_er;
                                       
                                       setError(ERR_MYSQL, $e->getMessage() . $sql_er_out);
                                       db_close_conn();
                                       
                                       Redirect('index.php',false);  
                                    }
                                    			
				?>
                            </div>
                        </div>
                    </div>
		    
                </div>		
            </div>
        </div>
    </body>
</html>