<?php

namespace spa\Booking;

use spa\Base\BaseEntity;
use Illuminate\Database\Eloquent\Model;

class Booking extends BaseEntity
{
    protected $fillable = ['clientName', 'comments', 'date', 'serviceId', 'price'];
}
