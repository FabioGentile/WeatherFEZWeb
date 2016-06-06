<?php
require_once('Utilis.php');
require_once('phpgraphlib.php');



function hum_chart($data, $title_period){

    $data_array = array_filter(explode(";",$data));

    if(sizeof($data_array) === 0){
	$data_array = array(50);
    }

    // Creo il grafico
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGTH, 'chart/hum_graph.png');
    $graph->addData($data_array);

    $graph->setTitle('Relative Humidity - ' . $title_period);

    $graph->setBars(false);
    $graph->setLine(true);

    $graph->setDataPoints(true);
    $graph->setDataPointColor('red');
    $graph->setDataPointSize(5);

    $graph->setDataValues(false);
    $graph->setDataValueColor('maroon');
    $graph->setDataFormat('% ');

    $graph->setXValues(false);
    //$graph->setXValuesInterval(5);

    //$graph->setGrid(false);

    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = min(100, (int)($max * 1.1));
    $min = max(0, (int)($min * 0.9));

    $graph->setRange($max,$min);

    $graph->createGraph();
    
}

function press_chart($data, $title_period){

    $data_array = array_filter(explode(";",$data));

    if(sizeof($data_array) === 0){
	$data_array = array(985.0);
    }

    // Creo il grafico
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGTH, 'chart/pres_graph.png');
    $graph->addData($data_array);

    $graph->setTitle('Atmospherical Pressure - ' . $title_period);

    $graph->setBars(false);
    $graph->setLine(true);

    $graph->setDataPoints(true);
    $graph->setDataPointColor('red');
    $graph->setDataPointSize(5);

    $graph->setDataValues(false);
    $graph->setDataValueColor('maroon');
    $graph->setDataFormat('hPa ');

    $graph->setXValues(false);
    //$graph->setXValuesInterval(5);

    //$graph->setGrid(false);

    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = min(1000, (int)($max * 1.1));
    $min = max(970, (int)($min * 0.9));

    $graph->setRange($max,$min);

    $graph->createGraph();
    
}

function temp_chart($data, $title_period){

    $data_array = array_filter(explode(";",$data));

    if(sizeof($data_array) === 0){
	$data_array = array(20.0);
    }

    // Creo il grafico
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGTH, 'chart/temp_graph.png');
    $graph->addData($data_array);

    $graph->setTitle('Temperature - ' . $title_period);

    $graph->setBars(false);
    $graph->setLine(true);

    $graph->setDataPoints(true);
    $graph->setDataPointColor('red');
    $graph->setDataPointSize(5);

    $graph->setDataValues(false);
    $graph->setDataValueColor('maroon');
    $graph->setDataFormat('°C');

    $graph->setXValues(false);
    //$graph->setXValuesInterval(5);

    
    
    //$graph->setGrid(false);

    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = min(50, (int)($max * 1.1));
    $min = max(-20, (int)($min * 0.9));

    $graph->setRange($max,$min);

    $graph->createGraph();
    
}

function lux_chart($data, $title_period){

    $data_array = array_filter(explode(";",$data));

    if(sizeof($data_array) === 0){
	$data_array = array(100);
    }

    // Creo il grafico
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGTH, 'chart/lux_graph.png');
    $graph->addData($data_array);

    $graph->setTitle('Luminosity - ' . $title_period);

    $graph->setBars(false);
    $graph->setLine(true);

    $graph->setDataPoints(true);
    $graph->setDataPointColor('red');
    $graph->setDataPointSize(5);

    $graph->setDataValues(false);
    $graph->setDataValueColor('maroon');
    //$graph->setDataFormat('percent');

    $graph->setXValues(false);
    //$graph->setXValuesInterval(5);

    //$graph->setGrid(false);

    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = min(1000, (int)($max * 1.1));
    $min = max(0, (int)($min * 0.9));

    $graph->setRange($max,$min);

    $graph->createGraph();
    
}