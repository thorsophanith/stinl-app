<?php

namespace App\Http\Controllers;

use App\Models\ParameterPrice;
use Illuminate\Http\Request;

class ParameterPriceController extends Controller
{
    // GET /api/parameter-prices
    public function index()
    {
        return response()->json(ParameterPrice::with('parameter')->get());
    }

    // POST /api/parameter-prices
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'nullable|string|unique:parameter_prices,code',
            'parameter' => 'nullable|string',
            'test_duration' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'lab_type' => 'nullable|string',
            'parameter_id' => 'nullable|exists:parameters,id',
        ]);

        $price = ParameterPrice::create($validated);

        return response()->json($price, 201);
    }

    // GET /api/parameter-prices/{id}
    public function show($id)
    {
        $price = ParameterPrice::with('parameter')->findOrFail($id);
        return response()->json($price);
    }

    // PUT /api/parameter-prices/{id}
    public function update(Request $request, $id)
    {
        $price = ParameterPrice::findOrFail($id);

        $validated = $request->validate([
            'code' => 'nullable|string|unique:parameter_prices,code,' . $price->id,
            'parameter' => 'nullable|string',
            'test_duration' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'lab_type' => 'nullable|string',
            'parameter_id' => 'nullable|exists:parameters,id',
        ]);

        $price->update($validated);

        return response()->json($price);
    }

    // DELETE /api/parameter-prices/{id}
    public function destroy($id)
    {
        $price = ParameterPrice::findOrFail($id);
        $price->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
