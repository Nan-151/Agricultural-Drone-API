<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $locations = Location::all();
        $locations = LocationResource::collection($locations);

        return response()->json([
            'message' => 'Successfully',
            'data' => $locations
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocationRequest $request)
    {
        $location = Location::create([
            "longitude" => $request -> longitude,
            "latitude" => $request -> latitude,
            "drone_id" => $request -> drone_id,
        ]);

        return response()->json([
            'message' => 'Create new location successfully',
            'data' => $location
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocationRequest $request, $id)
    {
        $location = Location::find($id)->update([
            "longitude" => $request -> longitude,
            "latitude" => $request -> latitude,
            "drone_id" => $request -> drone_id,
        ]);
        return response()->json([
            'message' => 'Update location successfully',
            'data' => $location
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        //
    }
}
