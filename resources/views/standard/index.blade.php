@extends('includes.app')
@section('title', 'Standard Page')
@section('content')

<link rel="stylesheet" href="/css/animations.css">

<style>
    .rich-text-editor {
        border: 1px solid #ccc;
        width: 600px;
        min-height: 200px;
        font-family: Arial, sans-serif;
        display: flex;
        flex-direction: column;
        margin: 20px;
    }

    .toolbar {
        background-color: #f0f0f0;
        padding: 5px;
        border-bottom: 1px solid #ccc;
        display: flex;
        gap: 5px;
    }

    .toolbar button {
        background-color: #e0e0e0;
        border: 1px solid #bbb;
        padding: 5px 10px;
        cursor: pointer;
        font-weight: bold;
        font-style: normal;
        text-decoration: none;
        border-radius: 3px;
    }

    .toolbar button:hover {
        background-color: #d0d0d0;
    }

    .toolbar button[data-command="subscript"] {
        font-size: 0.8em;
        vertical-align: sub;
    }

    .toolbar button[data-command="superscript"] {
        font-size: 0.8em;
        vertical-align: super;
    }

    .content-area {
        padding: 10px;
        flex-grow: 1;
        outline: none;
        background-color: #fff;
        line-height: 1.5;
    }
</style>

@if (session('success'))
    <div class="mb-4 px-4 py-3 text-green-800 bg-green-100 border border-green-300 rounded-md animate-fade-in">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 px-4 py-3 text-red-800 bg-red-100 border border-red-300 rounded-md animate-fade-in">
        {{ session('error') }}
    </div>
@endif

<div class="flex items-center justify-between px-3 animate-slide-down">
    <h1 class="text-xl md:text-2xl font-bold mb-4">Standard Page</h1>
    <div class="flex gap-3">
        <a href="{{ route('standard.createOne') }}" class="px-4 py-1.5 bg-green-500 hover:bg-green-600 ease-in text-white rounded-md duration-300 ring-2 mb-1 text-xs md:text-sm font-medium">Add One Standard</a>
        <a href="{{ route('standard.create') }}" class="px-4 py-1.5 bg-blue-500 hover:bg-blue-600 ease-in text-white rounded-md duration-300 ring-2 mb-1 text-xs md:text-sm font-medium">Add New Standards</a>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-8 animate-fade-in-up">
    <form method="GET" action="{{ route('standard.index') }}" class="flex flex-col sm:flex-row items-center justify-between mb-4 gap-4">
        <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" class="w-full sm:w-auto border px-3 py-2 rounded-md shadow-sm focus:ring-blue-300 focus:outline-blue-500">
        <div class="flex items-center gap-2">
            <label for="page-size" class="text-gray-700 font-medium">Items per page:</label>
            <select id="page-size" name="per_page" class="border-b rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
            </select>
        </div>
    </form>

    <div class="table-container overflow-auto">
        <table class="min-w-full">
            <thead class="bg-gray-100 rounded-md">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">STD</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">CS</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Codex</th>
                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($standards as $standard)
                    <tr class="cursor-pointer hover:bg-blue-50 ease-out duration-300 transition animate-fade-in">
                        <td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ empty($standard->code) || $standard->code === 'null' ? '-' : $standard->code }}
</td>

<td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="w-[300px] px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ empty($standard->name_kh) || $standard->name_kh === 'null' ? '-' : $standard->name_kh }}
    ({{ empty($standard->name_en) || $standard->name_en === 'null' ? '--' : $standard->name_en }})
</td>

<td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ empty($standard->cs) || $standard->cs === 'null' ? '-' : $standard->cs }}
</td>

<td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
    {{ empty($standard->codex) || $standard->codex === 'null' ? '-' : $standard->codex }}
</td>

                        <td class="py-2 text-gray-700 flex gap-2 justify-center items-center text-sm lg:w-[90px]">
                            <a href="{{ route('standard.edit', $standard->id) }}" class="px-4 py-1 bg-blue-500 hover:bg-blue-600 ease-in text-white rounded-md duration-300 ring-2 mb-1 font-medium">Edit</a>
                            <a class="px-4 py-1 bg-red-500 hover:bg-red-600 ease-in text-white rounded-md duration-300 ring-2 ring-red-300 mb-1 font-medium">
                                <form action="{{ route('standard.destroyByCode', $standard->code) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete all standards with code {{ $standard->code }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="showDeleteDialog(this.form)" class="btn btn-danger">Delete</button>
                                </form>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No data found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-8">
        {{ $standards->appends(request()->query())->links() }}
    </div>
</div>

<div id="deleteDialog" class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
    <div id="deleteBox" class="bg-white p-6 rounded-2xl shadow-2xl w-11/12 max-w-md text-gray-800 scale-95 opacity-0 transition-all duration-300">
        <h2 class="text-lg font-semibold mb-2">🗑️ Confirm Deletion</h2>
        <p class="text-sm text-red-600 mb-4">Are you sure you want to delete this item? This action cannot be undone.</p>
        <div class="flex justify-end gap-3">
            <button onclick="cancelDelete()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200">Cancel</button>
            <button onclick="confirmDelete()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">Yes, Delete</button>
        </div>
    </div>
</div>

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
@endsection
