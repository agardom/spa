<?php

namespace spa\Service;

use spa\Base\BaseRepo;

class ServiceTranslationRepo extends BaseRepo {

  public function getModel() {
    return new ServiceTranslation;
  }

  public function getTranslatedService($serviceId, $locale){
    return ServiceTranslation::where('serviceId', $serviceId)->where('locale', $locale)->firstOrFail();
  }

}
