@extends('includes.app')

@section('content')

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif


<form action="{{ isset($price) ? route('parameter-prices.update', $price->id) : route('parameter-prices.store') }}" method="POST">
    @csrf
    @if(isset($price))
        @method('PUT')
    @endif

    <a href="{{ route('parameter-prices.index') }}" class="bg-blue-300 py-1.5 px-3 ml-3 mt-4 rounded-md text-blue-600 hover:underline mb-4 inline-block">
        ← Back home
    </a>
    <h1 class="text-xl text-gray-700 font-bold pb-6 ml-3">
        {{ isset($price) ? 'Edit Price' : 'Add Price List' }}
    </h1>

    <div class="p-3">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div class="mb-4">
                <label class="block text-sm font-medium">Code</label>
                <input type="text" name="code" value="{{ old('code', $price->code ?? '') }}" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Parameter (text)</label>
                <input type="text" name="parameter" value="{{ old('parameter', $price->parameter ?? '') }}" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Select Parameter ID</label>
                <select name="parameter_id" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3">
                    <option value="">-- Select Parameter --</option>
                    @foreach($parameters as $param)
                        <option value="{{ $param->id }}" {{ old('parameter_id', $price->parameter_id ?? '') == $param->id ? 'selected' : '' }}>
                            {{ $param->name_en }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Test Duration (days)</label>
                <input type="number" name="test_duration" value="{{ old('test_duration', $price->test_duration ?? '') }}" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Price (៛)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $price->price ?? '') }}" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium">Lab Type</label>
                <input type="text" name="lab_type" value="{{ old('lab_type', $price->lab_type ?? '') }}" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3">
            </div>

        </div>

        <div class="py-5 flex gap-3 justify-end">
            <button type="submit" class="max-md:text-xs bg-green-500 hover:bg-green-600 ring-2 ring-green-300 ease-in px-10 py-1 text-white duration-300 font-medium rounded-md">
                update
            </button>
        </div>
    </div>
</form>

@endsection
