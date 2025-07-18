<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Parameter Prices PDF</title>
    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        h3 {
            margin-top: 30px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h2>Parameter Price List Grouped by Lab Type</h2>

    @foreach ($groupedPrices as $labType => $group)
        <h3>{{ $labType }}</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Code</th>
                    <th>Parameter</th>
                    <th>Test Duration (days)</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $index => $price)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $price->code }}</td>
                        <td>{{ $price->parameter->name_en ?? '—' }}</td>
                        <td>{{ $price->test_duration }}</td>
                        <td>{{ number_format($price->price, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>

</html>