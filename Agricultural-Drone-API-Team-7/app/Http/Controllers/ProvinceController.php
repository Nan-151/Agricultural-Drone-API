<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvinceResource;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $provinces = Province::all();
        $provinces = ProvinceResource::collection($provinces);

        return response()->json([
            'message' => 'Successfully',
            'data' => $provinces
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $province = Province::create([
            "name" => $request -> name
        ]);

        return response()->json([
            'message' => 'Store new province successfully',
            'data' => $province
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        //
    }
}
