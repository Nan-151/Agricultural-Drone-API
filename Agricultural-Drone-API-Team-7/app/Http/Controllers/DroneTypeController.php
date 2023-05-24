<?php

namespace App\Http\Controllers;

use App\Http\Requests\DroneTypeRequest;
use App\Http\Resources\DroneTypeResource;
use App\Models\DroneType;
use Illuminate\Http\Request;

class DroneTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $droneTypes = DroneType::all();
        $droneTypes = DroneTypeResource::collection($droneTypes);

        return response()->json([
            'message' => 'Successfully',
            'data' => $droneTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DroneTypeRequest $request)
    {
        //
        $droneType = DroneType::create([
            "drone_type" => $request -> drone_type
        ]);

        return response()->json([
            'message' => 'Create type of drone successfully',
            'data' => $droneType
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DroneType $droneType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DroneType $droneType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DroneType $droneType)
    {
        //
    }
}
