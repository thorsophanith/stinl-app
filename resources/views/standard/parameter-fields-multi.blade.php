<div class="parameter-group mb-6 p-3 border rounded ease-out duration-300 bg-gray-100 ring1">
    <div class="row mb-2 space-y-[8px] grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Parameter Name (English)*</label>
            <input type="text" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                   name="standards[{{ $labType }}][parameters][{{ $index }}][name_en]"
                   value="{{ $parameter->name_en ?? old("standards.$labType.parameters.$index.name_en") }}" required>
        </div>
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Parameter Name (Khmer)*</label>
            <input type="text" class="form-control leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                   name="standards[{{ $labType }}][parameters][{{ $index }}][name_kh]"
                   value="{{ $parameter->name_kh ?? old("standards.$labType.parameters.$index.name_kh") }}" required>
        </div>

        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Formular</label>
            <input type="text" class="form-control leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                   name="standards[{{ $labType }}][parameters][{{ $index }}][formular]"
                   value="{{ $parameter->formular ?? old("standards.$labType.parameters.$index.formular") }}">
        </div>
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Unit*</label>
            <input type="text" class="form-control leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                   name="standards[{{ $labType }}][parameters][{{ $index }}][unit]"
                   value="{{ $parameter->unit ?? old("standards.$labType.parameters.$index.unit") }}" required>
        </div>
 

    
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Criteria Operator*</label>
            <select class="form-select leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                   name="standards[{{ $labType }}][parameters][{{ $index }}][criteria_operator]" required>
                @foreach(['<', '<=', '=', '>', '>=', 'between', 'not detected'] as $operator)
                    <option value="{{ $operator }}"
                        {{ ($parameter->criteria_operator ?? old("standards.$labType.parameters.$index.criteria_operator")) == $operator ? 'selected' : '' }}>
                        {{ $operator }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Criteria Value 1*</label>
            <input type="number" step="any" class="form-control leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                   name="standards[{{ $labType }}][parameters][{{ $index }}][criteria_value1]"
                   value="{{ $parameter->criteria_value1 ?? old("standards.$labType.parameters.$index.criteria_value1") }}" required>
        </div>
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Criteria Value 2 (if between)</label>
            <input type="number" step="any" class="form-control leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                   name="standards[{{ $labType }}][parameters][{{ $index }}][criteria_value2]"
                   value="{{ $parameter->criteria_value2 ?? old("standards.$labType.parameters.$index.criteria_value2") }}">
        </div>
  
    
    
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">LOQ</label>
            <input type="text" class="form-control leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                   name="standards[{{ $labType }}][parameters][{{ $index }}][LOQ]" 
                   value="{{ $parameter->LOQ ?? old("standards.$labType.parameters.$index.LOQ") }}">
        </div>
        <div class="">
            <label class="form-label form-label text-sm text-gray-500 px-1 font-medium">Method</label>
            <input type="text" class="form-control leading-tight focus:outline-none form-control border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                   name="standards[{{ $labType }}][parameters][{{ $index }}][method]" 
                   value="{{ $parameter->method ?? old("standards.$labType.parameters.$index.method") }}">
        </div>
    </div>

    <div class="flex justify-end px-2 pt-2">
        <button type="button" class="btn btn-sm btn-danger remove-parameter max-md:text-xs bg-red-500 hover:bg-red-600 ring-2 ring-red-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Remove</button>
    </div>
</div>
