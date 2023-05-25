<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapRequest;
use App\Http\Resources\MapResource;
use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $maps = Map::all();
        $maps = MapResource::collection($maps);

        return response()->json([
            'message' => 'Successfully',
            'data' => $maps
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MapRequest $request)
    {
        //
        $map = Map::create([
            "image" => $request -> image,
            "date" => $request -> date,
            "drone_id" => $request -> drone_id,
            "farm_id" => $request -> farm_id,
        ]);

        return response()->json([
            'message' => 'Create new map successfully',
            'data' => $map
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Map $map)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MapRequest $request,  $id)
    {
        //
        $map = Map::find($id)->update([
            "image" => $request->image,
            "date" => $request->image,
            "drone_id" => $request->drone_id,
            "farm_id" => $request->farm_id,
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Update map successfull",
            'data' => $map
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Map $map)
    {
        //
    }
}
