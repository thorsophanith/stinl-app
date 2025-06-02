@extends('includes.app')
@section('content')
<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8 mt-8">
        <div class="bg-white p-6 rounded-xl shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-indigo-500 bg-indigo-100 p-3 rounded-full">
                    <i class="fas fa-dollar-sign text-2xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">Total Revenue</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-2">$45,231.89</h3>
            <p class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up mr-1"></i>12.5% vs last month
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-green-500 bg-green-100 p-3 rounded-full">
                    <i class="fas fa-users text-2xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">New Users</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-2">2,345</h3>
            <p class="text-red-500 text-sm font-medium">
                <i class="fas fa-arrow-down mr-1"></i>2.1% vs last month
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-yellow-500 bg-yellow-100 p-3 rounded-full">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">New Orders</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-2">1,789</h3>
            <p class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up mr-1"></i>8.3% vs last month
            </p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-md transform hover:scale-105 transition duration-300 ease-in-out">
            <div class="flex items-center justify-between mb-4">
                <div class="text-red-500 bg-red-100 p-3 rounded-full">
                    <i class="fas fa-chart-pie text-2xl"></i>
                </div>
                <span class="text-sm font-medium text-gray-500">Conversion Rate</span>
            </div>
            <h3 class="text-3xl font-bold text-gray-900 mb-2">3.56%</h3>
            <p class="text-green-500 text-sm font-medium">
                <i class="fas fa-arrow-up mr-1"></i>0.7% vs last month
            </p>
        </div>
    </div>
</div>
@endsection