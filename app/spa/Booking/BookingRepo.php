<?php

namespace spa\Booking;

use spa\Base\BaseRepo;

class BookingRepo extends BaseRepo {

  public $filters = ['serviceId', 'startDate', 'endDate'];

  public function getModel() {
    return new Booking;
  }

  public function filterByStartDate($q, $date) {
    $q->where('date', '>=', date_create_from_format('!Ymd', $date));
  }

  public function filterByEndDate($q, $date) {
    $q->where('date', '<', date_create_from_format('!Ymd', $date));
  }

}
