@extends('includes.app')
@section('content')

<a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
        ← Back home
    </a>
        <h1 class="text-xl text-gray-700 font-bold mb-4">Parameter Page / <span class="text-xl text-gray-700 font-semibold">{{ $standard->code }} {{ $standard->name_kh }}</span></h1>
         @php
            $labTypeLabels = [
                'Microbiological' => 'ស្តង់ដាមីក្រូជីវសាស្ត្រ',
                'Chemical' => 'ស្តង់ដាគីមីសាស្ត្រ',
                'Others' => 'ស្តង់ដារប៉ារ៉ាម៉ែត្រផ្សេទៀត',
                ];
            @endphp

        @php
        function formatChemicalFormula($text) {
            // Convert superscript notation like Cl^(-) or Al^(3+)
            $text = preg_replace_callback('/\^\((.*?)\)/', function ($matches) {
                return '<sup>' . $matches[1] . '</sup>';
            }, $text);

            // Convert numbers that follow letters to subscript (e.g., H2O => H<sub>2</sub>O)
            $text = preg_replace('/([A-Za-z])(\d+)/', '$1<sub>$2</sub>', $text);

            return $text;
        }
        @endphp

        @foreach($groupedStandards as $labType => $standards)
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="card-header mt-10 mb-10 bg-blue-600 text-white py-3 ring-2 ring-blue-400 px-5 rounded-md font-medium pb-3" >{{ $labTypeLabels[$labType] ?? $labType }}</h2>
            {{-- Table --}}
            <div class="table-container overflow-auto">

                <table class="min-w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name En</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criteria Value</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LOQ</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unit</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $hasParameters = false; @endphp
                        @foreach($standards as $standard)
                            @foreach($standard->parameters as $parameter)
                                @php $hasParameters = true; @endphp
                                <tr class="hover:bg-gray-100 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {!! $parameter->name_kh !!} ({!! $parameter->name_en ? formatChemicalFormula($parameter->name_en) : '' !!})
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->method ?? ''}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->criteria_operator }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @php
                                            $criteriaValues = [];
                                            for ($i = 1; $i <= 5; $i++) {
                                                $value = $parameter->{'criteria_value'.$i} ?? null;
                                                if (!empty($value)) {
                                                    $criteriaValues[] = $value;
                                                }
                                            }
                                            echo count($criteriaValues) > 1
                                                ? implode(' - ', $criteriaValues)
                                                : $criteriaValues[0] ?? '';
                                        @endphp
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->LOQ ?? '' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $parameter->unit }}</td>
                                </tr>
                            @endforeach
                        @endforeach

                        @unless($hasParameters)
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-gray-500">No parameters found for this lab type.</td>
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach
            </div>
            <form method="POST" action="{{ route('standard.parameters.download', ['code' => $standard->code]) }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-blue">Download PDF</button>
            </form>
        </div>


@endsection




