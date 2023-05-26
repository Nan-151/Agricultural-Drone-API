<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapRequest;
use App\Http\Resources\MapResource;
use App\Http\Resources\ShowMapResource;
use App\Models\Farm;
use App\Models\Map;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
    }

    public function showUserMap(){
        $drones = Auth::user()->drone->first();
        if(!($drones)){
            return response()->json([
                'success'=>false,
                'message' => 'User does not have this drone name!'
            ], 401);
        }
        $map_list = new ShowMapResource($drones);
        return $map_list;
        return response()->json([
            "success"=> true,
            'data' => $map_list
        ],200);
    }

    public function downloadImage($farmId){
        $drones = Auth::user()->drone->first();
        $map= $drones->map->where('farm_id',$farmId);
        $map_list = MapResource::collection($map);
        return response()->json([
                "success"=> true,
                "data"=> $map_list
            ],200);

                      
    }

    public function deleteImage($farmId){
        $drones = Auth::user()->drone->first();
        $maps= $drones->map->where('farm_id', $farmId);
        foreach ($maps as $map) {
            $map->delete();
        }
        return response()->json([
                "success"=> true,
                "status"=>"Images of Farm " . $farmId . " Succesfully deleted",
        ],200);

    }                
}

