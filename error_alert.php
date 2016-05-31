                        <div class="row">
                           <div class="alert alert-danger" role="alert" id="alert_errore" <?php echo $display_err_style;?>>
                              <?php
                                 if($_SESSION['errCode'] != ERR_NO_ERROR){//c'e stato un errore
                                    echo "<strong>ATTENZIONE:</strong> ".$_SESSION['errMsg'];
                                    setError();   //clean error msg
                                 }
                              ?>
                           </div>
                        </div>
