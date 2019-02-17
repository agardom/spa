<?php

namespace spa\Service;

use spa\Base\BaseEntity;

class ServiceTranslation extends BaseEntity
{
  protected $table = 'services_translations';
  protected $fillable = ['serviceId', 'locale', 'name', 'description'];
}
