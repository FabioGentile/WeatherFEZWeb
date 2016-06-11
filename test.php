<?php
require 'Utilis.php';
require 'WebServiceClient.php';

//$token = 'MU98HLYT6DVBLC0Z';
$token = '8NC3LSONB6GX8YGL';
$humidity = isset($_GET['hum']) ? $_GET['hum'] : 60;
$temperature = isset($_GET['temp']) ? $_GET['temp'] : 25;
$pressure = isset($_GET['press']) ? $_GET['press'] : 980;
$luminosity = isset($_GET['lux']) ? $_GET['lux'] : 150;

$humidity += mt_rand(0,4) - 2;
$temperature += round(mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax() * 3  - 1.5, 1);
$pressure += round(mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax() * 2 - 1.0, 1);
$luminosity += mt_rand(0,4) - 2;

if($humidity > 100 || $humidity < 0)
    $humidity = 50;

if($temperature > 50 || $temperature < (-15))
   $temperature = 20.0;

if($pressure > 1000 || $pressure < 970)
    $pressure =  985.0;

if($luminosity > 1000 || $luminosity < 0 )
    $luminosity = 200;

//ws
WebServiceClient::save_values($token, $temperature, $pressure, $humidity, $luminosity);


sleep(1);

$url = 'test.php?hum=' . $humidity . '&temp=' . $temperature . '&press=' . $pressure . '&lux=' . $luminosity 
?>
<html>
    <head>
    <meta http-equiv="refresh" content="5;URL='<?php echo $url?>'">
    </head>
    <body>
	we we 
    </body>
</html>

