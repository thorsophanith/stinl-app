<!DOCTYPE html>
<html lang="en">
<head>
        @include('layouts.head')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Khmer&display=swap" rel="stylesheet">
        <style>
            .khmer-regular {
                font-family: "Khmer", sans-serif;
                font-weight: 400;
                font-style: normal;
                }
        </style>
</head>
<body class="flex h-screen bg-gray-100 font-sans text-gray-800">
    @if(Auth::check())
               <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    @include('layouts.sidebar')
                </form>
                    @else
                    @endif

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black opacity-50 z-20 hidden lg:hidden"></div>

    <div class="flex-1 flex flex-col overflow-hidden">
       @include('layouts.header')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-2 md:p-6 custom-scrollbar">

            <div class="mt-8 bg-white p-3 md:p-6 rounded-xl shadow-lg khmer-regular">
                <div class="overflow-x-auto">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @include('layouts.footer')
</body>
</html>
