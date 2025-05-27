<?php

namespace App\Http\Controllers;

use App\Models\standard;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;

class StandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = standard::query();

        if ($request->has('search')) {
            $query->where('name_en', 'like', '%' . $request->input('search') . '%')
                ->orWhere('name_kh', 'like', '%' . $request->input('search') . '%')
                ->orWhere('code', 'like', '%' . $request->input('search') . '%')
                ->orWhere('codex', 'like', '%' . $request->input('search') . '%');
        }
        $perPage = $request->input('per_page', 10);
        $standards = $query->paginate($perPage);
        return view('standard.index', compact('standards'));
    }   

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(standard $standard)
    {
        $parameters = $standard->parameters()->get();
        return view('standard.parameter', compact('parameters', 'standard'));
    }


    public function downloadParametersPdf(string $id)
    {
        $standard = standard::findOrFail($id);
        $parameters = $standard->parameters;

        $html = View::make('pdf.parameters', compact('standard', 'parameters'))->render();

        $mpdf = new Mpdf([
            'tempDir' => storage_path('app/mpdf'), // avoid permission errors
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(standard $standard)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, standard $standard)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(standard $standard)
    {
        //
    }
}
