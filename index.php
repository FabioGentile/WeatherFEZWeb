<?php
    require_once('session_check.php');
    require_once 'WebServiceClient.php';
    $display_err_style= $_SESSION['errCode'] == ERR_NO_ERROR ? 'style="display: none;"' : 'style="display: block;"';
?>
<!DOCTYPE html>
<html lang="en">
    <head title="WeatherFez">
        <?php require_once('header.php'); ?>
    <meta http-equiv="refresh" content="5;URL='index.php'">
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
                            <h1>Realtime Data<h1>
                            <div class="container-fluid">
                                <!-- Alert di errore -->
                                <?php require_once('error_alert.php') ?>

                                <!-- contenuto della pagina -->
                                <div class="row">
                                    <div class="col-md-9">    
                                        <?php
                                            $rt_val = WebServiceClient::get_instant_values();
                                            
                                            $instant_value = explode(";", $rt_val);                                        
                                        ?>
                                        
                                        <h3>Last measurement at: <?php echo $instant_value[0]; ?></h3>
                                        <table>
                                            <tr style="border-top: 10px solid transparent; border-bottom: 10px solid transparent; border-color: transparent;">
                                                <td width="100" heigth="1000"><img width="64" height="64" src="img/termometro.png"/></td>
                                                <td width="1000" heigth="1000"><?php echo isset($instant_value[1]) ? $instant_value[1] : '20'?> °C</td>                                        
                                            </tr>
                                            <tr style="border-top: 10px solid transparent; border-bottom: 10px solid transparent; border-color: transparent;">
                                                <td width="100" heigth="1000"><img width="64" height="64" src="img/water.png"/></td>
                                                <td width="1000" heigth="1000"><?php echo isset($instant_value[2]) ? $instant_value[2] : '50'?> %</td>
                                            </tr>
                                            <tr style="border-top: 10px solid transparent; border-bottom: 10px solid transparent; border-color: transparent;">
                                                <td width="100" heigth="1000"><img width="64" height="64" src="img/pressure.png"/></td>
                                                <td width="1000" heigth="1000"><?php echo isset($instant_value[3]) ? $instant_value[3] : '980.0'?> hPa</td>
                                            </tr>
                                            <tr style="border-top: 10px solid transparent; border-bottom: 10px solid transparent; border-color: transparent;">
                                                <td width="100" heigth="1000"><img width="64" height="64" src="img/sun.png"/></td>
                                                <td width="1000" heigth="1000"><?php echo isset($instant_value[4]) ? $instant_value[4] : '400'?> lux</td>
                                            </tr>
                                        </table>   
                                        
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
