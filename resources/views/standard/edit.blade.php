@extends('includes.app')

@section('content')


@if (session('success'))
    <div class="mb-4 px-4 py-3 text-green-800 bg-green-100 border border-green-300 rounded-md">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 px-4 py-3 text-red-800 bg-red-100 border border-red-300 rounded-md">
        {{ session('error') }}
    </div>
@endif


<a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
    ← Back home
</a>

<div class="container">
    <h1 class="text-lg text-gray-700 font-medium mb-2 py-3">Edit Standards</h1>

    <div class="flex mb-4 border-b border-gray-200">
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="all">All Standards</button>
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="Microbiological">{{ $labTypeTranslations['Microbiological'] ?? 'Microbiological' }}</button>
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="Chemical">{{ $labTypeTranslations['Chemical'] ?? 'Chemical' }}</button>
    </div>

    <form method="POST" action="{{ route('standard.update.multi') }}">
        @csrf
        @method('PUT')

        @foreach($groupedStandards as $labType => $standards)
            {{-- We assume there's only one standard per labType for simplicity in this view based on how inputs are named --}}
            {{-- If there can be multiple standards per labType, you'd need another foreach loop here --}}
            @foreach($standards as $std)
                <div class="standard-section card mb-4 px-1 md:px-5" data-lab-type="{{ $labType }}">
                    <div class="card-header mt-10 mb-10 bg-blue-300 py-3 ring-2 ring-blue-200 px-5 rounded-md text-xl font-medium mb-4 bg-{{ $labType === 'Microbiological' ? 'info' : ($labType === 'Chemical' ? 'warning' : 'purple') }}">
                        <h3>{{ $labTypeTranslations[$labType] ?? $labType }}</h3>
                    </div>
                    <div class="card-body space-y-5">
                        <input type="hidden" name="standards[{{ $labType }}][id]" value="{{ $std->id }}">
                        <input type="hidden" name="standards[{{ $labType }}][lab_type]" value="{{ $labType }}">

                        <div class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">Code*</label>
                                <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                       name="standards[{{ $labType }}][code]"
                                       value="{{ old("standards.$labType.code", $std->code) }}" required>
                            </div>
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">CS</label>
                                <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                       name="standards[{{ $labType }}][cs]"
                                       value="{{ old("standards.$labType.cs", $std->cs) }}">
                            </div>
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">CODEX</label>
                                <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                       name="standards[{{ $labType }}][codex]"
                                       value="{{ old("standards.$labType.codex", $std->codex) }}">
                            </div>
                        </div>

                        <div class="row mb-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">Name (English)</label>
                                <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                       name="standards[{{ $labType }}][name_en]"
                                       value="{{ old("standards.$labType.name_en", $std->name_en) }}">
                            </div>
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">Name (Khmer)*</label>
                                <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                       name="standards[{{ $labType }}][name_kh]"
                                       value="{{ old("standards.$labType.name_kh", $std->name_kh) }}" required>
                            </div>
                        </div>
                        {{-- Assign a unique ID to each parameters container --}}
                        <div class="parameters-container" id="parameters-container-{{ $labType }}">
                            @foreach($std->parameters as $index => $parameter)
                            <div class="parameter-label col-span-full font-bold text-blue-600 text-lg md:text-xl py-3 sha1">Parameter {{ $index + 1 }}</div>
                                @include('standard.parameter-fields-multi', [
                                    'labType' => $labType,
                                    'index' => $index,
                                    'parameter' => $parameter
                                ])
                            @endforeach
                        </div>
                        <div class="pb-3 pt-5">
                            <button type="button" class="btn ml-2 btn-sm btn-primary add-parameter max-md:text-xs bg-blue-500 hover:bg-blue-600 ring-2 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md" data-lab-type="{{ $labType }}" data-standard-id="{{ $std->id }}">
                                Add Parameter
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach {{-- End foreach $standards --}}
        @endforeach {{-- End foreach $groupedStandards --}}

        <div class="flex justify-end px-2 mb-3 -mt-[55.8px] md:-mt-[64px]">
            <button type="submit" class="btn btn-primary ml-2 max-md:text-xs bg-green-500 hover:bg-green-600 ring-2 ring-green-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Update Standards</button>
        </div>
    </form>
</div>

{{-- This template will be cloned for new parameters --}}
<div id="parameter-template" style="display: none;">
    {{-- The 'parameter-fields-multi' partial will need to be adjusted slightly to handle a `null` parameter --}}
    @include('standard.parameter-fields-multi', [
        'labType' => 'TEMPLATE_LAB_TYPE',
        'index' => 'TEMPLATE_INDEX',
        'parameter' => null // When adding new, parameter will be null
    ])
</div>
@endsection

{{-- <script>

</script> --}}