<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Standards Parameters - {{ $standards->first()->code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        
        .header h2 {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #666;
        }
        
        .standard-info {
            background: #f5f5f5;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .standard-info h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #333;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        
        .info-item {
            display: flex;
        }
        
        .info-label {
            font-weight: bold;
            min-width: 80px;
            color: #555;
        }
        
        .info-value {
            color: #333;
        }
        
        .lab-section {
            margin-bottom: 30px;
            page-break-inside: avoid;
        }
        
        .lab-header {
            background: #4A90E2;
            color: white;
            padding: 10px 15px;
            font-weight: bold;
            font-size: 14px;
            border-radius: 5px 5px 0 0;
        }
        
        .parameters-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
            border: 1px solid #ddd;
        }
        
        .parameters-table thead {
            background: #f8f9fa;
        }
        
        .parameters-table th {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-weight: bold;
            text-align: left;
            font-size: 11px;
            color: #555;
        }
        
        .parameters-table td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
            vertical-align: top;
            word-wrap: break-word;
            white-space: normal;
        }
        
        .parameters-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        .parameters-table tr:hover {
            background: #f0f8ff;
        }
        
        .no-parameters {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        /* Chemical formula formatting */
        sup {
            font-size: 0.8em;
            vertical-align: super;
        }
        
        sub {
            font-size: 0.8em;
            vertical-align: sub;
        }
        
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Standards Parameters Report</h1>
        <h2>Code: {{ $standards->first()->code }}</h2>
    </div>

    @php
        $firstStandard = $standards->first();
        $labTypeLabels = [
            'Microbiological' => 'Microbiological',
            'Chemical' => 'Chemical',
        ];
        
        if (!function_exists('formatChemicalFormula')) {
            function formatChemicalFormula($text) {
                if (empty($text)) return '';
                
                // Convert superscript notation like Cl^(-) or Al^(3+)
                $text = preg_replace_callback('/\^\((.*?)\)/', function ($matches) {
                    return '<sup>' . $matches[1] . '</sup>';
                }, $text);

                // Convert numbers that follow letters to subscript (e.g., H2O => H<sub>2</sub>O)
                $text = preg_replace('/([A-Za-z])(\d+)/', '$1<sub>$2</sub>', $text);

                return $text;
            }
        }
    @endphp

    <div class="standard-info">
        <h3>Standard Information</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Code:</span>
                <span class="info-value">{{ $firstStandard->code }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">CS:</span>
                <span class="info-value">{{ $firstStandard->cs ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Codex:</span>
                <span class="info-value">{{ $firstStandard->codex ?? 'N/A' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Name (EN):</span>
                <span class="info-value">{{ $firstStandard->name_en ?? 'N/A' }}</span>
            </div>
        </div>
        <!-- <div style="margin-top: 10px;">
            <div class="info-item">
                <span class="info-label">Name (KH):</span>
                <span class="info-value">{{ $firstStandard->name_kh ?? 'N/A' }}</span>
            </div> -->
        </div>
    </div>

    @php
        $groupedStandards = $standards->groupBy('lab_type');
        $pageBreakNeeded = false;
    @endphp

    @foreach($groupedStandards as $labType => $standardsGroup)
        @if($pageBreakNeeded)
            <div class="page-break"></div>
        @endif
        
        <div class="lab-section">
            <div class="lab-header">
                {{ $labTypeLabels[$labType] ?? $labType }}
            </div>
            
            <table class="parameters-table">
                <thead>
                    <tr>
                        <th style="width: 25%;">Parameter Name</th>
                        <th style="width: 20%;">Method</th>
                        <th style="width: 10%;">Criteria</th>
                        <th style="width: 15%;">Criteria Value</th>
                        <th style="width: 15%;">LOQ</th>
                        <th style="width: 15%;">Unit</th>
                    </tr>
                </thead>
                <tbody>
                    @php $hasParameters = false; @endphp
                    @foreach($standardsGroup as $standard)
                        @if($standard->parameters && $standard->parameters->count() > 0)
                            @foreach($standard->parameters as $parameter)
                                @php $hasParameters = true; @endphp
                                <tr>
                                    <td>
                                        <strong>{{ $parameter->name_en }}</strong>
                                    </td>
                                    <td>{{ $parameter->method ?? '' }}</td>
                                    <td>{{ $parameter->criteria_operator ?? '' }}</td>
                                    <td>
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
                                                : ($criteriaValues[0] ?? '');
                                        @endphp
                                    </td>
                                    <td>{{ $parameter->LOQ ?? '' }}</td>
                                    <td>{{ $parameter->unit ?? '' }}</td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach

                    @unless($hasParameters)
                        <tr>
                            <td colspan="7" class="no-parameters">
                                No parameters found for this lab type.
                            </td>
                        </tr>
                    @endunless
                </tbody>
            </table>
        </div>
        
        @php $pageBreakNeeded = true; @endphp
    @endforeach

    <div class="footer">
        <p>Generated on {{ now()->format('Y-m-d H:i:s') }}</p>
        <p>Standards Parameters Report - {{ $standards->first()->code }}</p>
    </div>
</body>
</html>