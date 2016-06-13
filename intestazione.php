<div class="row">
    <div class="col-md-12 top_sx">
        <br>
        <h1 align="center">WeatherFEZ</h1>
        <br>
        <?php 
	    //Se sono loggato stampo l'username
            if(!empty($_SESSION['token'])) 
                echo "<p class='lbl_logged'>Welcome ".$_SESSION['username']. "</p>"; 
            else 
                echo "<p class='lbl_not_logged'>__</p>"; 
        ?>
    </div>
</div>