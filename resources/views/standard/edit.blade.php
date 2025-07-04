@extends('includes.app')

@section('content')

@if (session('error'))
    <div class="mb-4 px-4 py-3 text-red-800 bg-red-100 border border-red-300 rounded-md">
        {{ session('error') }}
    </div>
@endif

@if (session('removed'))
    <div class="alert alert-warning">
        {{ session('removed') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 px-4 py-3 text-red-800 bg-red-100 border border-red-300 rounded-md">
        <p class="font-semibold mb-2">There were some problems with your input:</p>
        <ul class="list-disc pl-5 space-y-1 text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
    ← Back home
</a>

<div class="w-full">
    <h1 class="text-lg text-gray-700 font-medium mb-7">Edit Standards / <span class="text-xl text-gray-700 font-semibold">{{ $standard->code }} {{ $standard->name_kh }}</span></h1>
    @php
        $labTypeLabels = [
            'Microbiological' => 'Microbiological',
            'Chemical' => 'Chemical',
            'Others' => 'Others'
        ];

        function formatChemicalFormula($text) {
            $text = preg_replace_callback('/\^\((.*?)\)/', fn($m) => '<sup>' . $m[1] . '</sup>', $text);
            $text = preg_replace('/([A-Za-z])(\d+)/', '$1<sub>$2</sub>', $text);
            return $text;
        }
    @endphp

    <div class="flex mb-4 border-b border-gray-200">
        <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="all">All Standards</button>
        @foreach($labTypeLabels as $type => $label)
            <button class="filter-tab py-2 px-4 font-medium text-sm rounded-t-lg mr-1 bg-gray-100 text-gray-700" data-filter="{{ $type }}">
                {{ $labTypeTranslations[$type] ?? $type }}
            </button>
        @endforeach
    </div>

    <form method="POST" action="{{ route('standard.update.multi') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @foreach($groupedStandards as $labType => $standards)
            @foreach($standards as $std)
                @if ($std->parameters->isNotEmpty())
                <div class="standard-section card mb-4 px-1 md:px-5" data-lab-type="{{ $labType }}">
                    <div class="">
                        <h2 class="card-header mt-10 mb-10 bg-blue-600 text-white py-3 ring-2 ring-blue-400 px-5 rounded-md font-medium pb-3">
                            {{ $labTypeLabels[$labType] ?? $labType }}
                        </h2>
                    </div>
                    <div class="card-body space-y-5">
                        <input type="hidden" name="standards[{{ $labType }}][id]" value="{{ $std->id }}">
                        <input type="hidden" name="standards[{{ $labType }}][lab_type]" value="{{ $labType }}">

                        <div class="mb-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach (['code' => 'Code*', 'cs' => 'CS', 'codex' => 'CODEX'] as $field => $label)
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">{{ $label }}</label>
                                <input type="text" name="standards[{{ $labType }}][{{ $field }}]" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500 text-sm" value="{{ old("standards.$labType.$field", $std->$field) }}" {{ $field === 'code' ? 'required' : '' }}>
                            </div>
                            @endforeach
                        </div>

                        <div class="row mb-3 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">Name (English)*</label>
                                <input type="text" name="standards[{{ $labType }}][name_en]" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500 text-sm" value="{{ old("standards.$labType.name_en", $std->name_en) }}">
                            </div>
                            <div class="space-y-2">
                                <label class="form-label text-sm text-gray-700 px-1 font-medium">Name (Khmer)*</label>
                                <input type="text" name="standards[{{ $labType }}][name_kh]" class="form-control w-full p-3 border border-gray-300 rounded-lg focus:ring-sky-500 focus:border-sky-500 text-sm" value="{{ old("standards.$labType.name_kh", $std->name_kh) }}" required>
                            </div>
                        </div>

                        <div class="parameters-container" id="parameters-container-{{ $labType }}">
                            @foreach($std->parameters as $index => $parameter)
                                @include('standard.parameter-fields-multi', compact('labType', 'index', 'parameter'))
                            @endforeach
                        </div>

                        <div class="pb-3 pt-1">
                            <button type="button" class="add-parameter bg-green-600 text-white text-sm px-3 mb-2 py-1 rounded hover:bg-green-700" data-lab-type="{{ $labType }}" data-standard-id="{{ $std->id }}">
                                + Add Parameter
                            </button>
                            
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        @endforeach

        <div class="flex justify-end px-2 mb-3">
            <button type="submit" class="btn bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 ring-2 ring-blue-300">Update Standards</button>
            
        </div>
    </form>
</div>

<div id="parameter-template" style="display: none;">
    @include('standard.parameter-fields-multi', [
        'labType' => 'TEMPLATE_LAB_TYPE',
        'index' => 'TEMPLATE_INDEX',
        'parameter' => null
    ])
</div>
@endsection


<script>

// Sync contenteditable
function syncInput(contentDiv) {
    const targetId = contentDiv.getAttribute('data-target-input');
    const targetInput = document.getElementById(targetId);
    if (targetInput) {
        targetInput.value = contentDiv.innerHTML;
    }
}

// Add
function setupRichTextEditor(toolbarRoot = document) {
    const toolbars = toolbarRoot.querySelectorAll('.toolbar');

    toolbars.forEach(toolbar => {
        toolbar.querySelectorAll('[data-command]').forEach(button => {
            button.addEventListener('click', function () {
                const command = this.getAttribute('data-command');
                document.execCommand(command, false, null);
            });
        });
    });
}
// Initialize
window.addEventListener('DOMContentLoaded', () => {
    setupRichTextEditor();

    // Optional
    const observer = new MutationObserver((mutations) => {
        for (const mutation of mutations) {
            mutation.addedNodes.forEach(node => {
                if (node.nodeType === 1) {
                    setupRichTextEditor(node);
                }
            });
        }
    });

    observer.observe(document.body, { childList: true, subtree: true });
});

</script>