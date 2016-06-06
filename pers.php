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
				    <form class="form-inline" role="form" action="pers.php" method="POST">
					
				    <!--TEMPERATURA-->
				    
				    <div class="col-md-9">
                                        <h3>Temperature</h3>
					
					<?php
					    if(isset($_POST['temp_period']) === true){
						switch ($_POST['temp_period']) {
						    case PERIOD_HOUR:
							$temp_sel = PERIOD_HOUR;
							break;
						    case PERIOD_DAY:
							$temp_sel = PERIOD_DAY;
							break;
						    case PERIOD_WEEK:
							$temp_sel = PERIOD_WEEK;
							break;
						    default:
							$temp_sel = PERIOD_HOUR;
							break;
						}
					    }
					    else
						$temp_sel = PERIOD_HOUR;
					?>
					
					    <label class="radio-inline">
						<input type="radio" name="temp_period" id="temp_radio1" 
						       value="<?php echo PERIOD_HOUR ?>" onclick="this.form.submit()"  
						       <?php if($temp_sel === PERIOD_HOUR) echo 'checked'; ?>> Hour
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="temp_period" id="temp_radio2" 
						       value="<?php echo PERIOD_DAY ?>" onclick="this.form.submit()"
						       <?php if($temp_sel === PERIOD_DAY) echo 'checked'; ?>> Day
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="temp_period" id="temp_radio3" 
						       value="<?php echo PERIOD_WEEK ?>" onclick="this.form.submit()"
						       <?php if($temp_sel === PERIOD_WEEK) echo 'checked'; ?>> Week
					    </label>
					
                                        <?php					
					$temp_value_string = WebServiceClient::get_temperature($_SESSION['token'], $temp_sel);		
					$title_tag = $temp_sel === PERIOD_HOUR ? 'Last Hour' : ($temp_sel === PERIOD_DAY ? 'Last Day' : 'Last Week');
					temp_chart($temp_value_string, $title_tag);
					
					echo '<img width="'.CHART_WIDTH.'" height="'.CHART_HEIGTH.'" src="chart/temp_graph.png"/>';
					?>									
                                    </div>
					
				    <!--UMIDITA-->
				    
				    <div class="col-md-9">
                                        <h3>Humidity</h3>
					
					<?php
					    if(isset($_POST['hum_period']) === true){
						switch ($_POST['hum_period']) {
						    case PERIOD_HOUR:
							$hum_sel = PERIOD_HOUR;
							break;
						    case PERIOD_DAY:
							$hum_sel = PERIOD_DAY;
							break;
						    case PERIOD_WEEK:
							$hum_sel = PERIOD_WEEK;
							break;
						    default:
							$hum_sel = PERIOD_HOUR;
							break;
						}
					    }
					    else
						$hum_sel = PERIOD_HOUR;
					?>
					
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio1" 
						       value="<?php echo PERIOD_HOUR ?>" onclick="this.form.submit()"  
						       <?php if($hum_sel === PERIOD_HOUR) echo 'checked'; ?>> Hour
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio2" 
						       value="<?php echo PERIOD_DAY ?>" onclick="this.form.submit()"
						       <?php if($hum_sel === PERIOD_DAY) echo 'checked'; ?>> Day
					    </label>
					    <label class="radio-inline">
						<input type="radio" name="hum_period" id="hum_radio3" 
						       value="<?php echo PERIOD_WEEK ?>" onclick="this.form.submit()"
						       <?php if($hum_sel === PERIOD_WEEK) echo 'checked'; ?>> Week
					    </label>
					
                                        <?php					
					$hum_value_string = WebServiceClient::get_humidity($_SESSION['token'], $hum_sel);		
					$title_tag = $hum_sel === PERIOD_HOUR ? 'Last Hour' : ($hum_sel === PERIOD_DAY ? 'Last Day' : 'Last Week');
					hum_chart($hum_value_string, $title_tag);
					
					echo '<img width="'.CHART_WIDTH.'" height="'.CHART_HEIGTH.'" src="chart/hum_graph.png"/>';
					?>									
                                    </div>
				    
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
				    
				    <!--LUMINOSITA-->

				    <div class="col-md-9">
				    <h3>Luminosity</h3>

				    <?php
					if(isset($_POST['lux_period']) === true){
					    switch ($_POST['lux_period']) {
						case PERIOD_HOUR:
						    $lux_sel = PERIOD_HOUR;
						    break;
						case PERIOD_DAY:
						    $lux_sel = PERIOD_DAY;
						    break;
						case PERIOD_WEEK:
						    $lux_sel = PERIOD_WEEK;
						    break;
						default:
						    $lux_sel = PERIOD_HOUR;
						    break;
					    }
					}
					else
					    $lux_sel = PERIOD_HOUR;
				    ?>
					
					<label class="radio-inline">
					    <input type="radio" name="lux_period" id="lux_radio1" 
						   value="<?php echo PERIOD_HOUR ?>" onclick="this.form.submit()"  
						   <?php if($lux_sel === PERIOD_HOUR) echo 'checked'; ?>> Hour
					</label>
					<label class="radio-inline">
					    <input type="radio" name="lux_period" id="lux_radio1" 
						   value="<?php echo PERIOD_DAY ?>" onclick="this.form.submit()"
						   <?php if($lux_sel === PERIOD_DAY) echo 'checked'; ?>> Day
					</label>
					<label class="radio-inline">
					    <input type="radio" name="lux_period" id="lux_radio1" 
						   value="<?php echo PERIOD_WEEK ?>" onclick="this.form.submit()"
						   <?php if($lux_sel === PERIOD_WEEK) echo 'checked'; ?>> Week
					</label>

				    <?php					
				    $lux_value_string = WebServiceClient::get_lum($_SESSION['token'], $lux_sel);		
				    $title_tag = $lux_sel === PERIOD_HOUR ? 'Last Hour' : ($lux_sel === PERIOD_DAY ? 'Last Day' : 'Last Week');
				    lux_chart($lux_value_string, $title_tag);

				    echo '<img width="'.CHART_WIDTH.'" height="'.CHART_HEIGTH.'" src="chart/lux_graph.png"/>';
				    ?>									
				    </div>
				    
				    <br/>
				    <br/>				
				    <br/>
				    <br/>
				    
					
				    </form>
                                </div>			
				
                            </div>
                        </div>
                    </div>
		    
<!--                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>Controlla le tue prenotazioni</h3>
                                <?php //recupero le prenotazioni fatte
//                                    try{
//                                    
//                                    } 
//                                    catch (Exception $e) {
//                                       $sql_er = mysqli_error($conn);
//                                       $sql_er_out = empty($sql_er)? "" : "\nMysql error -> ".$sql_er;
//                                       
//                                       setError(ERR_MYSQL, $e->getMessage() . $sql_er_out);
//                                       db_close_conn();
//                                       
//                                       Redirect('index.php',false);  
//                                    }
                                    			
				?>
                            </div>
                        </div>
                    </div>-->
		    
                </div>		
            </div>
        </div>
    </body>
</html>