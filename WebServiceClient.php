<?php
require_once('Utilis.php');
/**
 * Classe per comunicare con il WS
 *
 * @author Fabio
 */

define("WEB_SERVICE_IP","192.168.0.100:40000");

class WebServiceClient {
    private static $wsdl_URL = 'http://'.WEB_SERVICE_IP.'/WeatherFEZWS?singleWsdl';
    private static $svc_URL = 'http://'.WEB_SERVICE_IP.'/WeatherFEZWS';
    
    /**
     * Creo un client per comunicare con il WS
     * @return type SoapClient client per il WS
     */
    private static function get_soap_client($ws_function){
	$ret = null;
        try {
            // Creo l'oggetto per la comunicazione al WS
            $ret = new SoapClient(self::$wsdl_URL, array(   'soap_version' => SOAP_1_2,
							    'keep_alive' => false,
							    'cache_wsdl' => WSDL_CACHE_MEMORY));
	    
	    // Imposto gli header della richiesta
            $actionHdr[] = new SoapHeader(  'http://www.w3.org/2005/08/addressing',
                                            'Action',
                                            'http://WeatherFEZWS/IService/'.$ws_function,
                                            1);
    
            $actionHdr[] = new SoapHeader(  'http://www.w3.org/2005/08/addressing', 
                                            'To', 
                                            self::$svc_URL,  
                                            1);
	    
            $ret->__setSoapHeaders($actionHdr);
	    
        } catch (Exception $exc) {
	    echo $exc->getMessage();
            return NULL;
        }
	return $ret;
    }
    
    /**
     * Richiedo il login al WS
     * @param string $username
     * @param string $password
     * @return string Il token di accesso oppure stringa vuota se il login non ha avuto successo
     */
    public static function login($username, $password){
        $ret = "";
        
        try {
            $soap_client = self::get_soap_client("Login");
	    
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto i parametri
            $param = array( 'username' => new SoapVar($username,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'password' => new SoapVar($password,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'));
                
            // Richiamo il WS
            $result = $soap_client->Login($param);
	    
            // Salvo il risultato
            $ret = $result->LoginResult;
            
        } 
	catch (Exception $exc) {
            return null;
        }
        
        return $ret;
    }
    
    /**
     * Richiedo una registrazione al WS
     * @param string $username
     * @param string $password
     * @return string Il token di accesso oppure stringa vuota se il login non ha avuto successo
     */
    public static function register($username, $password){
        $ret = "";
        
        try {
            $soap_client = self::get_soap_client("Register");
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto i parametri
            $param = array( 'username' => new SoapVar($username,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'password' => new SoapVar($password,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soap_client->Register($param);
            
            // Salvo il risultato
            $ret = $result->RegisterResult;
            
        } 
	catch (Exception $exc) {
            return null;
        }
        
        return $ret;
    }
    
    /**
     * Richiamo il WS per avere i dati dell'umidità
     * @param string $token token di accesso
     * @param int $period PERIOD_*
     * @return array i risultati
     */
    public static function get_humidity($token, $period){
        $ret = array();
        
        try {
            $soap_client = self::get_soap_client("GetHumidity");
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto i parametri
            $param = array( 'token' => new SoapVar($token,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'period' => new SoapVar($period,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'),
			    'maxNValues' => new SoapVar(CHART_POINT,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soap_client->GetHumidity($param);
            	    
            // Splitto la stringa ed elimino i buchi
            $ret = $result->GetHumidityResult;
            
        } 
	catch (Exception $exc) {
            return null;
        }
        
        return $ret;
    }
    
    /**
     * Richiamo il WS per avere i dati della temperature
     * @param string $token token di accesso
     * @param int $period PERIOD_*
     * @return array i risultati
     */
    public static function get_temperature($token, $period){
        $ret = array();
        
        try {
            $soap_client = self::get_soap_client("GetTemperature");
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto i parametri
            $param = array( 'token' => new SoapVar($token,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'period' => new SoapVar($period,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'),
			    'maxNValues' => new SoapVar(CHART_POINT,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soap_client->GetTemperature($param);
            	    
            // Splitto la stringa ed elimino i buchi
            $ret = $result->GetTemperatureResult;
            
        } 
	catch (Exception $exc) {
            return null;
        }
        
        return $ret;
    }
    
    
    /**
     * Richiamo il WS per avere i dati della pressione
     * @param string $token token di accesso
     * @param int $period PERIOD_*
     * @return array i risultati
     */
    public static function get_pressure($token, $period){
        $ret = array();
        
        try {
            $soap_client = self::get_soap_client("GetPressure");
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto i parametri
            $param = array( 'token' => new SoapVar($token,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'period' => new SoapVar($period,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'),
			    'maxNValues' => new SoapVar(CHART_POINT,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soap_client->GetPressure($param);
            	    
            // Splitto la stringa ed elimino i buchi
            $ret = $result->GetPressureResult;
            
        } 
	catch (Exception $exc) {
            return null;
        }
        
        return $ret;
    }
    
    /**
     * Richiamo il WS per avere i dati della luminosità
     * @param string $token token di accesso
     * @param int $period PERIOD_*
     * @return array i risultati
     */
    public static function get_lum($token, $period){
        $ret = array();
        
        try {
            $soap_client = self::get_soap_client("GetLuminosity");
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto i parametri
            $param = array( 'token' => new SoapVar($token,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'period' => new SoapVar($period,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'),
			    'maxNValues' => new SoapVar(CHART_POINT,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soap_client->GetLuminosity($param);
            	    
            // Splitto la stringa ed elimino i buchi
            $ret = $result->GetLuminosityResult;
            
        } 
	catch (Exception $exc) {
            return null;
        }
        
        return $ret;
    }
    
    
    
    
    
    public static function save_values($token, $t, $p, $h, $l){
	try {
            $soap_client = self::get_soap_client("SaveValues");
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto i parametri
            $param = array( 'token' => new SoapVar($token,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'temperature' => new SoapVar($t,XSD_DOUBLE,'double','http://www.w3.org/2001/XMLSchema'),
			    'pressure' => new SoapVar($p,XSD_DOUBLE,'double','http://www.w3.org/2001/XMLSchema'),
			    'humidity' => new SoapVar($h,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'),
			    'luminosity' => new SoapVar($l,XSD_INTEGER,'int','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soap_client->SaveValues($param);
	               
	    
            // Splitto la stringa ed elimino i buchi
            pprint_r($result);
            
        } 
	catch (Exception $exc) {
            return null;
        }
    }
}
