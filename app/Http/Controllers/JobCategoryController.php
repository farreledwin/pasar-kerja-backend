<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobCategory;

class JobCategoryController extends Controller
{
    public function showJobCategory() {
        $data = JobCategory::all();

        return response()->json([
            'payload' => [
                'data' => $data
            ]
        ]);
    }
}
