<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobReview;

class JobReviewController extends Controller
{
    public function getReviewJob($id) {
        $data = JobReview::where('job_id',$id)->get();

        return response()->json([
            'payload' => [
                'data' => $data,
                'status' => true
            ]
        ]);
    }
}
