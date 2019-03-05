<?php

namespace spa\Service;

use App;
use spa\Base\BaseEntity;

class Service extends BaseEntity
{
  protected $table = 'services';
  protected $fillable = ['id', 'price'];

  protected $appends = ['name', 'description'];

  private $info;

  private function getTranslatedInfo() {
    $serviceTranslationRepo = new ServiceTranslationRepo;
    $this->info = $serviceTranslationRepo->getTranslatedService($this->id, App::getLocale());
    return $this->info;
  }

  public function getNameAttribute() {
    return $this->info ? $this->info->name : $this->getTranslatedInfo()->name;
  }

  public function getDescriptionAttribute() {
    return $this->info ? $this->info->description : $this->getTranslatedInfo()->description;
  }

}
