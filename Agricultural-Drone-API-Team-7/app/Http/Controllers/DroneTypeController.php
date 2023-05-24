<?php

namespace App\Http\Controllers;

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
            'massage' => 'Successfully',
            'data' => $droneTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        
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
