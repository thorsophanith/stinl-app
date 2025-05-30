<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination Table</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

            <h1 class="text-3xl font-bold mb-4">Standard Page</h1>
        

        <div class="bg-white rounded-lg shadow-md p-8">
            {{-- Search + per_page --}}
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

            {{-- Table --}}
            <div class="table-container overflow-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Codex</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name En</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name Kh</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($standards as $standard)
                            <tr onclick="window.location='{{ route('standard.show', $standard->id) }}'" class="cursor-pointer hover:bg-gray-100 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->codex }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->name_en }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $standard->name_kh }}</td>
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
    
        <a href="{{ route('standard.create') }}" class="text-blue-600 hover:underline mb-4 inline-block">
            Create New Standard
        </a>
</body>
</html>


