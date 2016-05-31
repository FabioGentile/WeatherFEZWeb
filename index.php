<?php
    require_once('session_check.php');
    $display_err_style= $_SESSION['errCode'] == ERR_NO_ERROR ? 'style="display: none;"' : 'style="display: block;"';
?>
<!DOCTYPE html>
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
                            <h1>HOME</h1>
                            <div class="container-fluid">
                                <!-- Alert di errore -->
                                <?php require_once('error_alert.php') ?>

                                <!-- contenuto della pagina -->
                                <div class="row">
                                    <div class="col-md-6">                     
                                        <?php
                                            
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
