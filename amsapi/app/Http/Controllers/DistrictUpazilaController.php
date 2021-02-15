<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\District;
use App\Upazila;
use DB;
use App\Http\Resources\DistrictUpazila as DistrictUpazilaResource;

class DistrictUpazilaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function district()
    {
        $district = DB::table('districts')
                ->orderBy('name', 'asc')
                ->get();
        return  new DistrictUpazilaResource($district);
        
        // return DistrictUpazilaResource::collection($district);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upazila($district_id)
    {
        // return "ok";
        $upazila = DB::table('upazilas')->where('district_id',$district_id)->get();
        return  new DistrictUpazilaResource($upazila);
    }
}
