<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobBooking;
use App\Job;
use App\User;
use Carbon\Carbon;
class JobBookingController extends Controller
{
    public function insertBookingJob(Request $request) {
        $mytime = Carbon::now();
        $newData = new JobBooking();
        $newData->email_address = $request->email;
        $newData->from_date = $request->dateFrom;
        $newData->until_date = $request->dateUntil;
        $newData->note = $request->note;
        $newData->total_price = $request->total_price;
        $newData->job_id = $request->job_id;
        $newData->many_day = $request->manyDay;
        $newData->payment_status = 'waiting payment';
        $newData->time_payment = $mytime->toDateTimeString();

        $newData->save();

        return response()->json([
            'payload' => [
                'data' => "success insert",
                'status' => 'true'
            ]
        ]);

    }

    public function showAllBooking(Request $request) {
        $booking = JobBooking::where('email_address',$request->email)->get();
        
        for($i=0;$i<count($booking);$i++) {
            $job = Job::find($booking[$i]->job_id)->first();
            $booking[$i]['job'] = $job;
        }
        return response()->json([
            'payload' => [
                    'data' => $booking
            ],
                'status' => 'true'
            ]
        );
    }

    public function showAllWorkOrder(Request $request) {
        $dataJob = Job::where('email_worker',$request->email)->get();
        $dataUser = User::where('email',$request->email)->first();
        
        for($i=0;$i<count($dataJob);$i++) {
            $dataBooking[$i] = JobBooking::where('job_id',$dataJob[$i]->_id)->first();
            $dataBooking[$i]['job'] = Job::find($dataBooking[$i]->job_id)->first();
            $dataBooking[$i]['user'] = $dataUser;
        }



        return response()->json([
            'payload' => [
                'data' => $dataBooking,
                'status' => true
            ]
        ]);
    }

    public function changeStatusConfirmation(Request $request) {
        $data = JobBooking::where('email_worker',$request->email)->first();

        if($request->button == 'accept') {
            $data->status_order = 2;
        }
        else {
            $data->status_order = 3;
        }

        $data->save();

        return response()->json([
            'payload' => [
                'data' => "update success",
                'status' => true
            ]
        ]);

    }
}
