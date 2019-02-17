<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use spa\Service\ServiceRepo;
use spa\Service\Service;

class ServiceController extends Controller
{
  protected $serviceRepo;

  public function __construct(ServiceRepo $serviceRepo) {
    $this->serviceRepo = $serviceRepo;
  }

  public function index()
  {
    return $this->serviceRepo->search(Input::all(), \Spa\Base\BaseRepo::PAGINATE);
  }

  public function show($id)
  {
    return $this->serviceRepo->findOrFail($id);
  }

  public function greetings(Request $request) {
    $data = [
      'message' => trans('messages.greeting')
    ];

    return response()->json($data, 200);
  }
}
