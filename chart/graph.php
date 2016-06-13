<?php
require_once('Utilis.php');
require_once('phpgraphlib.php');

/**
 * Creo l'oggetto del grafico con una formattazione standard
 * @param array $data_array il vettore associativo con i data_ora => valore
 * @param string $out_file percorso del file dove salvare il grafico
 * @param string $data_format unita di misura del grafico (es. hPa )
 * @return \PHPGraphLib L'istanza del grafico
 */
function get_base_chart($data_array, $out_file, $data_format){
        
    // Creo il grafico
    $graph = new PHPGraphLib(CHART_WIDTH, CHART_HEIGTH, $out_file);
    $graph->addData($data_array);
    
    // Calcolo le statistiche
    $max = max($data_array);
    $min = min($data_array);
    $avg = round(array_sum($data_array) / count($data_array) , 2);
    
    $graph->setBars(false);
    $graph->setLine(true);

    //imposto i punti dei valori
    $graph->setDataPoints(true);
    $graph->setDataPointColor('red');
    $graph->setDataPointSize(5);

    //Imposto la formattazione dei valori
    $graph->setDataValues(false);
    $graph->setDataValueColor('maroon');
    $graph->setDataFormat($data_format);
    
    $graph->setTitleLocation('left');
    
    //Stampo le statistiche
    $graph->setLegend(true);
    $graph->setSwatchOutlineColor("white");
    $graph->setLegendOutlineColor("white");
    $graph->setLegendTitle('Min: '.$min.$data_format.' Max: '.$max.$data_format.' Avg: '.$avg.$data_format);
    
    //Stampo la linea di media
    $graph->setGoalLine($avg, 'black', 'dashed');
    
    //Imposto l'asse delle X
    $graph->setXValues(true);
    $graph->setXValuesHorizontal(true);
    $graph->setXValuesInterval(5);
        
    return $graph;
}

/**
 * Adatto i dati tornati dal WS al formato richiesto dal grafico
 * @param string $data_string i dati grezzi nel formato del WS
 * @param int $default_value il valore di default nel caso non ci fossero dati
 * @return array un array associativo dei dati 
 */
function adapt_data($data_string, $default_value){
    $ret = array();
       
    // Splitto la stringa e la inverto (il WS me li da invertiti per facilità di utilizzo da parte della FEZ)
    $data_string = array_reverse(explode(";",$data_string));

    //Se l'array è vuoto
    if(sizeof($data_string) === 0){
	//Valore di default
	$ret = array(date("h:m:s") => $default_value);
	return $ret;
    }
    
    // Altrimenti ogni 2 elementi estraggo il timestamp e il valore
    for ($i = 0; $i < count($data_string); $i+=2) {
	$val = $data_string[$i];
	// Per la data prendo solo le informazioni relative all'ora (il formato è gg/mm/aaa hh:mm:ss
	$date = explode(' ',$data_string[$i+1])[1];
	
	$ret[$date] = $val;
    }
    
    return $ret;
}

function hum_chart($data, $title_period){
    //Adatto i dati
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
    //Adatto i dati
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
    //Adatto i dati
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
    //Adatto i dati
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