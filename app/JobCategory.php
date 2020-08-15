<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class JobCategory extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'category_job';
}
