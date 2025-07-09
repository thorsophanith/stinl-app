{{-- <!DOCTYPE html>
<html>
<head>
    <title>Standard Parameters</title>
    <style>

        @font-face {
        font-family: 'NotoSansKhmer';
        src: url('{{ base_path('resources/fonts/NotoSansKhmer-Regular.ttf') }}') format('truetype');
        font-weight: normal;
        }

        body {
            font-family: 'NotoSansKhmer', sans-serif;
        }

        table, th, td {
            font-family: 'NotoSansKhmer', sans-serif;
            font-size: 12pt;
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
</html> --}}



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Standard Parameters</title>
    <style>
        @font-face {
            font-family: 'NotoSansKhmer';
            src: url('{{ base_path('resources/fonts/NotoSansKhmer-Regular.ttf') }}') format('truetype');
            font-weight: normal;
        }

        body {
            font-family: 'NotoSansKhmer', sans-serif;
            font-size: 12pt;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            font-size: 11pt;
        }

        th {
            background-color: #f0f0f0;
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    @foreach ($standards as $standard)
        <h2>
            {{ $loop->iteration }}. {{ $standard->lab_type }} Standard:
            {{ $standard->name_en }} / {{ $standard->name_kh }}
        </h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
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
                @forelse ($standard->parameters as $index => $parameter)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $parameter->name_en }}</td>
                        <td>{{ $parameter->name_kh }}</td>
                        <td>{{ $parameter->formular }}</td>
                        <td>{{ $parameter->criteria_operator }}</td>
                        <td>{{ $parameter->criteria_value1 }}</td>
                        <td>{{ $parameter->criteria_value2 ?? '-' }}</td>
                        <td>{{ $parameter->LOQ }}</td>
                        <td>{{ $parameter->method }}</td>
                        <td>{{ $parameter->unit }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No parameters found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endforeach
</body>
</html>



