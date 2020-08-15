<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobRecommendation extends Model
{
    protected $table = 'job_recommendation';

    public function jobcategory() {
        return $this->belongsTo('App\JobCategory');
    }

    public function users() {
        return $this->belongsTo('App\User');
    }
}
