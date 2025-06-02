@extends('includes.app')
@section('content')
<div class="container">

    <form action="{{ route('standard.update', $standard->id) }}" method="POST">
        @csrf
        @method('PUT')
        <a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
            ← Back home
        </a>
        <h1 class="text-xl text-gray-700 font-bold pb-6">Edit Standard</h1>

        <!-- Standard fields -->
        <div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium">Code</label>
            <input type="text" name="code" value="{{ old('code', $standard->code) }}" class="form-control bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium">Codex</label>
            <input type="text" name="codex" value="{{ old('codex', $standard->codex) }}" class="form-control bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium">Name (EN)</label>
            <input type="text" name="name_en" value="{{ old('name_en', $standard->name_en) }}" class="form-control bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium">Name (KH)</label>
            <input type="text" name="name_kh" value="{{ old('name_kh', $standard->name_kh) }}" class="form-control bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium">Lab Type</label>
            <select name="lab_type" class="form-control bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="Microbiological" {{ $standard->lab_type == 'Microbiological' ? 'selected' : '' }}>Microbiological</option>
                <option value="Chemical" {{ $standard->lab_type == 'Chemical' ? 'selected' : '' }}>Chemical</option>
                <option value="Others" {{ $standard->lab_type == 'Others' ? 'selected' : '' }}>Others</option>
            </select>
        </div>
    </div>

        <hr class="py-2 mt-8">
        <h4 class="mb-5 font-medium text-xl px-10">Parameters</h4>
        <div id="parameter-wrapper">
            @foreach ($standard->parameters as $i => $param)
                <div class="parameter-group mb-3 p-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <input type="hidden" name="parameters[{{ $i }}][existing]" value="1">

                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Parameter Name EN</label>
                        <input type="text" name="parameters[{{ $i }}][name_en]" value="{{ $param->name_en }}" placeholder="Parameter Name EN" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Parameter Name KH</label>
                        <input type="text" name="parameters[{{ $i }}][name_kh]" value="{{ $param->name_kh }}" placeholder="Parameter Name KH" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Formular</label>
                        <input type="text" name="parameters[{{ $i }}][formular]" value="{{ $param->formular }}" placeholder="Formular" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Operator</label>
                        <input type="text" name="parameters[{{ $i }}][criteria_operator]" value="{{ $param->criteria_operator }}" placeholder="Operator" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Value 1</label>
                        <input type="number" step="any" name="parameters[{{ $i }}][criteria_value1]" value="{{ $param->criteria_value1 }}" placeholder="Value 1" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Value 2</label>
                        <input type="number" step="any" name="parameters[{{ $i }}][criteria_value2]" value="{{ $param->criteria_value2 }}" placeholder="Value 2" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Unit</label>
                        <input type="text" name="parameters[{{ $i }}][unit]" value="{{ $param->unit }}" placeholder="Unit" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">LOQ</label>
                        <input type="text" name="parameters[{{ $i }}][LOQ]" value="{{ $param->LOQ }}" placeholder="LOQ" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                    <div class="space-y-2 lg:px-10">
                        <label class="text-sm text-gray-700 px-1 font-medium">Method</label>
                        <input type="text" name="parameters[{{ $i }}][method]" value="{{ $param->method }}" placeholder="Method" class="form-control mb-2 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>
            @endforeach
        </div>
        <div class="px-10">
            <button type="submit" class="max-md:text-xs bg-blue-500 hover:bg-blue-600 ring-2 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md mb-3">Update Standard</button>
        </div>
    </form>
</div>
@endsection
