{{-- @extends('includes.app')
@section('content')
<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 mb-8 mt-8 px-4">

        <div class="bg-white px-5 py-11 rounded-xl ring1 transform hover:scale-105 transition duration-300 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-green-500 bg-green-100 p-3 rounded-full">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">New Users</span>
            </div>
            @if (session('total_users'))
            <div class="text-3xl font-bold text-gray-900 mb-2">
            <strong>{{ session('total_users') }}</strong>
            </div>
            <p class="text-gray-500 text-sm font-medium">
                <i class="fas fa-arrow-down mr-1"></i>
                @php
                $growth = session('total_users_percentage_change');
                $color = 'text-gray-800';  // default color
                $icon = '';                // arrow icon
                if ($growth > 0) {
                    $color = 'text-green-700';
                    $icon = '↑';
                } elseif ($growth < 0) {
                    $color = 'text-red-700';
                    $icon = '↓';
                }
            @endphp
                <span class="{{ $color }}">
                    {{ $icon }} {{ abs($growth) }}%
                </span> vs last month
                @endif
            </p>
        </div>
        <div class="bg-white px-5 py-4 rounded-xl ring1 transform hover:scale-105 transition duration-300 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-red-500 bg-amber-300 p-3 rounded-full">
                    <i class="fas fa-chart-pie text-2xl"></i>
                </div>
                <span class="font-bold text-amber-500">Total Standards</span>
            </div>
            <span class="text-sm font-medium text-gray-500">
                @php
                    use App\Models\Standard;
                    use Illuminate\Support\Facades\DB;

                    $counts = Standard::select('lab_type', DB::raw('count(*) as total'))
                        ->groupBy('lab_type')
                        ->pluck('total', 'lab_type');

                    $totalAll = Standard::count();

                    $labTypes = ['Microbiological', 'Chemical'];

                    $percentages = [];
                    $knownTotal = 0;

                    foreach ($labTypes as $type) {
                        $count = $counts->get($type, 0);
                        $percent = round($count * 0.1, 1); // 1 standard = 0.1%
                        $percentages[$type] = $percent;
                        $knownTotal += $count;
                    }

                    $otherCount = $totalAll - $knownTotal;
                    $otherPercent = round($otherCount * 0.1, 1);

                    $totalPercentage = array_sum($percentages) + $otherPercent;
                @endphp

                <div class="">
                    <p class="text-3xl font-bold text-gray-900 mb-1">{{ $totalAll }}</p>
                </div>
                <p class="text-green-500 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> ({{ $totalPercentage }}%) vs last month
                </p>
            </span>
        </div>


        @foreach ($labTypes as $type)
        <div class="bg-white px-5 py-4 rounded-xl ring1 transform hover:scale-105 transition duration-300 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-blue-500 bg-blue-300 p-3 rounded-full">
                    <i class="fas fa-chart-pie text-2xl"></i>
                </div>
                <span class="font-bold text-blue-400">{{ $type }}</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $counts->get($type, 0) }}</h3>
            <p class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up mr-1"></i> ({{ $percentages[$type] }}%) vs last month
            </p>
        </div>
        @endforeach
    </div>

    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 mb-8 mt-8 px-4">
            <!-- Your existing cards here -->
        </div>
    
        <!-- Monthly Revenue Chart Section -->
        <div class="bg-white p-6 rounded-xl shadow-md mb-8 mx-4">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Monthly Standards Revenue</h2>
            <div class="h-80">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
    </div>

</div>
@endsection


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get data from PHP
    const monthlyData = @json($monthlyStandards ?? []);
    
    // Prepare labels and data
    const months = Object.keys(monthlyData);
    const standardsCount = Object.values(monthlyData).map(count => count);
    const revenueData = Object.values(monthlyData).map(count => count * 0.1);

    // Create chart
    const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Standards Count',
                    data: standardsCount,
                    backgroundColor: 'rgba(79, 70, 229, 0.7)',
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1,
                    yAxisID: 'y'
                },
                {
                    label: 'Revenue (%)',
                    data: revenueData,
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1,
                    type: 'line',
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: { display: true, text: 'Standards Count' }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: { display: true, text: 'Revenue (%)' },
                    grid: { drawOnChartArea: false }
                }
            }
        }
    });
});
</script> --}}




@extends('includes.app')
@section('content')
<div class="opacity-0 animate-fadeIn">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 mb-8 mt-8 px-4">

        <div class="bg-white px-5 py-11 rounded-xl ring1 transform hover:scale-105 hover:shadow-xl transition duration-500 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-green-500 bg-green-100 p-3 rounded-full">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">New Users</span>
            </div>
            @if (session('total_users'))
            <div class="text-3xl font-bold text-gray-900 mb-2">
                <strong>{{ session('total_users') }}</strong>
            </div>
            <p class="text-gray-500 text-sm font-medium">
                @php
                $growth = session('total_users_percentage_change');
                $color = 'text-gray-800';  // default color
                $icon = '';                // arrow icon
                if ($growth > 0) {
                    $color = 'text-green-700';
                    $icon = '↑';
                } elseif ($growth < 0) {
                    $color = 'text-red-700';
                    $icon = '↓';
                }
                @endphp
                <span class="{{ $color }}">
                    {{ $icon }} {{ abs($growth) }}%
                </span> vs last month
            </p>
            @endif
        </div>

        <div class="bg-white px-5 py-4 rounded-xl ring1 transform hover:scale-105 hover:shadow-xl transition duration-500 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-red-500 bg-amber-300 p-3 rounded-full">
                    <i class="fas fa-chart-pie text-2xl"></i>
                </div>
                <span class="font-bold text-amber-500">Total Standards</span>
            </div>
            <span class="text-sm font-medium text-gray-500">
                @php
                    use App\Models\Standard;
                    use Illuminate\Support\Facades\DB;

                    $counts = Standard::select('lab_type', DB::raw('count(*) as total'))
                        ->groupBy('lab_type')
                        ->pluck('total', 'lab_type');

                    $totalAll = Standard::count();

                    $labTypes = ['Microbiological', 'Chemical'];

                    $percentages = [];
                    $knownTotal = 0;

                    foreach ($labTypes as $type) {
                        $count = $counts->get($type, 0);
                        $percent = round($count * 0.1, 1); // 1 standard = 0.1%
                        $percentages[$type] = $percent;
                        $knownTotal += $count;
                    }

                    $otherCount = $totalAll - $knownTotal;
                    $otherPercent = round($otherCount * 0.1, 1);

                    $totalPercentage = array_sum($percentages) + $otherPercent;
                @endphp

                <div class="">
                    <p class="text-3xl font-bold text-gray-900 mb-1">{{ $totalAll }}</p>
                </div>
                <p class="text-green-500 text-sm font-medium">
                    <i class="fas fa-arrow-up mr-1"></i> ({{ $totalPercentage }}%) vs last month
                </p>
            </span>
        </div>

        @foreach ($labTypes as $type)
        <div class="bg-white px-5 py-4 rounded-xl ring1 transform hover:scale-105 hover:shadow-xl transition duration-500 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-blue-500 bg-blue-300 p-3 rounded-full">
                    <i class="fas fa-chart-pie text-2xl"></i>
                </div>
                <span class="font-bold text-blue-400">{{ $type }}</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ $counts->get($type, 0) }}</h3>
            <p class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up mr-1"></i> ({{ $percentages[$type] }}%) vs last month
            </p>
        </div>
        @endforeach
    </div>

    <div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 mb-8 mt-8 px-4">
            <!-- Your existing cards here -->
        </div>
    
        <!-- Monthly Revenue Chart Section -->
        <div class="bg-white p-6 rounded-xl shadow-md mb-8 mx-4">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Monthly Standards Revenue</h2>
            <div class="h-80">
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
    </div>

</div>


<style>
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.8s ease forwards;
}
</style>
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Make sure monthlyStandards exists
    const monthlyData = @json($monthlyStandards ?? []);

    const months = Object.keys(monthlyData);
    const standardsCount = Object.values(monthlyData);
    const revenueData = Object.values(monthlyData).map(count => count * 0.1);

    // Canvas context
    const ctx = document.getElementById('monthlyRevenueChart').getContext('2d');

    // Gradients for bars and line
    const gradientBlue = ctx.createLinearGradient(0, 0, 0, 400);
    gradientBlue.addColorStop(0, 'rgba(79, 70, 229, 0.9)');
    gradientBlue.addColorStop(1, 'rgba(79, 70, 229, 0.3)');

    const gradientGreen = ctx.createLinearGradient(0, 0, 0, 400);
    gradientGreen.addColorStop(0, 'rgba(16, 185, 129, 0.9)');
    gradientGreen.addColorStop(1, 'rgba(16, 185, 129, 0.3)');

    // Create Chart
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Standards Count',
                    data: standardsCount,
                    backgroundColor: gradientBlue,
                    borderColor: 'rgba(79, 70, 229, 1)',
                    borderWidth: 1,
                    yAxisID: 'y',
                    hoverBackgroundColor: 'rgba(79, 70, 229, 0.9)',
                    hoverBorderColor: 'rgba(79, 70, 229, 1)'
                },
                {
                    label: 'Revenue (%)',
                    data: revenueData,
                    backgroundColor: gradientGreen,
                    borderColor: 'rgba(16, 185, 129, 1)',
                    borderWidth: 1,
                    type: 'line',
                    yAxisID: 'y1',
                    tension: 0.4,
                    fill: false,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointBackgroundColor: 'rgba(16, 185, 129, 0.9)',
                    pointHoverBackgroundColor: 'rgba(16, 185, 129, 1)'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            },
            hover: {
                animationDuration: 400
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: { display: true, text: 'Standards Count' },
                    ticks: {
                        beginAtZero: true,
                        stepSize: 1
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: { display: true, text: 'Revenue (%)' },
                    grid: { drawOnChartArea: false },
                    ticks: {
                        beginAtZero: true
                    }
                }
            },
            plugins: {
                tooltip: {
                    enabled: true,
                    mode: 'nearest',
                    intersect: false,
                    backgroundColor: 'rgba(0,0,0,0.7)',
                    titleFont: { size: 14 },
                    bodyFont: { size: 12 }
                },
                legend: {
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
});
</script>

