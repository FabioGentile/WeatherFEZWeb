<?php
/**
 * Classe per comunicare con il WS
 *
 * @author Fabio
 */
class WebServiceClient {
    
    private static $wsdl_URL = 'http://localhost:40000/WeatherFEZWS?singleWsdl';
    private static $svc_URL = 'http://172.29.166.224:40000/WeatherFEZWS';
    
    /**
     * Creo un client per comunicare con il WS
     * @return type SoapClient client per il WS
     */
    private static function get_soap_client(){
        try {
            // Creo l'oggetto per la comunicazione al WS
            $ret = new SoapClient(self::$wsdl_URL, array( 'soap_version' => SOAP_1_2,
                                                'keep_alive' => false,
                                                'cache_wsdl' => WSDL_CACHE_MEMORY));
            return $ret;
        } catch (Exception $exc) {
            return NULL;
        }
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
            $soap_client = self::get_soap_client();
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto gli header della richiesta
            $actionHdr[] = new SoapHeader(  'http://www.w3.org/2005/08/addressing',
                                            'Action',
                                            'http://WeatherFEZWS/IService/login',
                                            1);
    
            $actionHdr[] = new SoapHeader(  'http://www.w3.org/2005/08/addressing', 
                                            'To', 
                                            self::$svc_URL,  
                                            1);
            $soapClient->__setSoapHeaders($actionHdr);
            
            
            // Imposto i parametri
            $param = array( 'username' => new SoapVar($username,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'password' => new SoapVar($password,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soapClient->login($param);
            
            // Salvo il risultato
            $ret = $result->loginResult;
            
        } catch (Exception $exc) {
            return $ret;
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
            $soap_client = self::get_soap_client();
            
            if($soap_client === NULL)
                throw new Exception;
            
            // Imposto gli header della richiesta
            $actionHdr[] = new SoapHeader(  'http://www.w3.org/2005/08/addressing',
                                            'Action',
                                            'http://WeatherFEZWS/IService/register',
                                            1);
    
            $actionHdr[] = new SoapHeader(  'http://www.w3.org/2005/08/addressing', 
                                            'To', 
                                            self::$svc_URL,  
                                            1);
            $soapClient->__setSoapHeaders($actionHdr);
            
            
            // Imposto i parametri
            $param = array( 'username' => new SoapVar($username,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'),
                            'password' => new SoapVar($password,XSD_STRING,'string','http://www.w3.org/2001/XMLSchema'));
            
            // Richiamo il WS
            $result = $soapClient->login($param);
            
            // Salvo il risultato
            $ret = $result->registerResult;
            
        } catch (Exception $exc) {
            return $ret;
        }
        
        return $ret;
    }
    
    
}
