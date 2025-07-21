<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Parameter Prices Report</title>
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

        .prices-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 0;
            border: 1px solid #ddd;
        }

        .prices-table thead {
            background: #f8f9fa;
        }

        .prices-table th {
            padding: 10px 8px;
            border: 1px solid #ddd;
            font-weight: bold;
            text-align: left;
            font-size: 11px;
            color: #555;
        }

        .prices-table td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
            vertical-align: top;
            word-wrap: break-word;
        }

        .prices-table tr:nth-child(even) {
            background: #f9f9f9;
        }

        .prices-table tr:hover {
            background: #f0f8ff;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        .price-cell {
            text-align: right;
            font-weight: bold;
            color: #2c5aa0;
        }

        .duration-cell {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .currency {
            font-size: 10px;
            color: #666;
        }

        /* Add this new style for Khmer text */
        .khmer-text {
            font-family: 'noto', 'mixed', sans-serif;
            line-height: 1.8;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Parameter Prices Report</h1>
        <h2>Laboratory Testing Services</h2>
    </div>

    @php
    $labTypes = [
        'Microbiological Test for Water and Ice',
        'Microbiological Test for food and Beverage',
        'Physic-Chemical Test'
    ];

    $groupedPrices = $parameterPrices->groupBy('lab_type');

    function convertKhmerDurationToEnglish($khmerDuration) {
        $khmerToEnglishDigits = [
            '០' => '0', '១' => '1', '២' => '2', '៣' => '3', '៤' => '4',
            '៥' => '5', '៦' => '6', '៧' => '7', '៨' => '8', '៩' => '9',
        ];

        // Replace Khmer digits
        $english = strtr($khmerDuration, $khmerToEnglishDigits);

        // Replace Khmer word for "day" with English
        $english = str_replace(['ថ្ងៃ', 'ថ្ងៃៗ'], ' days', $english);

        return trim($english);
    }
@endphp


    @foreach($labTypes as $index => $labType)
        @if($index > 0)
            <div class="page-break"></div>
        @endif
        
        <div class="lab-section">
            <div class="lab-header">
                {{ $labType }}
            </div>

            <table class="prices-table">
                <thead>
                    <tr>
                        <th style="width: 15%;">Code</th>
                        <th style="width: 45%;">Parameter</th>
                        <th style="width: 20%;">Test Duration</th>
                        <th style="width: 20%;">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php $hasData = false; @endphp
                    @if($groupedPrices->has($labType))
                        @foreach($groupedPrices[$labType] as $price)
                            @php $hasData = true; @endphp
                            <tr>
                                <td><strong>{{ $price->code ?? 'N/A' }}</strong></td>
                                <td>
    {{ $price->name_en ?? 'N/A' }}
</td>


                                <td class="duration-cell">
    @if($price->test_duration)
        @if(preg_match('/[\x{1780}-\x{17FF}]/u', $price->test_duration))
            {{ convertKhmerDurationToEnglish($price->test_duration) }}
        @else
            {{ $price->test_duration }}
        @endif
    @else
        N/A
    @endif
</td>
                                <td class="price-cell">
                                    @if($price->price)
                                        {{ number_format($price->price, 2) }}
                                        <span class="currency">KMR</span> 
                                    @else
                                        N/A
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    @unless($hasData)
                        <tr>
                            <td colspan="4" class="no-data">
                                No pricing data available for this lab type.
                            </td>
                        </tr>
                    @endunless
                </tbody>
            </table>
        </div>
    @endforeach

    <div class="footer">
        <p>Generated on {{ now()->format('Y-m-d H:i:s') }}</p>
        <p>Parameter Prices Report - Laboratory Testing Services</p>
    </div>
</body>
</html>