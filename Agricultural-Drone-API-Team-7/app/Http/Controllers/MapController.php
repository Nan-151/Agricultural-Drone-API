<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapRequest;
use App\Http\Resources\MapResource;
use App\Models\Map;
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
            'message' => 'Get all maps successfully',
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
    public function update(MapRequest $request, string $id)
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

    public function showUserMap()
    {
        $drones = Auth::user()->drone;

        $maps = [];
        foreach($drones as $drone)
        {
            array_push($maps, $drone->map);
        }
    
        $mapOfAllDrone = [];
        foreach($maps as $map)
        {
            foreach($map as $image)
            {
                $mapList = new MapResource($image);
                array_push($mapOfAllDrone, $mapList);
            }
        }
        return response()->json([
            "success"=> true,
            "status"=>"Get all maps of each drone's user",
            'data' => $mapOfAllDrone
        ],200);
    }

    public function downloadImage(string $provinceName, int $farmId)
    {
        $farm = Auth::user()->farm->where('id',$farmId)->first();
        if($farm != null)
        {
            if($farm->id == $farmId)
            {
                $maps = Map::all();
                $mapList = [];
                foreach($maps as $map)
                {
                    $farms = $map->farm;
                    $province= $farms->province;
                    if($farms->id == $farmId && $province->name == $provinceName)
                    {
                        array_push($mapList, $map);
                    }
                }
                return response()->json([
                    "success"=> true,
                    "data"=> MapResource::collection($mapList)
                ],200);

        }
        }
    
        return response()->json([
            "success"=> false,
            "message"=>"Sorry Farm does not belong to user",
        ],203);
                     
    }

    public function deleteImage(string $provinceName, int $farmId)
    {
    
        $farm = Auth::user()->farm->where('id',$farmId)->first();
        if($farm != null){
            if($farm->id == $farmId)
            {
                $maps = Map::all();
                $mapList = [];
                foreach($maps as $map)
                {
                    $farms = $map->farm;
                    $province= $farms->province;
                    if($farms->id == $farmId && $province->name == $provinceName){
                        array_push($mapList, $map);
                    }
                }
                foreach ($mapList as $map) 
                {
                    $map->delete();
                }
                return response()->json([
                        "success"=> true,
                        "status"=>"Images of Farm " . $farmId . " Succesfully deleted",
                ],200);

            }
        }
    
        return response()->json([
            "success"=> false,
            "message"=>"Sorry Farm does not belong to user",
        ],203);
                 
    }
    public function storeMapInUniqueFarm(MapRequest $request,$provinceName, int $farmId)
    {
        $farm = Auth::user()->farm->where('id',$farmId)->first();
        if($farm != null){
            if($farm->id == $farmId)
            {
                $province = $farm->province->name;
                if($province == $provinceName && $farm->id == $farmId)
                {    
                    $map = Map::create([
                        "image" => $request -> image,
                        "date" => $request -> date,
                        "drone_id" => $request -> drone_id,
                        "farm_id" =>  $farmId,
                    ]);
            
                    return response()->json([
                        'message' => 'Create new map successfully',
                        'data' => $map
                    ]);
                  
                }
                else{
                    return response()->json([
                        "success"=> false,
                        "message"=>"Invalid Province Name!",
                    ],202);

                }
            }
        }
        return response()->json([
            "success"=> false,
            "message"=>"Sorry Farm does not belong to user",
        ],203);
    }
        
           
        
          
       
    


}
