<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfileWorker;

class ProfileWorkerController extends Controller
{
    public function insertProfile(Request $request) {
        $newData = new ProfileWorker();
        $newData::insert($request->toArray());

        return response()->json([
            'payload' => [
                        'data' =>  'Success Insert Data',
                        'status' => true
            ]
        ]);

    }

    public function viewProfile(Request $request) {
        $data = ProfileWorker::where('email',$request->email)->first();

        return response()->json([
            'payload' => [
                'data' => $data,
                'status' => true
            ]
        ]);

    }
}
