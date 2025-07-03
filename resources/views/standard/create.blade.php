@extends('includes.app')

@section('content')
<style>
    .lab-tab {
        @apply text-gray-600 border-transparent border-b-2 transition-colors duration-200;
    }

    .lab-tab:hover {
        @apply text-blue-500 border-blue-200;
    }

    .active-tab {
        @apply text-blue-600 border-blue-500 bg-white;
    }
</style>
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
<div class="w-full py-6 px-3">
    <h1 class="text-2xl font-bold mb-4">Create Standard (Microbiological, Chemical, Others)</h1>

    <form action="{{ route('standard.storeOne') }}" method="POST">
        @csrf

        {{-- Global Info --}}
        <div class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="space-y-2">
                <label class="form-label">Code<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
                <input type="text" name="code" required class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out">
            </div>
            <div class="space-y-2">
                <label class="form-label">CS</label>
                <input type="text" name="cs" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out">
            </div>
            <div class="space-y-2">
                <label class="form-label">CODEX</label>
                <input type="text" name="codex" class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out">
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="space-y-2">
                <label class="form-label">Name (English)<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
                <input type="text" name="name_en" required class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out">
            </div>
            <div class="space-y-2">
                <label class="form-label">Name (Khmer)<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
                <input type="text" name="name_kh" required class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out">
            </div>
        </div>

        <div class="mb-6 pt-7">
            <div class="flex gap-1 border-b">
                <button type="button" class="lab-tab active-tab px-4 pt-3 text-sm font-semibold border rounded-t-xl py-1" data-tab="all">All Standards</button>
                @foreach ($labTypeTranslations as $type => $label)
                    <button type="button" class="lab-tab px-4 pt-3 text-sm font-semibold border rounded-t-xl py-1 hover:border-blue-400" data-tab="{{ $type }}">{{ $label }}</button>
                @endforeach
            </div>
        </div>

        {{-- Lab Type Sections --}}
        @foreach ($labTypeTranslations as $type => $label)
            @php $labIndex = $loop->index; @endphp
            <div class="lab-section rounded-lg mb-6" data-tab="{{ $type }}">
                <h2 class="card-header mt-10 mb-10 bg-blue-600 text-white py-3 ring-2 ring-blue-400 px-5 rounded-md font-medium pb-3">{{ $label }}</h2>
                <input type="hidden" name="standards[{{ $labIndex }}][lab_type]" value="{{ $type }}">

                <div class="parameter-section" data-lab="{{ $labIndex }}">
                    @for ($paramIndex = 0; $paramIndex < 1; $paramIndex++)
                        @include('standard.parameter-fields-multi-create', [
                            'labIndex' => $labIndex,
                            'paramIndex' => $paramIndex,
                            'parameter' => null
                        ])
                    @endfor
                </div>

                <button type="button"
                    class="add-parameter bg-green-600 text-white text-sm px-3 mb-2 py-1 rounded hover:bg-green-700 mt-4"
                    data-lab="{{ $labIndex }}">
                    + Add Parameter
                </button>
            </div>
        @endforeach
        <div class="flex justify-end px-2 mb-3">
            <button type="submit" class="btn btn-primary ml-2 max-md:text-xs bg-blue-600 hover:bg-blue-700 ring-2 ring-blue-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Create Standards</button>
        </div>
    </form>
</div>
@endsection

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    document.querySelectorAll('.lab-tab').forEach(tab => {
        tab.addEventListener('click', function () {
            // Remove active-tab from all
            document.querySelectorAll('.lab-tab').forEach(t => t.classList.remove('active-tab'));

            // Add active-tab to the clicked one
            this.classList.add('active-tab');

            // You can also trigger tab content display logic here if needed
        });
    });

</script>