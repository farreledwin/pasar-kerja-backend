<?php

namespace App;


use Jenssegers\Mongodb\Eloquent\Model;

class JobReview extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'job_review';
}
