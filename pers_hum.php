<?php
    require_once('session_check.php');
    require_once('WebServiceClient.php');
    require_once('chart/graph.php');
    require_once 'Utilis.php';

    $display_err_style = $_SESSION['errCode'] == ERR_NO_ERROR ? 'style="display: none;"' : 'style="display: block;"';

    if (isset($_POST['hum_period']) === true) {
        switch ($_POST['hum_period']) {
            case PERIOD_HOUR:
                $_SESSION['hum_sel'] = PERIOD_HOUR;
                break;
            case PERIOD_DAY:
                $_SESSION['hum_sel'] = PERIOD_DAY;
                break;
            case PERIOD_WEEK:
                $_SESSION['hum_sel'] = PERIOD_WEEK;
                break;
            default:
                $_SESSION['hum_sel'] = PERIOD_HOUR;
                break;
        }
    } 
    else {
        if(isset($_SESSION['hum_sel']) == false)
            $_SESSION['hum_sel'] = PERIOD_HOUR;
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
						       value="<?php echo PERIOD_HOUR ?>" onclick="this.form.submit()"  
						       <?php if($_SESSION['hum_sel'] === PERIOD_HOUR) echo 'checked'; ?>> Hour
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio2" 
						       value="<?php echo PERIOD_DAY ?>" onclick="this.form.submit()"
						       <?php if($_SESSION['hum_sel'] === PERIOD_DAY) echo 'checked'; ?>> Day
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio3" 
						       value="<?php echo PERIOD_WEEK ?>" onclick="this.form.submit()"
						       <?php if($_SESSION['hum_sel'] === PERIOD_WEEK) echo 'checked'; ?>> Week
					    </label>
					
                                        <?php					
					$hum_value_string = WebServiceClient::get_humidity($_SESSION['token'], $_SESSION['hum_sel']);		
					$title_tag = $_SESSION['hum_sel'] === PERIOD_HOUR ? 'Last Hour' : ($_SESSION['hum_sel'] === PERIOD_DAY ? 'Last Day' : 'Last Week');
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