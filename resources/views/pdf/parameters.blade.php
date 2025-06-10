<!DOCTYPE html>
<html>
<head>
    <title>Standard Parameters</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Khmer&display=swap" rel="stylesheet">
    <style>

        body {
            font-family: "Khmer", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        table, th, td {
            font-family: "Khmer", sans-serif;
            font-weight: 400;
            font-style: normal;
        }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; }
        th { background: #f0f0f0; }

        
    </style>
    
</head>
<body>
    <h2>Parameters for Standard: {{ $standard->name_en }}</h2>

    <table>
        <thead>
            <tr>
                <th>Name EN</th>
                <th>Name KH</th>
                <th>Formular</th>
                <th>Criteria</th>
                <th>Value 1</th>
                <th>Value 2</th>
                <th>LOQ</th>
                <th>Method</th>
                <th>Unit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parameters as $parameter)
                <tr>
                    <td>{{ $parameter->name_en }}</td>
                    <td>{{ $parameter->name_kh }}</td>
                    <td>{{ $parameter->formular }}</td>
                    <td>{{ $parameter->criteria_operator }}</td>
                    <td class="text-center">{{ $parameter->criteria_value1 }}</td>
                    <td class="text-center">{{ $parameter->criteria_value2 ?? '-' }}</td>
                    <td>{{ $parameter->LOQ }}</td>
                    <td>{{ $parameter->method }}</td>
                    <td>{{ $parameter->unit }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
