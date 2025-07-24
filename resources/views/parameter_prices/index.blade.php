@extends('includes.app')

@section('content')

    <style>
        /* Tailwind-like animations in raw CSS */

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideDown {
            0% {
                opacity: 0;
                transform: translateY(-8px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
        }

        .animate-slide-down {
            animation: slideDown 0.4s ease-out forwards;
        }
    </style>


    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded animate-fade-in">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex items-center justify-between px-3 animate-slide-down">
        <h1 class="text-xl md:text-2xl font-bold mb-4">Parameter Price List</h1>
        <div class="flex gap-3">
            <a href="{{ route('parameter-prices.create') }}"
                class="px-4 py-1.5 bg-blue-500 hover:bg-blue-600 ease-in text-white rounded-md duration-300 ring-2 mb-1 text-xs md:text-sm font-medium transform hover:scale-105 transition">Add
                Price List</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-8 animate-fade-in-up">
        <form method="GET" action="{{ route('parameter-prices.index') }}"
            class="flex flex-col sm:flex-row items-center justify-between mb-4 gap-4">
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}"
                class="w-full sm:w-auto border px-3 py-2 rounded-md shadow-sm focus:ring-blue-300 focus:outline-blue-500 transition duration-200">
            <div class="flex items-center gap-2">
                <label for="page-size" class="text-gray-700 font-medium">Items per page:</label>
                <select id="page-size" name="per_page"
                    class="border rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    onchange="this.form.submit()">
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
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Code</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Parameter
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Test
                            Duration</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Lab Type
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Price
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($prices as $price)
                        <tr class="hover:bg-blue-50 transition ease-out duration-300">
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900">{{ $price->code }}</td>
                            <td class="w-[300px] px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $price->parameter?->name_en ?? $price->parameter }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $price->test_duration ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $price->lab_type ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">៛{{ number_format($price->price) }}
                            </td>
                            <td class="py-2 text-gray-700 flex gap-2 justify-center items-center text-xs lg:w-[90px]">
                                <a href="{{ route('parameter-prices.edit', $price->id) }}"
                                    class="px-4 py-1 bg-blue-500 hover:bg-blue-600 ease-in text-white rounded-md duration-300 ring-2 mb-1 font-medium transform hover:scale-105">Edit</a>
                                <form action="{{ route('parameter-prices.destroy', $price->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete all standards with code {{ $price->id }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="showDeleteDialog(this.form)"
                                        class="px-4 py-1 bg-red-500 hover:bg-red-600 ease-in text-white rounded-md duration-300 ring-2 ring-red-300 mb-1 font-medium transform hover:scale-105">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-6">No parameter prices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 animate-fade-in">
            {{ $prices->appends(request()->query())->links() }}
        </div>
        <a href="{{ route('parameter-prices.download') }}" class="btn btn-primary px-4 py-1.5 bg-blue-500 hover:bg-blue-600 ease-in text-white rounded-md duration-300 ring-2 mb-1 text-xs md:text-sm font-medium">
            <i class="fas fa-download"></i> Download PDF
            </a>
    </div>

    <div id="deleteDialog"
        class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 opacity-0 pointer-events-none transition-opacity duration-300">
        <div id="deleteBox"
            class="bg-white p-6 rounded-2xl shadow-2xl w-11/12 max-w-md text-gray-800 scale-95 opacity-0 transition-all duration-300">
            <h2 class="text-lg font-semibold mb-2">🗑️ Confirm Deletion</h2>
            <p class="text-sm text-red-600 mb-4">Are you sure you want to delete this item? This action cannot be undone.
            </p>
            <div class="flex justify-end gap-3">
                <button onclick="cancelDelete()"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-200">Cancel</button>
                <button onclick="confirmDelete()"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">Yes,
                    Delete</button>
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
        <div id="errorDialog"
            class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 animate-fade-in">
            <div class="bg-white p-6 rounded-lg shadow-xl w-11/12 max-w-md text-gray-800 relative">
                <h2 class="text-lg font-semibold mb-2">⚠️ Submission Alert</h2>
                <ul class="list-disc list-inside text-sm text-red-600 mb-4 max-h-48 overflow-y-auto pr-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <div class="flex justify-end gap-3">
                    <button onclick="closeErrorDialog()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Stay and
                        Edit</button>
                    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Leave</a>
                </div>
            </div>
        </div>
    @endif
@endsection