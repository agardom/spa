<?php

namespace spa\Service;

use spa\Base\BaseEntity;

class ServiceTimetable extends BaseEntity
{
  protected $table = 'services_timetables';
  protected $fillafillable = ['serviceId', 'date', 'start', 'end'];
}
