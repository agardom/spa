<?php

require_once './config/AppConfig.php';

/**
 *
 */
class RequestServices
{

  /*function __construct(argument)
  {
    // code...
  }*/

  /**
   * Configure the cURL request.
   *
   * @param $method metodo de la llamada (GET,POST,PUT,DELETE)
   * @param $url The target url.
   * @param $data The array of parameters, with 'key' => 'value' format.
   * @param $header The array of parameters for header.
   * @param &$error - info curl_error
   * @param &$httpcode - CURLINFO_HTTP_CODE
   * @return $result as a value, instead of outputting directly
   */

   public function CallAPI($method, $url, $data = false, $headers = false, &$error = false, &$httpcode= null)
   {
     try {

       echo 'Llega CallAPI';

       $curl = curl_init();
       switch ($method){
          case "POST":
                  curl_setopt($curl, CURLOPT_POST, 1);
                  if ($data)
                      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  break;
          case "PUT":
                  //curl_setopt($curl, CURLOPT_PUT, 1); esto es para subir un fichero, no nos vale
                  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                  if ($data)
                      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                  break;
          case "DELETE":
                  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                  break;
          case "GET":
                  curl_setopt($curl, CURLOPT_URL, $url);
                  break;
        }

echo 'Llega CallAPI 2';

        if ($headers)
          curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

echo 'Llega CallAPI 3';

        $result = curl_exec($curl);


        echo 'Llega CallAPI 4';

        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE );


        echo 'Llega CallAPI 5';

        $error = curl_error($curl);


        echo 'Llega CallAPI 6';

        curl_close($curl);


        echo 'Llega CallAPI 7';
        
        return $result;

      } catch(Exception $e) {

echo 'Llega CallAPI ERROR';
        trigger_error(sprintf('Curl failed with error #%d: %s',
          $e->getCode(), $e->getMessage()),
          E_USER_ERROR);
      }
    }
}
