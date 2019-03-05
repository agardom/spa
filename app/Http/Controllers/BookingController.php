<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use spa\Booking\BookingRepo;
use spa\Service\ServiceRepo;
use spa\Service\ServiceTimetableRepo;

class BookingController extends Controller
{
  protected $bookingRepo;

  public function __construct(BookingRepo $bookingRepo) {
    $this->bookingRepo = $bookingRepo;
  }

  /**
   *  Returns all bookings paginated
   */
  public function index() {
    return $this->bookingRepo->search(Input::all(), \Spa\Base\BaseRepo::PAGINATE);
  }

  /**
   * Returns all bookings for a service
   *
   * $id          Service Id
   */
  public function searchByService($id) {
    $filters = ['serviceId' => $id];
    return $this->bookingRepo->search($filters);
  }

  /**
   *  Returns bookings for a service between two dates
   *
   *  $id         Service Id
   *  $startDate  Start date (format: yyyyMMdd)
   *  $endDate    End date (format: yyyMMdd)
   */
  public function searchByDate($id, $startDate, $endDate) {
    $filters = ['serviceId' => $id, 'startDate' => $startDate, 'endDate' => $endDate];
    return $this->bookingRepo->search($filters);
  }

  /**
   *  Save a new booking for service and DateTime previous checking if it is available
   *
   *  $request    Request with booking info
   */
  public function create(Request $request) {
    $bookings = Input::except('_token');
    $serviceRepo = new serviceRepo();
    $filters = ['id' => $bookings['serviceId'], 'datetime' => $bookings['date']];

    // checks if exists service with that id and get information about price
    $service = $serviceRepo->search($filters)->first();

    if ($service) {
      //update booking price with service price
      $bookings['price'] = $service->price;

      //checks if booking is in a correct interval for this service
      $serviceTimetableRepo = new serviceTimetableRepo();
      $inValidInterval = $serviceTimetableRepo->search($filters)->first();

      if ($inValidInterval) {
        // checks if there is any book for this service and datetime
        $reserved = $this->bookingRepo->search($filters)->first();

        // If there isn't any booking, proceed
        if (!$reserved){
          $booking = $this->bookingRepo->create($bookings);
          return response()->json($booking, 201);
        }
        else
          return response()->json("Datetime is not available for this service", 400);
      }
      else
        return response()->json("Service is not available in this interval", 400);
    }
    else
      return response()->json("Service not found", 404);

  }
}
