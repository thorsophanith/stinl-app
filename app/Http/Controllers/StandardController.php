<?php

namespace App\Http\Controllers;

use App\Models\standard;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use App\Models\parameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get monthly standards data with dynamic year range
        $monthlyStandards = Standard::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as count')
        )
        ->whereBetween('created_at', [now()->subYear(), now()]) // Last 12 months
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get()
        ->mapWithKeys(function ($item) {
            $monthName = date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year));
            return [$monthName => $item->count];
        })
        ->toArray();
        // Fill in missing months with 0 counts
        $completeMonthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('M Y');
            $completeMonthlyData[$month] = $monthlyStandards[$month] ?? 0;
        }

        // Get standards by type with percentages
        $labTypes = ['Microbiological', 'Chemical', 'Others'];
        $counts = Standard::select('lab_type', DB::raw('count(*) as total'))
            ->groupBy('lab_type')
            ->pluck('total', 'lab_type');

        $totalAll = Standard::count();
        $percentages = [];
        $knownTotal = 0;

        foreach ($labTypes as $type) {
            $count = $counts->get($type, 0);
            $percent = $totalAll > 0 ? round(($count / $totalAll) * 100, 1) : 0;
            $percentages[$type] = $percent;
            $knownTotal += $count;
        }
    
        // Other standards data
        $otherCount = $totalAll - $knownTotal;
        $otherPercent = $totalAll > 0 ? round(($otherCount / $totalAll) * 100, 1) : 0;
    
        // Paginated standards
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
    
        return view('standard.index', [
            'monthlyStandards' => $completeMonthlyData,
            'standards' => $standards,
            'labTypes' => $labTypes,
            'counts' => $counts,
            'percentages' => $percentages,
            'totalAll' => $totalAll,
            'totalPercentage' => array_sum($percentages) + $otherPercent
        ]);
    }

    public function createOne()
{
    return view('standard.createOne');
}

public function create()
{
    $parameters = Parameter::all();
    $labTypeTranslations = [
        'Microbiological' => 'Microbiological',
        'Chemical' => 'Chemical',
        'Others' => 'Others'
    ];
    return view('standard.create', compact('labTypeTranslations'));
}


public function storeOne(Request $request)
{
    $validated = $request->validate([
        'code' => 'required|string',
        'cs' => 'nullable|string',
        'codex' => 'nullable|string',
        'name_en' => 'nullable|string',
        'name_kh' => 'nullable|string',

        'standards' => 'required|array|min:1',
        'standards.*.lab_type' => 'nullable|in:Microbiological,Chemical,Others',
        'standards.*.parameters' => 'nullable|array|min:1',
        'standards.*.parameters.*.name_en' => 'nullable|string',
        'standards.*.parameters.*.name_kh' => 'nullable|string',
        'standards.*.parameters.*.formular' => 'nullable|string',
        'standards.*.parameters.*.criteria_operator' => 'nullable|string',
        'standards.*.parameters.*.criteria_value1' => 'nullable|string|max:50', // <- changed
        'standards.*.parameters.*.criteria_value2' => 'nullable|string',
        'standards.*.parameters.*.unit' => 'nullable|string',
        'standards.*.parameters.*.LOQ' => 'nullable|string',
        'standards.*.parameters.*.method' => 'nullable|string',
    ]);

    foreach ($validated['standards'] as $labData) {
        $standard = Standard::create([
            'code' => $validated['code'],
            'cs' => $validated['cs'],
            'codex' => $validated['codex'],
            'name_en' => $validated['name_en'],
            'name_kh' => $validated['name_kh'],
            'lab_type' => $labData['lab_type'],
        ]);

        $parameterIds = [];

        foreach ($labData['parameters'] as $paramData) {
            $existing = Parameter::where('name_en', $paramData['name_en'])
                ->where('name_kh', $paramData['name_kh'])
                ->where('formular', $paramData['formular'] ?? null)
                ->where('criteria_operator', $paramData['criteria_operator'])
                ->where('criteria_value1', $paramData['criteria_value1'] ?? null)
                ->where('criteria_value2', $paramData['criteria_value2'] ?? null)
                ->where('unit', $paramData['unit'])
                ->where('LOQ', $paramData['LOQ'])
                ->where('method', $paramData['method'])
                ->first();

            $parameterIds[] = $existing ? $existing->id : Parameter::create($paramData)->id;
        }

        $standard->parameters()->sync($parameterIds);
    }

    return redirect()->route('standard.index')->with('success', 'Standard with all lab types created successfully.');
}



public function store(Request $request)
{
    $validated = $request->validate([
        'code' => 'required|string',
        'cs' => 'nullable|string',
        'codex' => 'nullable|string',
        'name_en' => 'nullable|string',
        'name_kh' => 'nullable|string',
        'lab_type' => 'nullable|in:Microbiological,Chemical,Others',

        'parameters' => 'nullable|array|min:1',
        'parameters.*.name_en' => 'nullable|string',
        'parameters.*.name_kh' => 'nullable|string',
        'parameters.*.formular' => 'nullable|string',
        'parameters.*.criteria_operator' => 'nullable|string',
        'parameters.*.criteria_value1' => 'nullable|string|max:50', // <- changed
        'parameters.*.criteria_value2' => 'nullable|string',
        'parameters.*.unit' => 'nullable|string',
        'parameters.*.LOQ' => 'nullable|string',
        'parameters.*.method' => 'nullable|string',
    ]);

    $standard = Standard::create([
        'code' => $validated['code'],
        'cs' => $validated['cs'],
        'codex' => $validated['codex'],
        'name_en' => $validated['name_en'],
        'name_kh' => $validated['name_kh'],
        'lab_type' => $validated['lab_type'],
    ]);

    $parameterIds = [];

    foreach ($validated['parameters'] as $paramData) {
        $existing = Parameter::where('name_en', $paramData['name_en'])
            ->where('name_kh', $paramData['name_kh'])
            ->where('formular', $paramData['formular'] ?? null)
            ->where('criteria_operator', $paramData['criteria_operator'])
            ->where('criteria_value1', $paramData['criteria_value1'] ?? null)
            ->where('criteria_value2', $paramData['criteria_value2'] ?? null)
            ->where('unit', $paramData['unit'])
            ->where('LOQ', $paramData['LOQ'])
            ->where('method', $paramData['method'])
            ->first();

        $parameterIds[] = $existing ? $existing->id : Parameter::create($paramData)->id;
    }

    $standard->parameters()->sync($parameterIds);

    return redirect()->route('standard.index')->with('success', 'Single standard inserted successfully.');
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
        $requiredLabTypes = ['Microbiological', 'Chemical', 'Others'];

        $relatedStandards = Standard::where('code', $standard->code)
            ->where('cs', $standard->cs)
            ->where('codex', $standard->codex)
            ->where('name_en', $standard->name_en)
            ->where('name_kh', $standard->name_kh)
            ->with('parameters')
            ->get()
            ->groupBy('lab_type');

        foreach ($requiredLabTypes as $type) {
            if (!$relatedStandards->has($type)) {
                $relatedStandards[$type] = collect([
                    new Standard([
                        'code' => $standard->code,
                        'cs' => $standard->cs,
                        'codex' => $standard->codex,
                        'name_en' => $standard->name_en,
                        'name_kh' => $standard->name_kh,
                        'lab_type' => $type,
                        'parameters' => collect([new Parameter()])
                    ])
                ]);
            }
        }

        $labTypeTranslations = [
            'Microbiological' => 'Microbiological',
            'Chemical' => 'Chemical',
            'Others' => 'Others'
        ];

        return view('standard.edit', [
            'standard' => $standard,
            'groupedStandards' => $relatedStandards,
            'labTypeTranslations' => $labTypeTranslations,
            'requiredLabTypes' => $requiredLabTypes
        ]);
    }

    public function update(Request $request)
{
    try {
        $validated = $request->validate([
            'standards' => 'required|array:Microbiological,Chemical,Others',
            'standards.*.id' => 'nullable|exists:standards,id',
            'standards.*.code' => 'required|string|max:50',
            'standards.*.cs' => 'nullable|string|max:50',
            'standards.*.codex' => 'nullable|string|max:50',
            'standards.*.name_en' => 'nullable|string|max:255',
            'standards.*.name_kh' => 'nullable|string|max:255',
            'standards.*.lab_type' => 'required|in:Microbiological,Chemical,Others',
            'standards.*.parameters' => 'required|array|min:1',
            'standards.*.parameters.*.id' => 'nullable|exists:parameters,id',
            'standards.*.parameters.*.name_en' => 'required|string|max:255',
            'standards.*.parameters.*.name_kh' => 'required|string|max:255',
            'standards.*.parameters.*.criteria_operator' => 'required|string|max:50',
            'standards.*.parameters.*.criteria_value1' => 'nullable|string',
            'standards.*.parameters.*.criteria_value2' => 'nullable|string',
            'standards.*.parameters.*.unit' => 'required|string|max:50',
            'standards.*.parameters.*.formular' => 'nullable|string|max:255',
            'standards.*.parameters.*.LOQ' => 'nullable|string|max:50',
            'standards.*.parameters.*.method' => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            foreach ($validated['standards'] as $labType => $standardData) {
                $standard = Standard::updateOrCreate(
                    ['id' => $standardData['id'] ?? null],
                    [
                        'code' => $standardData['code'],
                        'cs' => $standardData['cs'] ?? null,
                        'codex' => $standardData['codex'] ?? null,
                        'name_en' => $standardData['name_en'] ?? null,
                        'name_kh' => $standardData['name_kh'] ?? null,
                        'lab_type' => $labType
                    ]
                );

                $parameterIds = [];
                foreach ($standardData['parameters'] as $paramData) {
                    $parameterData = [
                        'name_en' => trim($paramData['name_en']),
                        'name_kh' => trim($paramData['name_kh']),
                        'formular' => $paramData['formular'] ?? null,
                        'criteria_operator' => trim($paramData['criteria_operator']),
                        'criteria_value1' => $paramData['criteria_value1'] ?? null,
                        'criteria_value2' => $paramData['criteria_value2'] ?? null,
                        'unit' => trim($paramData['unit']),
                        'LOQ' => $paramData['LOQ'] ?? null,
                        'method' => $paramData['method'] ?? null,
                    ];

                    $parameter = Parameter::updateOrCreate(
                        ['id' => $paramData['id'] ?? null],
                        $parameterData
                    );

                    $parameterIds[] = $parameter->id;
                }

                $standard->parameters()->sync($parameterIds);
            }
        });

        return redirect()->route('standard.index')
            ->with('success', 'Standards updated successfully.');

    } catch (\Illuminate\Validation\ValidationException $e) {
        return redirect()->back()
            ->withErrors($e->validator)
            ->withInput();
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Something went wrong: ' . $e->getMessage())
            ->withInput();
    }
}


public function destroyByCode($code)
{
    $standards = Standard::where('code', $code)->get();

    if ($standards->isEmpty()) {
        return redirect()->route('standard.index')->with('error', 'No standards found for the provided code.');
    }

    foreach ($standards as $standard) {
        $standard->parameters()->detach();
        $standard->delete();
    }

    return redirect()->route('standard.index')->with('success', "All standards with code $code have been deleted.");
}



    //   Total Standards
    public function totalByLabTypes()
    {
        $counts = Standard::select('lab_type', DB::raw('count(*) as total'))
            ->groupBy('lab_type')
            ->pluck('total', 'lab_type');
        $labTypes = ['Microbiological', 'Chemical', 'Others'];
        $totals = [];
        $sum = $counts->sum();

        foreach ($labTypes as $type) {
            $count = $counts->get($type, 0);
            $percentage = $sum > 0 ? round(($count / $sum) * 100, 2) : 0;
            $totals[$type] = [
                'count' => $count,
                'percentage' => $percentage
            ];
        }

        return view('standard.lab_totals', [
            'totals' => $totals,
            'overall' => $sum
        ]);
    }
}