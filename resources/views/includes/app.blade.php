<!DOCTYPE html>
<html lang="en">
<head>
        @include('layouts.head')
</head>
<body class="flex h-screen bg-gray-100 font-sans text-gray-800">
    @include('layouts.sidebar')

    <div id="sidebar-backdrop"
        class="fixed inset-0 bg-black opacity-50 z-20 hidden lg:hidden"></div>

    <div class="flex-1 flex flex-col overflow-hidden">
       @include('layouts.header')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6 custom-scrollbar">

            <div class="mt-8 bg-white p-6 rounded-xl shadow-lg">
                <div class="overflow-x-auto">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @include('layouts.footer')
</body>
</html>
