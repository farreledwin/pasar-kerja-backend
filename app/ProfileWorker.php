<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class ProfileWorker extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'profile_worker';
}
