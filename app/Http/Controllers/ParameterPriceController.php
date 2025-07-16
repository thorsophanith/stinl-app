<?php
namespace App\Http\Controllers;

use App\Models\Parameter;
use App\Models\ParameterPrice;
use Illuminate\Http\Request;

class ParameterPriceController extends Controller
{
    // --- API METHODS ---

    public function index()
    {
        return response()->json(ParameterPrice::with('parameter')->get());
    }

    public function show($id)
    {
        $price = ParameterPrice::with('parameter')->findOrFail($id);
        return response()->json($price);
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'code' => 'nullable|string|unique:parameter_prices,code',
            'parameter' => 'nullable|string',
            'test_duration' => 'nullable|integer',
            'price' => 'nullable|numeric|between:0,99999999.99',
            'lab_type' => 'nullable|string',
            'parameter_id' => 'nullable|exists:parameters,id',
        ]);

        $price = ParameterPrice::create($validated);

        if ($request->expectsJson()) {
            return response()->json($price, 201);
        }

        return redirect()->route('parameter-prices.index')->with('success', 'Price saved successfully.');
    }

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

    if ($request->expectsJson()) {
        return response()->json($price);
    }

    return redirect()->route('parameter-prices.index')
        ->with('success', 'Price list updated successfully.');
}



    public function edit($id)
{
    $price = ParameterPrice::findOrFail($id);
    $parameters = Parameter::all(); // for the select dropdown
    return view('parameter_prices.edit', compact('price', 'parameters'));
}



    public function destroy($id)
{
    $price = ParameterPrice::findOrFail($id);
    $price->delete();

    if (request()->expectsJson()) {
        return response()->json(['message' => 'Deleted successfully']);
    }

    return redirect()->route('parameter-prices.index')
        ->with('success', 'Price list deleted successfully');
}

    // --- WEB METHODS ---

    public function indexWeb(Request $request)
{
    $query = ParameterPrice::with('parameter');

    if ($search = $request->input('search')) {
        $query->where('code', 'like', "%{$search}%")
              ->orWhereHas('parameter', fn($q) => $q->where('name_en', 'like', "%{$search}%"));
    }

    $perPage = $request->input('per_page', 10);
    $prices = $query->paginate($perPage)->appends($request->except('page'));

    return view('parameter_prices.index', compact('prices'));
}


    public function create()
    {
        $parameters = Parameter::all();
        return view('parameter_prices.create', compact('parameters'));
    }

    public function showWeb($id)
    {
        $price = ParameterPrice::with('parameter')->findOrFail($id);
        return view('parameter_prices.show', compact('price'));
    }
}