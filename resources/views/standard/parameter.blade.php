@extends('includes.app')
@section('content')
 
<a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
        ← Back home
    </a>
        <h1 class="text-xl text-gray-700 font-bold mb-4">Parameter Page / <span>{{ $standard->name_en }}</span></h1>
         @php
            $labTypeLabels = [
                'Microbiological' => 'ស្តង់ដាមីក្រូជីវសាស្ត្រ',
                'Chemical' => 'ស្តង់ដាគីមីសាស្ត្រ',
                'Others' => 'ស្តង់ដារប៉ារ៉ាម៉ែត្រផ្សេទៀត',
                ];
            @endphp
        @foreach($groupedStandards as $labType => $standards)
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-xl font-sans font-medium mb-4" >{{ $labTypeLabels[$labType] ?? $labType }}</h2>
            {{-- Table --}}
            <div class="table-container overflow-auto">

                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Name En</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Formular</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Criteria</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Criteria Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">LOQ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Unit</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $hasParameters = false; @endphp
                        @foreach($standards as $standard)
                            @foreach($standard->parameters as $parameter)
                                @php $hasParameters = true; @endphp
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $parameter->name_kh }} ({{ $parameter->name_en }})</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $parameter->formular }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $parameter->method }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $parameter->criteria_operator }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $parameter->criteria_value2 ? $parameter->criteria_value1 . '-' . $parameter->criteria_value2 : $parameter->criteria_value1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $parameter->LOQ }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $parameter->unit }}</td>
                                </tr>
                            @endforeach
                        @endforeach

                        @unless($hasParameters)
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No parameters found for this lab type.</td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
            </div>
            <form method="POST" action="{{ route('standard.parameters.download', $standard->id) }}" class="mt-12 flex justify-end px-16">
                @csrf
                <button type="submit"
                    class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    ⬇️ Download PDF
                </button>
            </form>
        </div>


@endsection




