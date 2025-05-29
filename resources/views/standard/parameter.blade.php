@extends('includes.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parameter</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
        ← Back home
    </a>
        <h1 class="text-xl text-gray-700 font-bold mb-4">Parameter Page / <span>{{ $standard->name_en }}</span></h1>
        <div class="bg-white rounded-lg shadow-md p-8">
            {{-- Table --}}
            <div class="table-container overflow-auto">
                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name En</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name Kh</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Formular</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value 1</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value 2</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LOQ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($parameters as $parameter)
                            <tr class="hover:bg-gray-100 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->name_en }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->name_kh }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->formular }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->criteria_operator }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->criteria_value1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->criteria_value2 ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->LOQ }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->method }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->unit }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">No parameters found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <form method="POST" action="{{ route('standard.parameters.download', $standard->id) }}" class="mt-12 flex justify-end px-16">
                @csrf
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    ⬇️ Download PDF
                </button>
            </form>
        </div>

</body>
</html>


@endsection




