<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlanRequest $request)
    {
        $plan = Plan::create([
            "name" => $request->name,
            "date" => $request->date,
            "time" => $request->time,
            "area" => $request->area,
            "plan_type_id" => $request->plan_type_id,
            "farm_id" => $request->farm_id,
            "user_id" => $request->user_id,

        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Create Plan successfull",
            'data' => $plan
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlanRequest $request, $id)
    {
        $plan = Plan::find($id)->update([
            "name" => $request->name,
            "date" => $request->date,
            "time" => $request->time,
            "area" => $request->area,
            "plan_type_id" => $request->plan_type_id,
            "farm_id" => $request->farm_id,
            "user_id" => $request->user_id,
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Update Plan successfull",
            'data' => $plan
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
