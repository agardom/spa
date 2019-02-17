<?php

namespace spa\Service;

use spa\Base\BaseRepo;

class ServiceRepo extends BaseRepo {

  public function getModel() {
    return new Service;
  }

  /*public filters = ['search', 'available'];

  public function filterBySearch($q, $value){
    $q->where('name', 'LIKE', "%$value%");
  }*/

}
