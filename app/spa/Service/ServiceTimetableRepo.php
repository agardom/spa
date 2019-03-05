<?php

namespace spa\Service;

use spa\Base\BaseRepo;

class ServiceTimetableRepo extends BaseRepo {

  public $filters = ['serviceId', 'startDate', 'endDate', 'datetime'];

  public function getModel() {
    return new ServiceTimetable;
  }

  public function filterByStartDate($q, $date) {
    $q->where('date', '>=', date_create_from_format('!Ymd', $date));
  }

  public function filterByEndDate($q, $date) {
    $q->where('date', '<', date_create_from_format('!Ymd', $date));
  }

  public function filterByDatetime($q, $datetime) {
    $parts = explode(' ', $datetime);
    $q->where('date', '=', $parts[0])->where('start', '<=', $parts[1])->where('end', '>', $parts[1]);
  }

}
