<?php

namespace App\Http\Controllers;

use App\Models\standard;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use App\Models\parameter; 
use Illuminate\Validation\Rule;

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
        $labTypeTranslations = [
            'Microbiological' => 'ស្តង់ដាមីក្រូជីវសាស្ត្រ',
            'Chemical' => 'ស្តង់ដាគីមីសាស្ត្រ',
            'Others' => 'ប៉ារ៉ាម៉ែត្រផ្សេទៀតដែលមានចែង'
        ];

        return view('standard.create', compact('labTypeTranslations'));
    }

    public function createOne()
{
    return view('standard.createOne');
}


    public function storeOne(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                Rule::unique('standards')->where(function ($query) use ($request) {
                    return $query->where('lab_type', $request->lab_type);
                }),
            ],
            'cs' => 'nullable|string',
            'codex' => 'nullable|string',
            'name_en' => 'nullable|string',
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

        // Create standard
        $standard = standard::create([
            'code' => $validated['code'],
            'cs' => $validated['cs'],
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
                $new = parameter::create([
                    'name_en' => $paramData['name_en'],
                    'name_kh' => $paramData['name_kh'],
                    'formular' => $paramData['formular'] ?? null,
                    'criteria_operator' => $paramData['criteria_operator'],
                    'criteria_value1' => $paramData['criteria_value1'],
                    'criteria_value2' => $paramData['criteria_value2'] ?? null,
                    'unit' => $paramData['unit'],
                    'LOQ' => $paramData['LOQ'],
                    'method' => $paramData['method'],
                ]);

                $parameterIds[] = $new->id;
            }
        }

        // Attach parameters to the standard
        $standard->parameters()->sync($parameterIds);

        return redirect()->route('standard.index')->with('success', 'Standard and parameters created successfully.');
    }



    public function store(Request $request)
    {
        $validated = $request->validate([
            'standards' => 'required|array|min:1',
            'standards.*.code' => 'nullable|string',
            'standards.*.cs' => 'nullable|string',
            'standards.*.codex' => 'nullable|string',
            'standards.*.name_en' => 'nullable|string',
            'standards.*.name_kh' => 'nullable|string',
            'standards.*.lab_type' => 'required|in:Microbiological,Chemical,Others',
    
            'standards.*.parameters' => 'required|array|min:1',
            'standards.*.parameters.*.name_en' => 'nullable|string',
            'standards.*.parameters.*.name_kh' => 'nullable|string',
            'standards.*.parameters.*.formular' => 'nullable|string',
            'standards.*.parameters.*.criteria_operator' => 'nullable|string',
            'standards.*.parameters.*.criteria_value1' => 'nullable|numeric',
            'standards.*.parameters.*.criteria_value2' => 'nullable|numeric',
            'standards.*.parameters.*.unit' => 'nullable|string',
            'standards.*.parameters.*.LOQ' => 'nullable|string',
            'standards.*.parameters.*.method' => 'nullable|string',
        ]);
    
        foreach ($validated['standards'] as $stdData) {
            $standard = Standard::create([
                'code' => $stdData['code'],
                'cs' => $stdData['cs'],
                'codex' => $stdData['codex'],
                'name_en' => $stdData['name_en'],
                'name_kh' => $stdData['name_kh'],
                'lab_type' => $stdData['lab_type'],
            ]);
    
            $parameterIds = [];
    
            foreach ($stdData['parameters'] as $paramData) {
                $existing = Parameter::where('name_en', $paramData['name_en'])
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
                    $new = Parameter::create($paramData);
                    $parameterIds[] = $new->id;
                }
            }
    
            $standard->parameters()->sync($parameterIds);
        }
    
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
            'tempDir' => storage_path('app/mpdf'),
            'fontDir' => [base_path('resources/fonts')],
            'fontdata' => [
                'noto' => [
                    'R' => 'NotoSansKhmer-Regular.ttf',
                    'B' => 'NotoSansKhmer-Bold.ttf',
                ],
            ],
            'default_font' => 'noto',
        ]);

        $mpdf->WriteHTML($html);
        return response($mpdf->Output("standard-{$standard->id}-parameters.pdf", 'D'), 200)
            ->header('Content-Type', 'application/pdf');
    }


public function edit(Standard $standard)
{
    // Get all standards with the same identifying fields
    $relatedStandards = Standard::where('code', $standard->code)
        ->where('cs', $standard->cs)
        ->where('codex', $standard->codex)
        ->where('name_en', $standard->name_en)
        ->where('name_kh', $standard->name_kh)
        ->with('parameters')
        ->get()
        ->groupBy('lab_type');

    // Define only required lab types (excluding 'Others')
    $labTypes = ['Microbiological', 'Chemical'];

    foreach ($labTypes as $type) {
        if (!$relatedStandards->has($type)) {
            $relatedStandards[$type] = collect([
                new Standard([
                    'code' => $standard->code,
                    'cs' => $standard->cs,
                    'codex' => $standard->codex,
                    'name_en' => $standard->name_en,
                    'name_kh' => $standard->name_kh,
                    'lab_type' => $type,
                    'parameters' => collect()
                ])
            ]);
        }
    }

    // Khmer translations for lab types
    $labTypeTranslations = [
        'Microbiological' => 'ស្តង់ដាមីក្រូជីវសាស្ត្រ',
        'Chemical' => 'ស្តង់ដាគីមីសាស្ត្រ'
    ];

    return view('standard.edit', [
        'standard' => $standard,
        'groupedStandards' => $relatedStandards,
        'labTypeTranslations' => $labTypeTranslations
    ]);
}


public function update(Request $request)
{
    $validated = $request->validate([
        'standards' => 'required|array|min:1',
        'standards.*.id' => 'nullable|exists:standards,id',
        'standards.*.code' => [
            'required',
            'string',
            function ($attribute, $value, $fail) use ($request) {
                $codes = array_column($request->standards, 'code');
                if (count(array_unique($codes)) > 1) {
                    $fail('All standards must have the same code.');
                }
            },
        ],
        'standards.*.cs' => 'nullable|string',
        'standards.*.codex' => 'nullable|string',
        'standards.*.name_en' => 'nullable|string',
        'standards.*.name_kh' => 'required|string',
        'standards.*.lab_type' => 'required|in:Microbiological,Chemical',

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

    $anyRemoved = false;

    foreach ($validated['standards'] as $stdData) {
        $standard = !empty($stdData['id'])
            ? Standard::findOrFail($stdData['id'])
            : Standard::create(array_merge($stdData, ['lab_type' => $stdData['lab_type']]));

        if (!empty($stdData['id'])) {
            $standard->update([
                'code' => $stdData['code'],
                'cs' => $stdData['cs'],
                'codex' => $stdData['codex'],
                'name_en' => $stdData['name_en'],
                'name_kh' => $stdData['name_kh'],
                'lab_type' => $stdData['lab_type'],
            ]);
        }

        $parameterIds = [];
        foreach ($stdData['parameters'] as $paramData) {
            $existing = Parameter::where('name_en', $paramData['name_en'])
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
                $new = Parameter::create($paramData);
                $parameterIds[] = $new->id;
            }
        }

        $originalIds = $standard->parameters()->pluck('parameters.id')->toArray();
        $removed = array_diff($originalIds, $parameterIds);
        if (count($removed) > 0) {
            $anyRemoved = true;
        }

        $standard->parameters()->sync($parameterIds);
    }

    return redirect()
        ->route('standard.index')
        ->with('success', 'Standards updated successfully.')
        ->with('removed', $anyRemoved ? 'Some parameters were removed.' : null);
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