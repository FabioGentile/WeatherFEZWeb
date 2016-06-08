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
            <div class="col-sm-3 st_menu"> <!-- menu laterale -->
               <?php require_once('menu.php');  ?>
            </div>
            
            <div class="col-sm-9 st_main"> <!-- contenuto della pagina -->
               <div class="container-fluid"> 
                  <div class="row">
                     <h3>New user registration</h3>
                     <div class="container-fluid"> 
                        <!-- Alert di errore -->
                        <?php require_once('error_alert.php') ?>
                        
                        <!-- contenuto della pagina -->
                        <div class="row">
                           <div class="col-md-6">
                           
                              <form name="regForm" method="POST" action="reg_check.php" onsubmit="return validateLRForm()">

                                 <div class="form-group">
                                    <label for="username_p">Username</label>
                                    <input type="text" class="form-control" name="username_p" id="username_p" placeholder="Insert username (max. <?php echo MAX_USN_LEN; ?> characters)">
                                    <label class="form_err_lbl" id="lbl_err_usr" for="username_p" ></label>
                                 </div>

                                 <div class="form-group">
                                    <label class="control-label" for="password_p">Password</label>
                                    <input type="password" class="form-control" name="password_p" id="password_p" placeholder="Insert password (max. <?php echo MAX_PWD_LEN; ?> characters)">
                                    <label class="form_err_lbl" id="lbl_err_usr" for="username_p"></label>
                                 </div>

                                 <button type="submit" class="btn btn-default">Submit</button>
                              </form>      
                              
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <br>
            </div>
         </div>
      </div>
   </body>
</html>