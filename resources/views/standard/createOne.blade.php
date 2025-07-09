@extends('includes.app')
@section('content')
<form action="{{ route('standard.store') }}" method="POST" id="standardForm">
    @csrf
    <a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 ml-3 mt-4 rounded-md text-blue-600 hover:underline mb-4 inline-block">
        ← Back home
    </a>
    <h1 class="text-xl text-gray-700 font-bold pb-6 ml-3">Add One Standard</h1>
    <div class="p-3">
        <!-- Standard fields -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="space-y-2">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">STD</label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="text" name="code" placeholder="***STD" value="{{ old('code') }}"><br>
            </div>

            <div class="space-y-2">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">CS</label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                type="text" name="cs" placeholder="CS" value="{{ old('cs') }}" ><br>
            </div>

            <div class="space-y-2">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Codex</label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                type="text" name="codex" placeholder="Codex" value="{{ old('codex') }}" ><br>
            </div>

            <div class="space-y-2">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name EN</label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                type="text" name="name_en" placeholder="Standard Name EN" value="{{ old('name_en') }}"><br>
            </div>

            <div class="space-y-2">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name KH </label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                type="text" name="name_kh" placeholder="Standard Name KH" value="{{ old('name_kh') }}" ><br>
            </div>

            <div class="space-y-2">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Select Lab Type
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <select class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" name="lab_type" required>
                    <option value="">-- Select Lab Type --</option>
                    <option value="Microbiological" {{ old('lab_type') == 'Microbiological' ? 'selected' : '' }}>Microbiological</option>
                    <option value="Chemical" {{ old('lab_type') == 'Chemical' ? 'selected' : 'Required' }}>Chemical</option>
                </select>
            </div>

        </div>

        <div id="parameters-container" class="mt-10">
            @php
                $oldParams = old('parameters', [[]]);
            @endphp

            @foreach ($oldParams as $index => $param)
            <div class="parameter-row grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 rounded-md mb-6 relative px-4 py-7 border rounded ease-out duration-300 bg-gray-100 ring1">

                <div class="parameter-label col-span-full font-bold text-blue-600 text-2xl pt-1 pb-3">
                    Parameter {{ $index + 1 }}
                </div>
                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name EN </label>
                    <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"  
                        type="text" name="parameters[{{ $index }}][name_en]" value="{{ $param['name_en'] ?? '' }}"  placeholder="Param Name EN" ><br>
                </div>

                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name KH </label>
                    <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                        type="text" name="parameters[{{ $index }}][name_kh]" value="{{ $param['name_kh'] ?? '' }}" placeholder="Param Name KH" ><br>
                </div>

                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium" for="">Formular</label>
                    <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                        type="text" name="parameters[{{ $index }}][formular]" value="{{ $param['formular'] ?? '' }}" placeholder="Formular"><br>
                </div>

                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria Operator </label>
                    <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                        type="text" name="parameters[{{ $index }}][criteria_operator]" value="{{ $param['criteria_operator'] ?? '' }}" placeholder="Criteria Operator" ><br>
                </div>

                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium" for="">Unit </label>
                    <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                        type="text" name="parameters[{{ $index }}][unit]" value="{{ $param['unit'] ?? '' }}" placeholder="Unit"><br>
                </div>

                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium" for="">LOQ</label>
                    <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                        type="text" name="parameters[{{ $index }}][LOQ]" value="{{ $param['LOQ'] ?? '' }}" placeholder="LOQ"><br>
                </div>

                <!-- Criteria Value 1 with contenteditable + hidden input -->
                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium">Criteria Value 1</label>
                    <div contenteditable="true" id="criteriaValue1_{{ $index }}" class=" form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" spellcheck="false">{!! $param['criteria_value1'] ?? '' !!}</div>
                    <input type="hidden" name="parameters[{{ $index }}][criteria_value1]" id="hiddenCriteriaValue1_{{ $index }}">

                    <div class="flex space-x-2 pt-2">
                        <button type="button" onclick="toggleFormat('criteriaValue1_{{ $index }}', 'sup')" class="button-sup">(x²)</button>
                        <button type="button" onclick="toggleFormat('criteriaValue1_{{ $index }}', 'sub')" class="button-sub">(x₂)</button>
                    </div>
                </div>

                <!-- Criteria Value 2 with contenteditable + hidden input -->
                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium">Criteria Value 2</label>
                    <div contenteditable="true" id="criteriaValue2_{{ $index }}" class=" form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" spellcheck="false">{!! $param['criteria_value2'] ?? '' !!}</div>
                    <input type="hidden" name="parameters[{{ $index }}][criteria_value2]" id="hiddenCriteriaValue2_{{ $index }}">

                    <div class="flex space-x-2 pt-2">
                        <button type="button" onclick="toggleFormat('criteriaValue2_{{ $index }}', 'sup')" class="button-sup">(x²)</button>
                        <button type="button" onclick="toggleFormat('criteriaValue2_{{ $index }}', 'sub')" class="button-sub">(x₂)</button>
                    </div>
                </div>

                <div class="">
                    <label class="text-sm text-gray-700 px-1 font-medium" for="">Method </label>
                    <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                        type="text" name="parameters[{{ $index }}][method]" value="{{ $param['method'] ?? '' }}" placeholder="Method"><br>
                </div>
            </div>
            @endforeach
        </div>

        <div class="py-5 flex gap-3 sm:gap-5 sm:px-4 md:px-10">
            <button type="button" id="remove-parameter" class="max-md:text-xs bg-red-500 hover:bg-red-600 ring-2 ring-red-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Remove Last Parameter</button>
            <button type="button" id="add-parameter" class="max-md:text-xs bg-blue-500 hover:bg-blue-600 ring-2 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Add Parameter</button>
            <button type="submit" class="max-md:text-xs bg-green-500 hover:bg-green-600 ring-2 ring-green-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Create Standard</button>
        </div>
    </div>
</form>

@if ($errors->any())
    <script>
        window.addEventListener('load', () => {
            document.getElementById('errorDialog').classList.remove('hidden');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

    <div id="errorDialog" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
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
function toggleFormat(editableId, tagName) {
    const editableDiv = document.getElementById(editableId);
    const selection = window.getSelection();

    if (!selection.rangeCount) return;
    const range = selection.getRangeAt(0);

    if (!editableDiv.contains(range.commonAncestorContainer)) return;

    if (selection.toString().length === 0) {
        alert('Please select the text to format.');
        return;
    }

    if (isInsideTag(range, editableDiv, tagName)) {
        unwrapTag(getAncestor(range.commonAncestorContainer, tagName));
        return;
    }

    const tag = document.createElement(tagName);
    const content = range.extractContents();
    tag.appendChild(content);
    range.insertNode(tag);

    range.setStartAfter(tag);
    range.collapse(true);

    selection.removeAllRanges();
    selection.addRange(range);
}

function isInsideTag(range, root, tagName) {
    let node = range.commonAncestorContainer;
    while (node && node !== root) {
        if (node.nodeType === 1 && node.tagName.toLowerCase() === tagName) {
            return true;
        }
        node = node.parentNode;
    }
    return false;
}

function getAncestor(node, tagName) {
    while (node && node.tagName?.toLowerCase() !== tagName) {
        node = node.parentNode;
    }
    return node;
}

function unwrapTag(tagNode) {
    const parent = tagNode.parentNode;
    while (tagNode.firstChild) {
        parent.insertBefore(tagNode.firstChild, tagNode);
    }
    parent.removeChild(tagNode);
}

function updateRemoveButtonVisibility() {
    const container = document.getElementById('parameters-container');
    const rows = container.querySelectorAll('.parameter-row');
    const removeBtn = document.getElementById('remove-parameter');
    removeBtn.style.display = rows.length > 1 ? 'inline-block' : 'none';
}

// On page load
updateRemoveButtonVisibility();

let counter = document.querySelectorAll('.parameter-row').length;

document.getElementById('add-parameter').addEventListener('click', function () {
    const container = document.getElementById('parameters-container');
    const newRow = container.firstElementChild.cloneNode(true);

    // Clear inputs and update names and IDs
    newRow.querySelectorAll('input').forEach(input => {
        let name = input.getAttribute('name');
        if (name) {
            let newName = name.replace(/\[\d+\]/, `[${counter}]`);
            input.setAttribute('name', newName);
            input.value = '';
        }
    });

    // Update Criteria Value 1 div
    const criteriaValue1Div = newRow.querySelector(`[id^="criteriaValue1_"]`);
    if (criteriaValue1Div) {
        criteriaValue1Div.id = `criteriaValue1_${counter}`;
        criteriaValue1Div.innerHTML = '';
    }
    // Update Criteria Value 2 div
    const criteriaValue2Div = newRow.querySelector(`[id^="criteriaValue2_"]`);
    if (criteriaValue2Div) {
        criteriaValue2Div.id = `criteriaValue2_${counter}`;
        criteriaValue2Div.innerHTML = '';
    }

    // Update hidden inputs IDs
    const hiddenCriteriaValue1 = newRow.querySelector(`input[name^="parameters"][name$="[criteria_value1]"]`);
    if(hiddenCriteriaValue1) {
        hiddenCriteriaValue1.id = `hiddenCriteriaValue1_${counter}`;
        hiddenCriteriaValue1.value = '';
    }
    const hiddenCriteriaValue2 = newRow.querySelector(`input[name^="parameters"][name$="[criteria_value2]"]`);
    if(hiddenCriteriaValue2) {
        hiddenCriteriaValue2.id = `hiddenCriteriaValue2_${counter}`;
        hiddenCriteriaValue2.value = '';
    }

    // Update parameter label
    const header = newRow.querySelector('.parameter-label');
    if(header) {
        header.textContent = `Parameter ${counter + 1}`;
    }

    container.appendChild(newRow);
    counter++;

    updateRemoveButtonVisibility();
});

document.getElementById('remove-parameter').addEventListener('click', function () {
    const container = document.getElementById('parameters-container');
    const rows = container.querySelectorAll('.parameter-row');
    if (rows.length > 1) {
        rows[rows.length - 1].remove();
        counter--;
        updateRemoveButtonVisibility();
    }
});

// Sync editable content to hidden inputs before submit
document.getElementById('standardForm').addEventListener('submit', function (e) {
    const container = document.getElementById('parameters-container');
    const rows = container.querySelectorAll('.parameter-row');

    rows.forEach((row, idx) => {
        // Criteria Value 1
        const editable1 = row.querySelector(`#criteriaValue1_${idx}`);
        const hiddenInput1 = row.querySelector(`input[name="parameters[${idx}][criteria_value1]"]`);
        if (editable1 && hiddenInput1) {
            hiddenInput1.value = editable1.innerHTML.trim();
        }

        // Criteria Value 2
        const editable2 = row.querySelector(`#criteriaValue2_${idx}`);
        const hiddenInput2 = row.querySelector(`input[name="parameters[${idx}][criteria_value2]"]`);
        if (editable2 && hiddenInput2) {
            hiddenInput2.value = editable2.innerHTML.trim();
        }
    });
});

function closeErrorDialog() {
    document.getElementById('errorDialog').classList.add('hidden');
}
</script>

<style>
.editable-box {
    min-height: 36px;
    padding: 6px 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    outline: none;
    cursor: text;
}

.editable-box:focus {
    border-color: #0ea5e9;
    box-shadow: 0 0 3px #38bdf8;
}

.button-sup, .button-sub {
    background-color: #e0e7ff;
    color: #4338ca;
    border-radius: 6px;
    border: none;
    padding: 4px 10px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button-sup:hover, .button-sub:hover {
    background-color: #c7d2fe;
}
</style>
@endsection
