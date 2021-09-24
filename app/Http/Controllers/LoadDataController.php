<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoadDataController extends Controller {

    public function country()
    {
        $data = Country::orderBy('name', 'asc')->get();
        return response()->json($data);
    }

    public function province(Request $request)
    {
        $data = Province::where(function($query) use ($request) {
                if($request->country_id) {
                    $query->where('country_id', $request->country_id);
                }
            })
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($data);
    }

    public function city(Request $request)
    {
        $data = City::where(function($query) use ($request) {
                if($request->province_id) {
                    $query->where('province_id', $request->province_id);
                }
            })
            ->orderBy('name', 'asc')
            ->get();

        return response()->json($data);
    }

}
