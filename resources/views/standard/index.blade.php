@extends('includes.app')
@section('content')


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


@if (session('removed'))
    <div class="alert alert-warning mb-4 px-4 py-3 text-yellow-800 bg-yellow-100 border border-yellow-300 rounded-md">
        {{ session('removed') }}
    </div>
@endif

@if (session('success'))
@endif


    <div class="flex items-center justify-between px-3">
        <h1 class="text-xl md:text-2xl font-bold mb-4">Standard Page</h1>
        <a href="{{ route('standard.create') }}" class="px-4 py-1.5 bg-blue-500 hover:bg-blue-600 ease-in text-white rounded-md duration-300 ring-2 mb-1 text-xs md:text-sm font-medium">Add New Standard</a>
    </div>
        <div class="bg-white rounded-lg shadow-md p-8">

            <form method="GET" action="{{ route('standard.index') }}" class="flex flex-col sm:flex-row items-center justify-between mb-4 gap-4">
                <input
                    type="text"
                    name="search"
                    placeholder="Search..."
                    value="{{ request('search') }}"
                    class="w-full sm:w-auto border px-3 py-2 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                <div class="flex items-center gap-2">
                    <label for="page-size" class="text-gray-700 font-medium">Items per page:</label>
                    <select id="page-size" name="per_page" class="border rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
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
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">CS</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Codex</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name En</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name Kh</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($standards as $standard)
                            <tr class="cursor-pointer hover:bg-blue-50 ease-out duration-300 transition">
                                <td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->code ?? '--' }}</td>
                                <td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->cs ?? '--' }}</td>
                                <td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->codex ?? '--' }}</td>
                                <td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->name_en ?? '--' }}</td>
                                <td onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->name_kh }}</td>

                                <td class="py-2 text-gray-700 flex gap-2 justify-center items-center text-sm lg:w-[90px]">
                                    <a href="{{ route('standard.edit', $standard->id) }}" class="max-md:text-xs bg-blue-500 px-2.5 md:px-3 py-[6px]  rounded-lg text-white font-medium hover:bg-blue-600 duration-300 ease-out ">Edit</a>
                                    <a class="max-md:text-xs bg-red-500 px-2.5 md:px-3 py-[7px] rounded-lg text-white font-medium hover:bg-red-600 duration-300 ease-out ">
                                        <form action="{{ route('standard.destroy', $standard->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
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

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $standards->appends(request()->query())->links() }}
            </div>
        </div>


@endsection