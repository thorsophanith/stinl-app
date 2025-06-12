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
    <h1 class="text-lg text-gray-700 font-medium mb-2 py-3">Create New Standards</h1>

    <div class="flex mb-4 border-b border-gray-200">
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="all">All Standards</button>
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="Microbiological">{{ $labTypeTranslations['Microbiological'] ?? 'Microbiological' }}</button>
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="Chemical">{{ $labTypeTranslations['Chemical'] ?? 'Chemical' }}</button>
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="Others">
            {{ $labTypeTranslations['Others'] ?? 'Others' }}
        </button>
    </div>

    <form method="POST" action="{{ route('standard.store') }}">
        @csrf

        @foreach(['Microbiological', 'Chemical', 'Others'] as $labType)
            <div class="standard-section card mb-4 px-1 md:px-5" data-lab-type="{{ $labType }}">
                <div class="card-header mt-10 mb-10 bg-blue-300 py-3 ring-2 ring-blue-200 px-5 rounded-md text-xl font-medium mb-4 bg-{{ $labType === 'Microbiological' ? 'blue' : ($labType === 'Chemical' ? 'yellow' : 'purple') }}-300">
                    <h3>{{ $labTypeTranslations[$labType] ?? $labType }}</h3>
                </div>
                <div class="card-body space-y-5">
                    <input type="hidden" name="standards[{{ $labType }}][lab_type]" value="{{ $labType }}">

                    <div class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="space-y-2">
                            <label class="form-label text-sm text-gray-700 px-1 font-medium">Code*</label>
                            <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                   name="standards[{{ $labType }}][code]"
                                   value="{{ old("standards.$labType.code") }}" required>
                        </div>
                        <div class="space-y-2">
                            <label class="form-label text-sm text-gray-700 px-1 font-medium">CS</label>
                            <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                   name="standards[{{ $labType }}][cs]"
                                   value="{{ old("standards.$labType.cs") }}">
                        </div>
                        <div class="space-y-2">
                            <label class="form-label text-sm text-gray-700 px-1 font-medium">CODEX</label>
                            <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                   name="standards[{{ $labType }}][codex]"
                                   value="{{ old("standards.$labType.codex") }}">
                        </div>
                    </div>

                    <div class="row mb-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="form-label text-sm text-gray-700 px-1 font-medium">Name (English)</label>
                            <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                   name="standards[{{ $labType }}][name_en]"
                                   value="{{ old("standards.$labType.name_en") }}">
                        </div>
                        <div class="space-y-2">
                            <label class="form-label text-sm text-gray-700 px-1 font-medium">Name (Khmer)*</label>
                            <input type="text" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                                   name="standards[{{ $labType }}][name_kh]"
                                   value="{{ old("standards.$labType.name_kh") }}" required>
                        </div>
                    </div>

                    <div class="parameters-container" id="parameters-container-{{ $labType }}">
                        {{-- Initial parameter field --}}
                        <div class="parameter-group mb-3 p-3 border rounded">
                            <div class="parameter-label col-span-full font-bold text-blue-600 text-lg md:text-xl py-3 sha1">Parameter 1</div>
                            @include('standard.parameter-fields-multi', [
                                'labType' => $labType,
                                'index' => 0,
                                'parameter' => null
                            ])
                        </div>
                    </div>

                    <div class="pb-3 pt-5">
                        <button type="button" class="btn ml-2 btn-sm btn-primary add-parameter max-md:text-xs bg-blue-500 hover:bg-blue-600 ring-2 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md" data-lab-type="{{ $labType }}">
                            Add Parameter
                        </button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="flex justify-end px-2 mb-3 -mt-[55.8px] md:-mt-[64px]">
            <button type="submit" class="btn btn-primary ml-2 max-md:text-xs bg-green-500 hover:bg-green-600 ring-2 ring-green-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Create Standards</button>
        </div>
    </form>
</div>

{{-- This template will be cloned for new parameters --}}
<div id="parameter-template" style="display: none;">
    @include('standard.parameter-fields-multi', [
        'labType' => 'TEMPLATE_LAB_TYPE',
        'index' => 'TEMPLATE_INDEX',
        'parameter' => null
    ])
</div>
@endsection

@if ($errors->any())
    <script>
        window.addEventListener('load', () => {
            document.getElementById('errorDialog').classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

    <div id="errorDialog" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 max-w-md text-gray-800 relative">
            <h2 class="text-lg font-semibold mb-2">⚠️ Submission Alert</h2>
            <ul class="list-disc list-inside text-sm text-red-600 mb-4 max-h-48 overflow-y-auto pr-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <div class="flex justify-end gap-3">
                <button onclick="closeErrorDialog()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Stay and Edit</button>
                <a href="{{ url()->previous() }}" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Leave</a>
            </div>
        </div>
    </div>
@endif

<script>
function closeErrorDialog() {
        document.getElementById('errorDialog').classList.add('hidden');
    }
</script>
