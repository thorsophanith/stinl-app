    <div class="parameter-group mb-8 mt-10 p-3 rounded ease-out duration-300 bg-gray-100 ring1">
        <div class="mb-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"  >
            <!-- Parameter Header -->
            <div class="parameter-label col-span-full font-bold text-blue-600 text-lg md:text-xl py-3">{{ is_numeric($index) ? 'Parameter ' . ($index + 1) : 'Parameter New' }}</div>
            <!-- Name (English) -->
            <div class="pt-4">
                <label class="form-label text-sm text-gray-500 px-1 font-medium">Parameter Name (English)<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
                <input type="text"
                       class="form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                       name="standards[{{ $labType }}][parameters][{{ $index }}][name_en]"
                       value="{{ old("standards.$labType.parameters.$index.name_en", $parameter->name_en ?? '') }}" 
                       required>
            </div>
    
            <!-- Name (Khmer) -->
            <div class="pt-4">
                <label class="form-label text-sm text-gray-500 px-1 font-medium">Parameter Name (Khmer)<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
                <input type="text"
                       class="form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                       name="standards[{{ $labType }}][parameters][{{ $index }}][name_kh]"
                       value="{{ old("standards.$labType.parameters.$index.name_kh", $parameter->name_kh ?? '') }}" 
                       required>
            </div>
    
            <!-- Formular -->
            <div class="pt-4">
                <label class="form-label text-sm text-gray-500 px-1 font-medium">Formular</label>
                <input type="text" 
                       class="form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                       name="standards[{{ $labType }}][parameters][{{ $index }}][formular]"
                       value="{{ old("standards.$labType.parameters.$index.formular", $parameter->formular ?? '') }}">
            </div>
    
            <!-- Criteria Operator -->
            <div>
                <label class="form-label text-sm text-gray-500 px-1 font-medium">Criteria Operator<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
                <input list="criteria-operators"
                       name="standards[{{ $labType }}][parameters][{{ $index }}][criteria_operator]"
                       placeholder="Operator"
                       value="{{ old("standards.$labType.parameters.$index.criteria_operator", $parameter->criteria_operator ?? '') }}"
                       class="form-input w-full leading-tight focus:outline-none border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 focus:ring-[1px] duration-300 ease-out"
                       required>
                <datalist id="criteria-operators">
                    @foreach(['<','≤', '<=', '=', '>', '>=', 'Mix', 'Min'] as $operator)
                        <option value="{{ $operator }}">
                    @endforeach
                </datalist>
            </div>
    
            <!-- Criteria Value 1 (Rich Text Editor) -->
            <div class="rich-text-editor">
                <div class="flex gap-10 items-center mb-1">
                    <label class="form-label text-sm text-gray-500 font-medium">Criteria Value 1</label>
                    <div class="toolbar flex gap-2 text-xs">
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="bold"><b>B</b></button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="italic"><i>I</i></button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="underline"><u>U</u></button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="subscript">x₂</button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="superscript">x²</button>
                        <button type="button" class="bg-red-200 px-3 py-0.5 border rounded text-red-700 hover:bg-red-300" data-command="removeFormat">Clear</button>
                    </div>
                </div>
                
                <div class="content-area form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                     contenteditable="true"
                     data-target-input="criteria_value1_input_{{ $labType }}_{{ $index }}"
                     aria-placeholder="Type your text here..."
                     oninput="syncInput(this)">
                     {!! old("standards.$labType.parameters.$index.criteria_value1", $parameter->criteria_value1 ?? '') !!}
                </div>
                
                <input type="hidden"
                       name="standards[{{ $labType }}][parameters][{{ $index }}][criteria_value1]"
                       id="criteria_value1_input_{{ $labType }}_{{ $index }}"
                       value="{{ old("standards.$labType.parameters.$index.criteria_value1", $parameter->criteria_value1 ?? '') }}">
            </div>

            <!-- Criteria Value 2 (Rich Text Editor) -->
            <div class="rich-text-editor">
                <div class="flex gap-10 items-center mb-1">
                    <label class="form-label text-sm text-gray-500 font-medium">Criteria Value 2</label>
                    <div class="toolbar flex gap-2 text-xs">
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="bold"><b>B</b></button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="italic"><i>I</i></button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="underline"><u>U</u></button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="subscript">x₂</button>
                        <button type="button" class="bg-gray-100 px-2 py-0.5 border rounded hover:bg-gray-200" data-command="superscript">x²</button>
                        <button type="button" class="bg-red-200 px-3 py-0.5 border rounded text-red-700 hover:bg-red-300" data-command="removeFormat">Clear</button>
                    </div>
                </div>
                
                <div class="content-area form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                     contenteditable="true"
                     data-target-input="criteria_value2_input_{{ $labType }}_{{ $index }}"
                     aria-placeholder="Type your text here..."
                     oninput="syncInput(this)">
                     {!! old("standards.$labType.parameters.$index.criteria_value2", $parameter->criteria_value2 ?? '') !!}
                </div>
                
                <input type="hidden"
                       name="standards[{{ $labType }}][parameters][{{ $index }}][criteria_value2]"
                       id="criteria_value2_input_{{ $labType }}_{{ $index }}"
                       value="{{ old("standards.$labType.parameters.$index.criteria_value2", $parameter->criteria_value2 ?? '') }}">
            </div>
    
            <!-- Unit -->
            <div>
                <label class="form-label text-sm text-gray-500 px-1 font-medium">Unit<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
                <input type="text" 
                       class="form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                       name="standards[{{ $labType }}][parameters][{{ $index }}][unit]"
                       value="{{ old("standards.$labType.parameters.$index.unit", $parameter->unit ?? '') }}"
                       required>
            </div>
    
            <!-- LOQ -->
            <div>
                <label class="form-label text-sm text-gray-500 px-1 font-medium">LOQ</label>
                <input type="text" 
                       class="form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                       name="standards[{{ $labType }}][parameters][{{ $index }}][LOQ]" 
                       value="{{ old("standards.$labType.parameters.$index.LOQ", $parameter->LOQ ?? '') }}">
            </div>
    
            <!-- Method -->
            <div>
                <label class="form-label text-sm text-gray-500 px-1 font-medium">Method</label>
                <input type="text" 
                       class="form-control leading-tight focus:outline-none bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
                       name="standards[{{ $labType }}][parameters][{{ $index }}][method]" 
                       value="{{ old("standards.$labType.parameters.$index.method", $parameter->method ?? '') }}">
            </div>
        </div>
    
        <!-- Remove Button -->
        <div class="flex justify-end px-2 pt-2">
            <button type="button" class="remove-parameters btn btn-sm btn-danger remove-parameter max-md:text-xs text-[12px] bg-red-500 hover:bg-red-600 ring-2 ring-red-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Remove</button>
        </div>
    </div>



    