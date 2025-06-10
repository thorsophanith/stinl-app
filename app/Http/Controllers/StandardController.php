<?php

namespace App\Http\Controllers;

use App\Models\standard;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use App\Models\parameter; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $query = Standard::selectRaw('MIN(id) as id, code, cs, codex, name_en, name_kh')
            ->groupBy('code', 'cs', 'codex', 'name_en', 'name_kh');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->havingRaw('name_en LIKE ? OR name_kh LIKE ? OR code LIKE ? OR codex LIKE ? OR cs LIKE ?', [
                "%$search%", "%$search%", "%$search%", "%$search%", "%$search%"
            ]);
        }

        $standards = $query->paginate($perPage);

        return view('standard.index', compact('standards'));
    }
  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('standard.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validated = $request->validate([
            'standards' => 'required|array|min:1|max:3',
            'standards.*.code' => 'required|string',
            'standards.*.cs' => 'nullable|string',
            'standards.*.codex' => 'nullable|string',
            'standards.*.name_en' => 'nullable|string',
            'standards.*.name_kh' => 'required|string',
            'standards.*.lab_type' => 'required|in:Microbiological,Chemical,Others',

            'standards.*.parameters' => 'required|array|min:1',
            'standards.*.parameters.*.name_en' => 'required|string',
            'standards.*.parameters.*.name_kh' => 'required|string',
            'standards.*.parameters.*.formular' => 'nullable|string',
            'standards.*.parameters.*.criteria_operator' => 'required|string',
            'standards.*.parameters.*.criteria_value1' => 'required|numeric',
            'standards.*.parameters.*.criteria_value2' => 'nullable|numeric',
            'standards.*.parameters.*.unit' => 'required|string',
            'standards.*.parameters.*.LOQ' => 'nullable|string',
            'standards.*.parameters.*.method' => 'nullable|string',
        ]);

        // Ensure lab_types are unique within the request
        $labTypes = collect($validated['standards'])->pluck('lab_type');
        if ($labTypes->unique()->count() !== $labTypes->count()) {
            return back()->withErrors(['standards' => 'Each standard must have a unique lab type.']);
        }

        DB::transaction(function () use ($validated) {
            foreach ($validated['standards'] as $stdData) {
                // Validate uniqueness manually (code + lab_type)
                if (standard::where('code', $stdData['code'])->where('lab_type', $stdData['lab_type'])->exists()) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'standards' => ["The code '{$stdData['code']}' already exists for lab type '{$stdData['lab_type']}'."]
                    ]);
                }

                // Create standard
                $standard = standard::create([
                    'code' => $stdData['code'],
                    'cs' => $stdData['cs'] ?? null,
                    'codex' => $stdData['codex'] ?? null,
                    'name_en' => $stdData['name_en'] ?? null,
                    'name_kh' => $stdData['name_kh'],
                    'lab_type' => $stdData['lab_type'],
                ]);

                // Process parameters
                $parameterIds = [];

                foreach ($stdData['parameters'] as $paramData) {
                    $existing = parameter::where('name_en', $paramData['name_en'])
                        ->where('name_kh', $paramData['name_kh'])
                        ->where('formular', $paramData['formular'] ?? null)
                        ->where('criteria_operator', $paramData['criteria_operator'])
                        ->where('criteria_value1', $paramData['criteria_value1'])
                        ->where('criteria_value2', $paramData['criteria_value2'] ?? null)
                        ->where('unit', $paramData['unit'])
                        ->where('LOQ', $paramData['LOQ'] ?? null)
                        ->where('method', $paramData['method'] ?? null)
                        ->first();

                    if ($existing) {
                        $parameterIds[] = $existing->id;
                    } else {
                        $new = parameter::create([
                            'name_en' => $paramData['name_en'],
                            'name_kh' => $paramData['name_kh'],
                            'formular' => $paramData['formular'] ?? null,
                            'criteria_operator' => $paramData['criteria_operator'],
                            'criteria_value1' => $paramData['criteria_value1'],
                            'criteria_value2' => $paramData['criteria_value2'] ?? null,
                            'unit' => $paramData['unit'],
                            'LOQ' => $paramData['LOQ'] ?? null,
                            'method' => $paramData['method'] ?? null,
                        ]);

                        $parameterIds[] = $new->id;
                    }
                }

                // Sync parameters to this standard
                $standard->parameters()->sync($parameterIds);
            }
        });

        return redirect()->route('standard.index')->with('success', 'Standards created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Standard $standard)
    {
        $relatedStandards = Standard::where('code', $standard->code)
            ->where('cs', $standard->cs)
            ->where('codex', $standard->codex)
            ->where('name_en', $standard->name_en)
            ->where('name_kh', $standard->name_kh)
            ->with('parameters')
            ->get()
            ->groupBy('lab_type');

        return view('standard.parameter', [
            'standard' => $standard,
            'groupedStandards' => $relatedStandards
        ]);
    }

    public function downloadParametersPdf(string $id)
    {
        $standard = standard::findOrFail($id);
        $parameters = $standard->parameters;

        $html = View::make('pdf.parameters', compact('standard', 'parameters'))->render();

        $mpdf = new Mpdf([
            'tempDir' => storage_path('app/mpdf'), // avoid permission errors
        ]);

        $mpdf->WriteHTML($html);
        return response($mpdf->Output("standard-{$standard->id}-parameters.pdf", 'D'), 200)
            ->header('Content-Type', 'application/pdf');

    }



/**
     * Show the form for editing the specified resource.
     */
    public function edit(Standard $standard)
    {
        // Load parameters related to this standard
        $parameters = $standard->parameters()->get();

        return view('standard.edit', compact('standard', 'parameters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Standard $standard)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                Rule::unique('standards')->ignore($standard->id)->where(function ($query) use ($request) {
                    return $query->where('lab_type', $request->lab_type);
                }),
            ],
            'codex' => 'required|string',
            'name_en' => 'required|string',
            'name_kh' => 'required|string',
            'lab_type' => 'required|in:Microbiological,Chemical,Others',

            'parameters' => 'required|array|min:1',
            'parameters.*.name_en' => 'required|string',
            'parameters.*.name_kh' => 'required|string',
            'parameters.*.formular' => 'nullable|string',
            'parameters.*.criteria_operator' => 'required|string',
            'parameters.*.criteria_value1' => 'required|numeric',
            'parameters.*.criteria_value2' => 'nullable|numeric',
            'parameters.*.unit' => 'required|string',
            'parameters.*.LOQ' => 'nullable|string',
            'parameters.*.method' => 'nullable|string',
        ]);

        // Update standard
        $standard->update([
            'code' => $validated['code'],
            'codex' => $validated['codex'],
            'name_en' => $validated['name_en'],
            'name_kh' => $validated['name_kh'],
            'lab_type' => $validated['lab_type'],
        ]);

        $parameterIds = [];
        foreach ($validated['parameters'] as $paramData) {
            $existing = parameter::where('name_en', $paramData['name_en'])
                ->where('name_kh', $paramData['name_kh'])
                ->where('formular', $paramData['formular'] ?? null)
                ->where('criteria_operator', $paramData['criteria_operator'])
                ->where('criteria_value1', $paramData['criteria_value1'])
                ->where('criteria_value2', $paramData['criteria_value2'] ?? null)
                ->where('unit', $paramData['unit'])
                ->where('LOQ', $paramData['LOQ'])
                ->where('method', $paramData['method'])
                ->first();

            if ($existing) {
                $parameterIds[] = $existing->id;
            } else {
                $new = parameter::create($paramData);
                $parameterIds[] = $new->id;
            }
        }

        $standard->parameters()->sync($parameterIds);

        return redirect()->route('standard.index')->with('success', 'Standard updated successfully.');
    }

    public function destroy(Standard $standard)
    {
        // Detach all parameters from the standard before deleting
        // This is important for many-to-many relationships if you don't have
        // 'onDelete('cascade')' on your pivot table foreign keys.
        // If you do have cascade delete on your pivot table, this line is optional
        // as the pivot records will be removed automatically.
        $standard->parameters()->detach();

        $standard->delete();

        return redirect()->route('standard.index')->with('success', 'Standard deleted successfully.');
    }


}
