<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmRequest;
use App\Models\Farm;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FarmRequest $request)
    {
        $farm = Farm::create([
            "farm_name"=>$request->farm_name,
            "province_id"=>$request->province_id,
            "user_id"=>$request->user_id
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Create Farm successfull",
            'data' => $farm
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Farm $farm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FarmRequest $request, string $id)
    {
        $farm = Farm::find($id)->update([
            "farm_name"=>$request->farm_name,
            "province_id"=>$request->province_id,
            "user_id"=>$request->user_id
        ]);
        return response()->json([
            "success"=> true,
            "message"=>"Update Farm successfull",
            'data' => $farm
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Farm $farm)
    {
        //
    }
}
