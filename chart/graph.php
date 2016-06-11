<?php
require_once('Utilis.php');
require_once('phpgraphlib.php');

function get_base_chart($data_array, $out_file, $data_format){
        
    // Creo il grafico
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGTH, $out_file);
    $graph->addData($data_array);
    
    $max = max($data_array);
    $min = min($data_array);
    $avg = round(array_sum($data_array) / count($data_array) , 2);
    
    $graph->setBars(false);
    $graph->setLine(true);

    $graph->setDataPoints(true);
    $graph->setDataPointColor('red');
    $graph->setDataPointSize(5);

    $graph->setDataValues(false);
    $graph->setDataValueColor('maroon');
    $graph->setDataFormat($data_format);
    
    $graph->setTitleLocation('left');
    
    $graph->setLegend(true);
    $graph->setSwatchOutlineColor("white");
    $graph->setLegendOutlineColor("white");
    $graph->setLegendTitle('Min: '.$min.$data_format.' Max: '.$max.$data_format.' Avg: '.$avg.$data_format);
    
    $graph->setGoalLine($avg, 'black', 'dashed');
    
    $graph->setXValues(true);
    $graph->setXValuesHorizontal(true);
    $graph->setXValuesInterval(5);
        
    return $graph;
}

function adapt_data($data_array, $default_value){
    $ret = array();
        
    $data_array = array_reverse(explode(";",$data_array));

    //Se l'array è vuoto
    if(sizeof($data_array) === 0){
	$ret = array(date("h:m:s") => $default_value);
	return $ret;
    }
    
    for ($i = 0; $i < count($data_array); $i+=2) {
	$val = $data_array[$i];
	
	$date = explode(' ',$data_array[$i+1])[1];
	
	$ret[$date] = $val;
    }
    
    return $ret;
}

function hum_chart($data, $title_period){
    
    $formatted_data = adapt_data($data, 50);
    
    $graph = get_base_chart($formatted_data,'chart/hum_graph.png', '% ');    
    $graph->setTitle('Relative Humidity - ' . $title_period);
    
    //Calcolo il range
    $max = max($formatted_data);
    $min = min($formatted_data);

    $max = min(100, (int)($max * 1.1) + 1);
    $min = max(0, (int)($min * 0.9) - 1);

    $graph->setRange($max,$min);

    $graph->createGraph();
    
}

function press_chart($data, $title_period){
    $formatted_data = adapt_data($data, 985.0);

    $graph = get_base_chart($formatted_data,'chart/pres_graph.png', ' hPa ');
    $graph->setTitle('Pressure - ' . $title_period);
    
    //Calcolo il range
    $max = max($formatted_data);
    $min = min($formatted_data);

    $max = round(min(1000, ($max * 1.001)) + 0.1, 1);
    $min = round(max(970, ($min * 0.999)) - 0.1, 1);
    
    $graph->setRange($max,$min);

    $graph->createGraph();
    
}

function temp_chart($data, $title_period){
    $formatted_data = adapt_data($data, 20.0);

    // Creo il grafico
    $graph = get_base_chart($formatted_data,'chart/temp_graph.png', '°C');
    $graph->setTitle('Temperature - ' . $title_period);
    
    //Calcolo il range
    $max = max($formatted_data);
    $min = min($formatted_data);

    $max = round(min(50, ($max * 1.05)) + 0.5, 1);
    $min = round(max(-20, ($min * 0.95)) - 0.5, 1);

    $graph->setRange($max,$min);

    $graph->createGraph();    
}

function lux_chart($data, $title_period){
    $formatted_data = adapt_data($data, 200);

    // Creo il grafico
    $graph = get_base_chart($formatted_data,'chart/lux_graph.png', '');
    $graph->setTitle('Luminosity - ' . $title_period);

    //Calcolo il range
    $max = max($formatted_data);
    $min = min($formatted_data);

    $max = min(4000, (int)($max * 1.1) + 1);
    $min = max(0, (int)($min * 0.9) - 1);

    $graph->setRange($max,$min);

    $graph->createGraph();    
}