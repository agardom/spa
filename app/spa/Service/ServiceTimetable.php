<?php

namespace spa\Service;

use spa\Base\BaseEntity;
use DateInterval;
use DatePeriod;
use DateTime;

class ServiceTimetable extends BaseEntity
{
  protected $table = 'services_timetables';
  protected $fillable = ['serviceId', 'date', 'start', 'end'];
  protected $hidden = ['created_at', 'updated_at'];

  public function explodeByHour() {
    $hours = [];
    $hourInterval = new DateInterval('PT1H');
    $begin = new DateTime($this->start);
    $end = new DateTime($this->end);
    foreach ((new DatePeriod($begin, $hourInterval, $end)) as $i => $interval) {
        $_begin = $interval;
        if ($_begin >= $end) break;

        $interval = clone $this;
        $interval->start = $_begin->format("H:i:s");
        $interval->end = $_begin->modify('+1 hour')->format("H:i:s");
        $hours[] = $interval;
    }
    return $hours;
  }
}
