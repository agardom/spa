<?php

require_once './core/RequestServices.php';

class ServiceModel {

  public function getServices() {
    try {
      $path = HOST . 'services';

      echo 'Llega getServices';

      $api = new RequestServices();

      echo 'Llega getServices 2';

      $response = $api->CallAPI('GET', $path, null, $error, $res['Code']);

      echo 'Llega getServices 3';

      if($res['Code'] == 200) {
        $res['Data'] = $response;
      }
      else {
        $res['Data'] = null;
      }
      return $res;
    } catch (\Exception $e) {
      echo $e->getTraceAsString();
    }
  }

}
