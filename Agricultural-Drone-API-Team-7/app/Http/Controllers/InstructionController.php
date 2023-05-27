<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandDroneRequest;
use App\Http\Requests\InstructionRequest;
use App\Http\Resources\InstructionResource;
use App\Models\Instruction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $instructions = Instruction::all();
        $instructions = InstructionResource::collection($instructions);

        return response()->json([
            "success" => true,
            "data" => $instructions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InstructionRequest $request)
    {
        $instruction = Instruction::create([
            "status" => $request->status,
            "drone_id" => $request->drone_id,
            "plan_id" => $request->plan_id,
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Create Instruction successfull",
            'data' => $instruction
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Instruction $instruction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InstructionRequest $request, $id)
    {
        $instruction = Instruction::find($id)->update([
            "status" => $request->status,
            "drone_id" => $request->drone_id,
            "plan_id" => $request->plan_id,
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Update Instruction successfull",
            'data' => $instruction
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instruction $instruction)
    {
        //
    }

    public function commandDrone(CommandDroneRequest $request, $droneName)
    {
        $droneId = Auth::user()->drone->where('name', $droneName)->first();
        if($droneId != null){
            $instructions = Instruction::all();
            foreach ($instructions as $instruction){
                if($instruction->drone_id == $droneId){
                    $instruction->update([
                        'status' => $request->status,
                        'plan_id' => $request->plan_id,
                    ]);
    
                    return response()->json([
                        "message" => "Update instruction of drone id: " . $droneId . " sucessfully.",
                        "data" => $instruction
                    ], 201);
                }
            }
        }
        return response()->json([
            "success" => false,
            "message" => "Sorry, Drone drone does not belong to the user.",
        ], 203);  
    }  
}
