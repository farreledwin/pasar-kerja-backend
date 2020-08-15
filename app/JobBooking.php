<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class JobBooking extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'job_bookings';
}
