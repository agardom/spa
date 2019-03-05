<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use spa\Service\ServiceRepo;
use spa\Service\ServiceTimetableRepo;
use spa\Booking\BookingRepo;

class ServiceController extends Controller
{
  protected $serviceRepo;
  protected $serviceTimetableRepo;

  public function __construct(ServiceRepo $serviceRepo, ServiceTimetableRepo $serviceTimetableRepo) {
    $this->serviceRepo = $serviceRepo;
    $this->serviceTimetableRepo = $serviceTimetableRepo;
  }

  /**
   *  Returns all services paginated
   */
  public function index() {
    return $this->serviceRepo->search(Input::all(), \Spa\Base\BaseRepo::PAGINATE);
  }

  /**
   *  Returns a service filtered by id
   *
   *  $id         Service Id
   */
  public function show($id)  {
    return $this->serviceRepo->findOrFail($id);
  }

  /**
   *  Returns timetables for a service between two dates
   *
   *  $id         Service Id
   *  $startDate  Start date (format: yyyyMMdd)
   *  $endDate    End date (format: yyyMMdd)
   */
  public function timetable($id, $startDate, $endDate) {
    return $this->getTimetable($id, $startDate, $endDate);
  }

  /**
   *  Returns timetables for a service between two dates splitted by hour (service duration)
   *
   *  $id         Service Id
   *  $startDate  Start date (format: yyyyMMdd)
   *  $endDate    End date (format: yyyMMdd)
   */
  public function timetableByHour($id, $startDate, $endDate) {
    return $this->getTimetable($id, $startDate, $endDate, true);
  }

  /**
   *  Returns imetables for a service between two dates splitted by hour (service duration)
   *    decorated with availability
   *
   *  $id         Service Id
   *  $startDate  Start date (format: yyyyMMdd)
   *  $endDate    End date (format: yyyMMdd)
   */
  public function availableTimetableByHour($id, $startDate, $endDate) {
    return $this->getTimetable($id, $startDate, $endDate, true, true);
  }

  /**
   *  Returns timetable for a service
   *
   *  $id           Service Id
   *  $startDate    Start date (format: yyyyMMdd)
   *  $endDate      End date (format: yyyMMdd)
   *  $explode      Splits interval by hours
   *  $availability Decorates interval with availability
   */
  private function getTimetable($id, $startDate, $endDate, $explode = false, $availability = false) {
    $filters = ['serviceId' => $id, 'startDate' => $startDate, 'endDate' => $endDate];
    $intervals = $this->serviceTimetableRepo->search($filters);

    if ($explode) {
      $result = array();
      foreach ($intervals as $interval) {
        $result = array_merge($result, $interval->explodeByHour());
      }

      if ($availability) {
        $bookingRepo = new BookingRepo();
        $bookings = $bookingRepo->search($filters, false);
        $result = $this->filterAvailable($result, $bookings);
      }

      return $result;
    }
    else
      return $intervals;
  }

  /**
   *  Decorates intervals by booked or not
   *
   *  $intervals  intervals to check
   *  $bookings   books done in same date range
   */
  private function filterAvailable($intervals, $bookings) {
    foreach ($intervals as $interval) {
      $booked = false;
      foreach ($bookings as $booking) {
        $parts = explode(' ', $booking->date);
        if ($interval->date == $parts[0] && $interval->start == $parts[1]) {
          $booked = true;
          break;
        }
      }
      $interval->booked = $booked;
    }
    return $intervals;
  }

}
