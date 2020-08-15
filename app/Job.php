<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Job extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'job_list';
}
