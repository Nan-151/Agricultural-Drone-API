<?php

namespace App\Http\Controllers;

use App\Http\Requests\DroneRequest;
use App\Http\Resources\DroneMapResource;
use App\Http\Resources\DroneResource;
use App\Http\Resources\LocationResource;
use App\Http\Resources\MapResource;
use App\Models\Drone;
use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DroneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $drone = Auth::user()->drone;
        $drone = DroneResource::collection($drone);
        return response()->json([
            "success"=> true,
            'data' => $drone
        ],200);

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
    public function show($droneName)
    {
        $drone = Auth::user()->drone->where('name', $droneName)->first();
        $show_drone= new DroneResource($drone);
        if(!($drone)){
            return response()->json([
                'success'=>false,
                'message' => 'User does not have this drone name!'
            ], 401);
        }
        return response()->json([
            "success"=> true,
            'data' => $show_drone
        ],200);

    }

    public function findDroneLocation($droneName, $locationId){
        $drone = Auth::user()->drone->where('name', $droneName)->first();
        if(!($drone)){
            return response()->json([
                'success'=>false,
                'message' => 'User does not have this drone!'
            ], 401);
        }
        
        $location = $drone->location()->where('id', $locationId)->first();
        $drone_location = new LocationResource($location);
        if(!($location)){
            return response()->json([
                'success'=>false,
                'message' => 'This drone does not at this location!'
            ], 401);
        }
        return response()->json([
            "success"=> true,
            'data' => $drone_location
        ],200);
      

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
