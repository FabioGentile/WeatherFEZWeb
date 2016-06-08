<?php
require_once('Utilis.php');
require_once('phpgraphlib.php');

function get_base_chart($data_array,$out_file){
       
    // Creo il grafico
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGTH, $out_file);
    $graph->addData($data_array);
    
    $graph->setBars(false);
    $graph->setLine(true);

    $graph->setDataPoints(true);
    $graph->setDataPointColor('red');
    $graph->setDataPointSize(5);

    $graph->setDataValues(false);
    $graph->setDataValueColor('maroon');
    
    $graph->setXValues(false);
    
    return $graph;
}


function hum_chart($data, $title_period){
    $data_array = array_reverse(array_filter(explode(";",$data)));

    if(sizeof($data_array) === 0){
	$data_array = array(50);
    }

    $graph = get_base_chart($data_array,'chart/hum_graph.png');    
    $graph->setTitle('Relative Humidity - ' . $title_period);
    $graph->setDataFormat('% ');

    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = min(100, (int)($max * 1.1));
    $min = max(0, (int)($min * 0.9));

    $graph->setRange($max,$min);

    $graph->createGraph();
    
}

function press_chart($data, $title_period){
    $data_array = array_reverse(array_filter(explode(";",$data)));

    if(sizeof($data_array) === 0){
	$data_array = array(985.0);
    }

    $graph = get_base_chart($data_array,'chart/pres_graph.png');
    $graph->setTitle('Atmospherical Pressure - ' . $title_period);
    $graph->setDataFormat(' hPa ');
    
    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = round(min(1000, ($max * 1.001)), 1);
    $min = round(max(970, ($min * 0.999)), 1);
    
    $graph->setRange($max,$min);

    $graph->createGraph();
    
}

function temp_chart($data, $title_period){
    $data_array = array_reverse(array_filter(explode(";",$data)));

    if(sizeof($data_array) === 0){
	$data_array = array(20.0);
    }

    // Creo il grafico
    $graph = get_base_chart($data_array,'chart/temp_graph.png');
    $graph->setTitle('Temperature - ' . $title_period);
    $graph->setDataFormat('°C');

    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = round(min(50, ($max * 1.05)), 1);
    $min = round(max(-20, ($min * 0.95)), 1);

    $graph->setRange($max,$min);

    $graph->createGraph();    
}

function lux_chart($data, $title_period){
    $data_array = array_reverse(array_filter(explode(";",$data)));

    if(sizeof($data_array) === 0){
	$data_array = array(100);
    }

    // Creo il grafico
    $graph = get_base_chart($data_array,'chart/lux_graph.png');
    $graph->setTitle('Luminosity - ' . $title_period);
    //$graph->setDataFormat('percent');

    //Calcolo il range
    $max = max($data_array);
    $min = min($data_array);

    $max = min(4000, (int)($max * 1.1));
    $min = max(0, (int)($min * 0.9));

    $graph->setRange($max,$min);

    $graph->createGraph();    
}