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
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Code</label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="code" placeholder="Code" required><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Codex</label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="codex" placeholder="Codex" required><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name EN</label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name_en" placeholder="Standard Name EN" required><br>
        </div>

        <div class="space-y-2 lg:px-10">
            <label class="text-sm text-gray-700 px-1 font-medium" for="">Standard Name KH</label>
            <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="name_kh" placeholder="Standard Name KH" required><br>
        </div>
    </div>
    <div id="parameters-container">
        <!-- Template row -->
        <div class="parameter-row grid grid-cols-1 md:grid-cols-2 gap-4">


            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name EN</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500"  type="text" name="parameters[0][name_en]"  placeholder="Param Name EN" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Param Name KH</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][name_kh]" placeholder="Param Name KH" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Formular</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][formular]" placeholder="Formular"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria Operator</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][criteria_operator]" placeholder="Criteria Operator" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria value1</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="parameters[0][criteria_value1]" placeholder="Criteria value1" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Criteria value2</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="number" name="parameters[0][criteria_value2]" placeholder="Criteria value2"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Unit</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][unit]" placeholder="Unit" required><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">LOQ</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][LOQ]" placeholder="LOQ"><br>
            </div>

            <div class="space-y-2 lg:px-10">
                <label class="text-sm text-gray-700 px-1 font-medium" for="">Method</label>
                <input class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:placeholder-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="parameters[0][method]" placeholder="Method"><br>
            </div>
        </div>
    </div>
    <div class="py-5 flex gap-3 sm:gap-5 sm:px-4 md:px-10">
    <button type="button" id="add-parameter" class="max-md:text-xs bg-blue-500 hover:bg-blue-600 ring-2 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Add Parameter</button>
    <button type="submit" class="max-md:text-xs bg-blue-500 hover:bg-blue-600 ring-2 ease-in px-4 py-1.5 text-white duration-300 font-medium rounded-md">Create Standard</button>
    </div>
</form>
    </div>

@endsection