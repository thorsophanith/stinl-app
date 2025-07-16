@extends('includes.app')

@section('content')
<div class="max-w-2xl mx-auto mt-8 p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Parameter Price Detail</h2>

    <table class="table-auto w-full border">
        <tr><th class="text-left p-2">Code</th><td class="p-2">{{ $price->code ?? '-' }}</td></tr>
        <tr><th class="text-left p-2">Parameter (text)</th><td class="p-2">{{ $price->parameter ?? '-' }}</td></tr>
        <tr><th class="text-left p-2">Parameter (linked)</th><td class="p-2">{{ $price->parameter?->name_en ?? '-' }}</td></tr>
        <tr><th class="text-left p-2">Test Duration</th><td class="p-2">{{ $price->test_duration ?? '-' }} days</td></tr>
        <tr><th class="text-left p-2">Price</th><td class="p-2">${{ number_format($price->price, 2) }}</td></tr>
        <tr><th class="text-left p-2">Lab Type</th><td class="p-2">{{ $price->lab_type ?? '-' }}</td></tr>
    </table>

    <div class="mt-4">
        <a href="{{ route('parameter-prices.index') }}" class="text-blue-600 hover:underline">← Back to list</a>
    </div>
</div>
@endsection