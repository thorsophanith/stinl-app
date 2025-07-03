@extends('includes.app')
@section('content')
<form action="{{ route('standard.store') }}" method="POST">
    @csrf
    <a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
        ← Back home
    </a>
    <h1 class="text-xl text-gray-700 font-bold pb-6">Add Standard</h1>
    <div>
        <!-- Standard fields -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        
    
        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">STD
                <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
            </label>
            <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                type="text" name="code" placeholder="***STD" value="{{ old('code') }}" required><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">CS</label>
            <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
            type="text" name="cs" placeholder="CS" value="{{ old('cs') }}" ><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Codex</label>
            <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
            type="text" name="codex" placeholder="Codex" value="{{ old('codex') }}" ><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name EN</label>
            <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
            type="text" name="name_en" placeholder="Standard Name EN" value="{{ old('name_en') }}"><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name KH
                <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
            </label>
            <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
            type="text" name="name_kh" placeholder="Standard Name KH" value="{{ old('name_kh') }}" required><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Select Lab Type
                <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
            </label>
            <select class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" name="lab_type" required>
                <option value="">-- Select Lab Type --</option>
                <option value="Microbiological">Microbiological</option>
                <option value="Chemical">Chemical</option>
                <option value="Others">Others</option>
            </select>
        </div>

    </div>
    <div id="parameters-container" class="mt-10">
        <!-- Template row -->
        @php
            $oldParams = old('parameters', [[]]);
        @endphp

        @foreach ($oldParams as $index => $param)
        <div class="parameter-row grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="parameter-label col-span-full font-bold text-blue-600 text-lg px-10 pt-5">Parameter {{ $index + 1 }}</div>
            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name EN
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"  
                    type="text" name="parameters[{{ $index }}][name_en]" value="{{ $param['name_en'] ?? '' }}"  placeholder="Param Name EN" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name KH
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="text" name="parameters[{{ $index }}][name_kh]" value="{{ $param['name_kh'] ?? '' }}" placeholder="Param Name KH" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Formular</label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="text" name="parameters[{{ $index }}][formular]" value="{{ $param['formular'] ?? '' }}" placeholder="Formular"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria Operator
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="text" name="parameters[{{ $index }}][criteria_operator]" value="{{ $param['criteria_operator'] ?? '' }}" placeholder="Criteria Operator" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria value1
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="float" name="parameters[{{ $index }}][criteria_value1]" value="{{ $param['criteria_value1'] ?? '' }}" placeholder="Criteria value1" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria value2</label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="float" name="parameters[{{ $index }}][criteria_value2]" value="{{ $param['criteria_value2'] ?? '' }}" placeholder="Criteria value2"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Unit
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="text" name="parameters[{{ $index }}][unit]" value="{{ $param['unit'] ?? '' }}" placeholder="Unit" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">LOQ</label>
                <input class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:font-medium dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                    type="text" name="parameters[{{ $index }}][LOQ]" value="{{ $param['LOQ'] ?? '' }}" placeholder="LOQ"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Method 
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
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
</form>
    </div>
    <!-- Error Modal -->
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
    let counter = document.querySelectorAll('.parameter-row').length;

    function updateRemoveButtonVisibility() {
        const container = document.getElementById('parameters-container');
        const rows = container.querySelectorAll('.parameter-row');
        const removeBtn = document.getElementById('remove-parameter');
        removeBtn.style.display = rows.length > 1 ? 'inline-block' : 'none';
    }

    // On page load
    updateRemoveButtonVisibility();

    document.getElementById('add-parameter').addEventListener('click', function () {
        const container = document.getElementById('parameters-container');
        const newRow = container.firstElementChild.cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => {
            const name = input.getAttribute('name');
            const newName = name.replace(/\[\d+\]/, `[${counter}]`);
            input.setAttribute('name', newName);
            input.value = '';
        });

        // Update or insert parameter title
        let header = newRow.querySelector('.parameter-label');
        if (!header) {
            header = document.createElement('div');
            header.className = "parameter-label col-span-full font-semibold text-gray-600 text-lg px-10 pt-5";
            newRow.prepend(header);
        }
        header.textContent = `Parameter ${counter + 1}`;

        container.appendChild(newRow);
        counter++;

        updateRemoveButtonVisibility();
    });

    document.getElementById('remove-parameter').addEventListener('click', function () {
        const container = document.getElementById('parameters-container');
        const rows = container.querySelectorAll('.parameter-row');
        if (rows.length > 1) {
            container.removeChild(rows[rows.length - 1]);
            counter--;
        }
        updateRemoveButtonVisibility();
    });

    function closeErrorDialog() {
        document.getElementById('errorDialog').classList.add('hidden');
    }
</script>


@endsection