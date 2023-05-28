<?php

namespace App\Http\Controllers;


use App\Http\Requests\DroneRequest;
use App\Http\Requests\UpdateDroneRequest;
use App\Http\Resources\DroneResource;
use App\Http\Resources\InstructionResource;
use App\Http\Resources\ShowLocationResource;
use App\Models\Drone;
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
    public function show(Request $request){

    }

    public function showDroneByName(string $droneName)
    {
        $drone = Auth::user()->drone->where('name', $droneName)->first();
        if(!($drone)){
            return response()->json([
                'success'=>false,
                'message' => 'User does not has this drone name!'
            ], 401);
        }
        return response()->json([
            "success"=> true,
            'data' => new DroneResource($drone)
        ],200);

    }

    public function findDroneLocation(string $droneName, int $locationId)
    {
        $drone = Auth::user()->drone->where('name', $droneName)->first();
        if(!($drone)){
            return response()->json([
                'success'=>false,
                'message' => 'User does not has this drone!'
            ], 401);
        }
        
        $location = $drone->location()->where('id', $locationId)->first();
        if(!($location))
        {
            return response()->json([
                'success'=>false,
                'message' => 'This drone does not at this location!'
            ], 401);
        }
        return response()->json([
            "success"=> true,
            'data' => new ShowLocationResource($location)
        ],200);
      

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(DroneRequest $request, string $id)
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

    public function updateDroneByName(UpdateDroneRequest $request, string $name)
    {
        $drone = Drone::where("name", $name)->update([
            "battery"=> $request->battery,
            "max_altitude"=> $request->max_altitude,
            "max_range" => $request->max_range,
            "max_speed" => $request->max_speed,
            "payload" => $request->payload,
        ]);

        return response()->json([
            "success"=> true,
            "message"=>"Update Drone successfull",
            'data' => $drone
        ],200);
       
    }
    public function findDroneInstructions(){
        $drones = Auth::user()->drone;
        $listOfinstruction = [];
        foreach($drones as $drone){
            $instructions = $drone->instruction;
            foreach($instructions as $instruction){
                $newInstruction = new InstructionResource($instruction);
                array_push($listOfinstruction , $newInstruction);
            }
        }
        if($listOfinstruction == []){
            return response()->json([
                "success"=> true,
                "message"=>"Drone does not has instructions yet!",
            ],200);
        }

        return response()->json([
            "success"=> true,
            "message"=>"Get instructions successfull",
            'data' => $listOfinstruction 
        ],200);
        
        
       
     
       
    }
}
