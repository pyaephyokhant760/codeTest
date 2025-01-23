<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::all();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => 'validation error', 'errors' => $validatedData->errors()], 422);
        }

        $data = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return response()->json(['status' => True,'message'=> $data],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $searchId = Product::where('id', $id)->first();
        if(isset($searchId)) {
            $data = Product::where('id',$id)->first();
            return response()->json(['status' => True,$data, 200]);
        }
        return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
