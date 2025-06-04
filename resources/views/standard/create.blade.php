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
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="code" placeholder="***STD" required><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">CS</label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="cs" placeholder="CS" ><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Codex</label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="codex" placeholder="Codex" ><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name EN</label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name_en" placeholder="Standard Name EN"><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name KH
                <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
            </label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name_kh" placeholder="Standard Name KH" required><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Select Lab Type
                <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
            </label>
            <select class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" name="lab_type" required>
                <option value="">-- Select Lab Type --</option>
                <option value="Microbiological">Microbiological</option>
                <option value="Chemical">Chemical</option>
                <option value="Others">Others</option>
            </select>
        </div>

    </div>
    <div id="parameters-container" class="mt-10">
        <!-- Template row -->
        <div class="parameter-row grid grid-cols-1 md:grid-cols-2 gap-4">

            <div class="parameter-label col-span-full font-bold text-blue-600 text-lg px-10 pt-5">Parameter 1</div>
            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name EN
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"  type="text" name="parameters[0][name_en]"  placeholder="Param Name EN" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name KH
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][name_kh]" placeholder="Param Name KH" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Formular</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][formular]" placeholder="Formular"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria Operator
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][criteria_operator]" placeholder="Criteria Operator" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria value1
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="float" name="parameters[0][criteria_value1]" placeholder="Criteria value1" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria value2</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="float" name="parameters[0][criteria_value2]" placeholder="Criteria value2"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Unit
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][unit]" placeholder="Unit" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">LOQ</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][LOQ]" placeholder="LOQ"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Method 
                    <span class="bg-blue-300 text-white text-xs px-1 rounded-md italic">Required</span>
                </label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][method]" placeholder="Method"><br>
            </div>
        </div>
    </div>
    <div class="py-5 flex gap-3 sm:gap-5 sm:px-4 md:px-10">
    <button type="button" id="remove-parameter" class="max-md:text-xs bg-red-500 hover:bg-red-600 ring-2 ring-red-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Remove Last Parameter</button>
    <button type="button" id="add-parameter" class="max-md:text-xs bg-blue-500 hover:bg-blue-600 ring-2 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Add Parameter</button>
    <button type="submit" class="max-md:text-xs bg-green-500 hover:bg-green-600 ring-2 ring-green-300 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Create Standard</button>
    </div>
</form>
    </div>

@endsection