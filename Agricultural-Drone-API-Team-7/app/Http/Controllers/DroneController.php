<?php

namespace App\Http\Controllers;

use App\Http\Requests\DroneRequest;
use App\Models\Drone;
use Illuminate\Http\Request;

class DroneController extends Controller
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
    public function store(DroneRequest $request)
    {
        $drone = Drone::create([
            "name" => $request->name,
            "battery"=> $request->battery,
            "max_altitude"=> $request->max_altitude,
            "max_range" => $request->max_range,
            "max_speed" => $request->max_speed,
            "payload" => $request->payload,
            "user_id" => $request->user_id,
            "drone_type_id"=>$request->drone_type_id
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Create Drone successfull",
            'data' => $drone
        ],200);


    }

    /**
     * Display the specified resource.
     */
    public function show(Drone $drone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DroneRequest $request, $id)
    {
        $drone = Drone::find($id)->update([
            "name" => $request->name,
            "battery"=> $request->battery,
            "max_altitude"=> $request->max_altitude,
            "max_range" => $request->max_range,
            "max_speed" => $request->max_speed,
            "payload" => $request->payload,
            "user_id" => $request->user_id,
            "drone_type_id"=>$request->drone_type_id
        ]);

        return response()->json([
            "success"=> true,
            "message"=>"Update Drone successfull",
            'data' => $drone
        ],200);
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Drone $drone)
    {
        //
    }
}
