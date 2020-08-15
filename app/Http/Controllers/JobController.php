<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
class JobController extends Controller
{
    // public function getJobList(Request $request) {
        
    //     if(strcmp($request->value, "mulai_sekarang")== 0) {
    //         // $data = WorkRequirement::with(['jobs'])->where('start_time','like','%'.$request->buttonValue.'%')->get();
    //         $data = DB::table('jobs')->join('work_requirements','jobs.id','=','work_requirements.job_id')->join('contract_type','jobs.contract_id','=','contract_type.id')
    //         ->where('work_requirements.start_time','like','%'.$request->value.'%')->select('jobs.*','contract_type.contract_name','work_requirements.*')->get();
    //     }
    //     else if($request->value == '') {
    //         $data = DB::table('jobs')->join('work_requirements','jobs.id','=','work_requirements.job_id')->join('contract_type','jobs.contract_id','=','contract_type.id')->select('jobs.*','contract_type.contract_name','work_requirements.*')->get();
    //     }
    //     else if($request->value == 'no_required') {
    //         $data = DB::table('jobs')->join('work_requirements','jobs.id','=','work_requirements.job_id')->join('contract_type','jobs.contract_id','=','contract_type.id')
    //         ->where('work_requirements.experience_job','like','%'.$request->value.'%')->select('jobs.*','contract_type.contract_name','work_requirements.*')->get();
    //     }
    //     $msg = [
    //         'payload' => [
    //             'data' => $data,
    //             'status' => true
    //             ]
    //         ];
    //     return response()->json($msg,200);
    // }

    public function getJobList(Request $request) {
        $data = Job::all();
        if($request->start_date || $request->start_price != "" && $request->sort == '') {
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            
            $data = Job::whereBetween('salary',[$request->start_price,$request->end_price])->orWhere(function ($query) use($startDate,$endDate) {
                $query->whereBetween('job_date',[$startDate,$endDate]);})->get();
        }
        else if($request->sort != '') {
            if($request->start_date || $request->start_price != "") {
                $startDate = $request->start_date;
                $endDate = $request->end_date;

                if($request->sort == 'lowest_price') {
                    $data = Job::whereBetween('salary',[$request->start_price,$request->end_price])->orWhere(function ($query) use($startDate,$endDate) {
                        $query->whereBetween('job_date',[$startDate,$endDate]);
                    })->orderBy('salary','ASC')->get();
                }
                else if($request->sort == 'highest_price') {
                    $data = Job::whereBetween('salary',[$request->start_price,$request->end_price])->orWhere(function ($query) use($startDate,$endDate) {
                        $query->whereBetween('job_date',[$startDate,$endDate]);
                    })->orderBy('salary','DESC')->get();
                }
                else if($request->sort == 'highest_rating') {
                    $data = Job::whereBetween('salary',[$request->start_price,$request->end_price])->orWhere(function ($query) use($startDate,$endDate) {
                        $query->whereBetween('job_date',[$startDate,$endDate]);
                    })->orderBy('job_rating','DESC')->get();
                }
                else if($request->sort == 'newest') {
                    $data = Job::whereBetween('salary',[$request->start_price,$request->end_price])->orWhere(function ($query) use($startDate,$endDate) {
                        $query->whereBetween('job_date',[$startDate,$endDate]);
                    })->orderBy('job_date','DESC')->get();
                }
            }
            else {
                if($request->sort == 'lowest_price') {
                    $data = Job::orderBy('salary','ASC')->get();
                }
                else if($request->sort == 'highest_price') {
                    $data = Job::orderBy('salary','DESC')->get();
                }
                else if($request->sort == 'highest_rating') {
                    $data = Job::orderBy('job_rating','DESC')->get();
                }
                else if($request->sort == 'newest') {
                    $data = Job::orderBy('job_date','DESC')->get();
                }
            }
        }
        
        return response()->json([
            'payload' => [
                'data' => $data,
                'status' => true
            ]
        ]);
    }


    public function getJobDetail($id) {
        $data = Job::find($id)->first();

        return response()->json([
            'payload' => [
                'data' => $data,
                'status' => true
            ]
        ]);
    }

    

    public function insert(Request $request) {
        $newData = new Job();
        $newData->job_name = $request->serviceName;
        $newData->job_city = $request->job_city;
        $newData->salary = $request->salary;
        $newData->job_description = $request->serviceDescription;
        $newData->job_category = $request->workcategory;
        $newData->job_rating = $request->job_rating;
        $newData->job_review = $request->job_review;
        $newData->job_image = $request->job_image;
        $newData->job_date = $request->job_date;
        $newData->job_time_range = $request->start_time_range.'-'.$request->finish_time_range;
        $newData->job_hour = $request->job_hour;
        $newData->discount = $request->discount;
        $newData->save();

        return response()->json([
            'payload' => [
                'data' => "insert data job success",
                'status' => true
            ]
        ]);
    }
}
