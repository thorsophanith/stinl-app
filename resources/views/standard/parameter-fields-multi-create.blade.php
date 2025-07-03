<div class="parameter-groups mb-6 p-3 border rounded ease-out duration-300 bg-gray-100 ring1">
    <div class=" mb-2 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" data-index="{{ $loop->index }}">
        <div class="parameter-label col-span-full font-bold text-blue-600 text-lg md:text-xl py-3">Parameter {{ $paramIndex + 1 }}</div>
        <div  >
            <label class="form-label text-sm text-gray-500 px-1 font-medium">Parameter Name (English)<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
            <input class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" 
            type="text" name="standards[{{ $loop->index }}][parameters][0][name_en]" placeholder="Parameter EN" class="form-input w-full" required>
        </div>
        <div>
            <label class="form-label text-sm text-gray-500 px-1 font-medium">Parameter Name (Khmer)<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
            <input class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
             type="text" name="standards[{{ $loop->index }}][parameters][0][name_kh]" placeholder="Parameter KH" class="form-input w-full" required>
        </div>
        <div>
            <label class="form-label text-sm text-gray-500 px-1 font-medium">Formular</label>
            <input class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
             type="text"  name="standards[{{ $loop->index }}][parameters][0][formular]" placeholder="Formular" class="form-input">
        </div>

        <div class="mt-[5px]">
            <label class="form-label text-sm text-gray-500 px-1 font-medium">Criteria Operator<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
            <input
                list="criteria-operators"
                name="standards[{{ $loop->index }}][parameters][0][criteria_operator]"
                placeholder="Operator"
                value="{{ $parameter->criteria_operator ?? old("standards." . $loop->index . ".parameters.0.criteria_operator") }}"
                class="form-input w-full leading-tight focus:outline-none border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block p-3 dark:text-[16px] dark:text-gray-700 dark:placeholder-gray-400 focus:ring-[1px] duration-300 ease-out"
                required
            >
            <datalist id="criteria-operators">
                @foreach(['<', '≤', '<=', '=', '>', '>=', 'Mix', 'Min'] as $operator)
                    <option value="{{ $operator }}">
                @endforeach
            </datalist>
        </div>
        <div class="">

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

                <!-- Editable content area -->
                <div class="content-area form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                     contenteditable="true"
                     data-target-input="criteria_value1_input_{{ $loop->index }}"
                     aria-placeholder="Type your text here..."
                     oninput="syncInput(this)">
                </div>

                <!-- Hidden input for form submission -->
                <input type="hidden"
                       name="standards[{{ $loop->index }}][parameters][0][criteria_value1]"
                       id="criteria_value1_input_{{ $loop->index }}"
                       value="{{ old('standards.' . $loop->index . '.parameters.0.criteria_value1', $parameter->criteria_value1 ?? '') }}">
            </div>
        </div>

          <div class="">

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

                <!-- Editable content area -->
                <div class="content-area form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
                     contenteditable="true"
                     data-target-input="criteria_value2_input_{{ $loop->index }}"
                     aria-placeholder="Type your text here..."
                     oninput="syncInput(this)">
                </div>

                <!-- Hidden input for form submission -->
                <input type="hidden"
                       name="standards[{{ $loop->index }}][parameters][0][criteria_value2]"
                       id="criteria_value2_input_{{ $loop->index }}"
                       value="{{ old('standards.' . $loop->index . '.parameters.0.criteria_value2', $parameter->criteria_value2 ?? '') }}">
            </div>
        </div>
        <div>
            <label class="form-label text-sm text-gray-500 px-1 font-medium">Unit<span class="text-red-600 relative">* <p class="absolute top-0 right-0 animate-ping ease-out">*</p></span></label>
            <input class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
             type="text" name="standards[{{ $loop->index }}][parameters][0][unit]" placeholder="Unit" required>
        </div>
        <div>
            <label class="form-label text-sm text-gray-500 px-1 font-medium">LOQ</label>
            <input class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
             type="text" name="standards[{{ $loop->index }}][parameters][0][LOQ]" placeholder="LOQ">
        </div>
        <div>
            <label class="form-label text-sm text-gray-500 px-1 font-medium">Method</label>
            <input class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"
             type="text" name="standards[{{ $loop->index }}][parameters][0][method]" placeholder="Method">
        </div>
    </div>

    <div class="flex justify-end px-2 pt-2">
        <button type="button" class="remove-parameters btn btn-sm btn-danger remove-parameter max-md:text-xs text-[12px] bg-red-500 hover:bg-red-600 ring-2 ring-red-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Remove</button>
    </div>
</div>




<script>


</script>