<?php
   require_once('session_check.php');
   require_once('WebServiceClient.php');
   require_once('chart/graph.php');
   require_once 'Utilis.php';

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
				    <form class="form-inline" role="form" action="pers_press.php" method="POST">
					
				    <!--PRESSIONE-->

				    <div class="col-md-9">
				    <h3>Pressure</h3>

				    <?php
					if(isset($_POST['pres_period']) === true){
					    switch ($_POST['pres_period']) {
						case PERIOD_HOUR:
						    $pres_sel = PERIOD_HOUR;
						    break;
						case PERIOD_DAY:
						    $pres_sel = PERIOD_DAY;
						    break;
						case PERIOD_WEEK:
						    $pres_sel = PERIOD_WEEK;
						    break;
						default:
						    $pres_sel = PERIOD_HOUR;
						    break;
					    }
					}
					else
					    $pres_sel = PERIOD_HOUR;
				    ?>

					<label class="radio-inline">
					    <input type="radio" name="press_period" id="press_radio1" 
						   value="<?php echo PERIOD_HOUR ?>" onclick="this.form.submit()"  
						   <?php if($pres_sel === PERIOD_HOUR) echo 'checked'; ?>> Hour
					</label>
					<label class="radio-inline">
					    <input type="radio" name="press_period" id="press_radio2" 
						   value="<?php echo PERIOD_DAY ?>" onclick="this.form.submit()"
						   <?php if($pres_sel === PERIOD_DAY) echo 'checked'; ?>> Day
					</label>
					<label class="radio-inline">
					    <input type="radio" name="press_period" id="press_radio3" 
						   value="<?php echo PERIOD_WEEK ?>" onclick="this.form.submit()"
						   <?php if($pres_sel === PERIOD_WEEK) echo 'checked'; ?>> Week
					</label>

				    <?php					
				    $pres_value_string = WebServiceClient::get_pressure($_SESSION['token'], $pres_sel);		
				    $title_tag = $pres_sel === PERIOD_HOUR ? 'Last Hour' : ($pres_sel === PERIOD_DAY ? 'Last Day' : 'Last Week');
				    press_chart($pres_value_string, $title_tag);

				    echo '<img width="'.CHART_WIDTH.'" height="'.CHART_HEIGTH.'" src="chart/pres_graph.png"/>';
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