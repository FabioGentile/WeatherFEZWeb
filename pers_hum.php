<?php
    require_once('session_check.php');
    require_once('WebServiceClient.php');
    require_once('chart/graph.php');
    require_once 'Utilis.php';

    $display_err_style = $_SESSION['errCode'] == ERR_NO_ERROR ? 'style="display: none;"' : 'style="display: block;"';
    
    //Controllo se mi sono arrivati dati dal form
    if (isset($_POST['hum_period']) === true) {
        switch ($_POST['hum_period']) {
            case PERIOD_5MINUTES:
                $_SESSION['hum_sel'] = PERIOD_5MINUTES;
                break;
            case PERIOD_30MINUTES:
                $_SESSION['hum_sel'] = PERIOD_30MINUTES;
                break;
            case PERIOD_3HOURS:
                $_SESSION['hum_sel'] = PERIOD_3HOURS;
                break;
            default:
                $_SESSION['hum_sel'] = PERIOD_5MINUTES;
                break;
        }
    } 
    else {
        if(isset($_SESSION['hum_sel']) == false)
            $_SESSION['hum_sel'] = PERIOD_5MINUTES;
    }
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
                            <h2>Welcome to your personal page</h2>
                            <br>
                            <div class="container-fluid">
                                <!-- Alert di errore -->
                                <?php require_once('error_alert.php') ?>
                                <!-- contenuto della pagina -->
                                <div class="row">
				    <form class="form-inline" role="form" action="pers_hum.php" method="POST">
									    					
				    <!--UMIDITA-->
				    
				    <div class="col-md-9">
                                        <h3>Humidity</h3>
									
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio1" 
						       value="<?php echo PERIOD_5MINUTES ?>" onclick="this.form.submit()"  
						       <?php if($_SESSION['hum_sel'] === PERIOD_5MINUTES) echo 'checked'; ?>> 5 Minutes
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio2" 
						       value="<?php echo PERIOD_30MINUTES ?>" onclick="this.form.submit()"
						       <?php if($_SESSION['hum_sel'] === PERIOD_30MINUTES) echo 'checked'; ?>> 30 Minutes
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio3" 
						       value="<?php echo PERIOD_3HOURS ?>" onclick="this.form.submit()"
						       <?php if($_SESSION['hum_sel'] === PERIOD_3HOURS) echo 'checked'; ?>> 3 Hours
					    </label>
					
                                        <?php		
					//Interrogo il WS per ottenere i dati
					$hum_value_string = WebServiceClient::get_humidity($_SESSION['token'], $_SESSION['hum_sel']);	
					//Ricavo la stringa da mettere nel grafico
					$title_tag = $_SESSION['hum_sel'] === PERIOD_5MINUTES ? 'Last 5 Minutes' : ($_SESSION['hum_sel'] === PERIOD_30MINUTES ? 'Last 30 Minutes' : 'Last 3 Hours');
					//Creo il grafico
					hum_chart($hum_value_string, $title_tag);
					
					echo '<img width="'.CHART_WIDTH.'" height="'.CHART_HEIGTH.'" src="chart/hum_graph.png"/>';
					?>									
                                    </div>
				    
				    </form>
                                </div>			
				
                            </div>
                        </div>
                        
                        <div class="row">
                            <br/>
                            <br>
                        </div>
                    </div>
		    
		    
                </div>		
            </div>
        </div>
    </body>
</html>