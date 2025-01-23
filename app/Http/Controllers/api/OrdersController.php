<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;


class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::all();
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
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        if ($validatedData->fails()) {
            return response()->json(['status' => false, 'message' => 'validation error', 'errors' => $validatedData->errors()], 422);
        }
        $product = Product::find($request->product_id); // Get product by ID
        $totalPrice = $product->price * $request->quantity;

        $data = Order::create([
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'total_price' => $totalPrice,
            'quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        return response()->json(['status' => True,'message'=> $data],200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $searchId = Order::where('id', $id)->first();
        if(isset($searchId)) {
            $data = Order::where('id',$id)->first();
            return response()->json(['status' => True,$data, 200]);
        }
        return response()->json(['status' => False ,'message' => 'Try Again'],200);
    }

}
