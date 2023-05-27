<?php

namespace App\Http\Controllers;

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

   
}
