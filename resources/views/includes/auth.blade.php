{{-- <!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head') 

    <style>
    @keyframes slideImages {
        0% { transform: translateX(0%); }
        20% { transform: translateX(0%); }

        25% { transform: translateX(-100%); }
        45% { transform: translateX(-100%); }

        50% { transform: translateX(-200%); }
        70% { transform: translateX(-200%); }

        75% { transform: translateX(-300%); }
        95% { transform: translateX(-300%); }

        100% { transform: translateX(0%); }
    }

    .slide-container {
        width: 400%; /* 4 images * 100% */
        height: 100%;
        animation: slideImages 8s infinite ease-in-out;
    }

    </style>

</head>
<body class="flex flex-row min-h-screen bg-white text-black">
    @if(Auth::check())
        <script>window.location = "{{ route('/') }}";</script>
    @endif

    <div class="w-[50%] h-screen relative overflow-hidden shadow-2xl">
    <div class="w-full h-full absolute flex slide-container">
        <img src="https://api.stinl.gov.kh/uploads/images/7afa0870-3263-4a4a-b5ea-e6113f610cd4.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
        <img src="https://api.stinl.gov.kh/uploads/images/18d3177a-2278-4058-afcf-b5c801904c67.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
        <img src="https://www.stinl.gov.kh/uploads/images/40e5f8c8-c890-49a9-a1e3-00dd93f3173e.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
        <img src="https://api.stinl.gov.kh/uploads/images/88786fc7-976f-4d22-bc42-e34283b4a590.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
    </div>
</div>


    <div class="flex justify-center w-[50%] h-screen p-4 bg-gradient-to-l from-blue-700 to-indigo-800">
        <main>
            @yield('content')
        </main>
    </div>

    

    @include('layouts.footer')
</body>
</html> --}}



<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')

    <style>
    @keyframes slideImages {
        0% { transform: translateX(0%); }
        20% { transform: translateX(0%); }

        25% { transform: translateX(-100%); }
        45% { transform: translateX(-100%); }

        50% { transform: translateX(-200%); }
        70% { transform: translateX(-200%); }

        75% { transform: translateX(-300%); }
        95% { transform: translateX(-300%); }

        100% { transform: translateX(0%); }
    }

    .slide-container {
        width: 400%; /* 4 images * 100% */
        height: 100%;
        animation: slideImages 9s infinite ease-in-out;
    }
    .fox1{
        position: absolute;
        top: 50%;
        transform: translate(-0%, -50%);
    }

    </style>

</head>
<body class="flex flex-row bg-white text-black">
    @if(Auth::check())
        <script>window.location = "{{ route('/') }}";</script>
    @endif

    <div class="w-[50%] max-md:hidden h-screen relative overflow-hidden shadow-2xl">
    <div class="w-full h-full absolute flex slide-container">
        <img src="https://api.stinl.gov.kh/uploads/images/7afa0870-3263-4a4a-b5ea-e6113f610cd4.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
        <img src="https://api.stinl.gov.kh/uploads/images/18d3177a-2278-4058-afcf-b5c801904c67.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
        <img src="https://www.stinl.gov.kh/uploads/images/40e5f8c8-c890-49a9-a1e3-00dd93f3173e.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
        <img src="https://api.stinl.gov.kh/uploads/images/88786fc7-976f-4d22-bc42-e34283b4a590.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
    </div>
</div>


    <div class="flex justify-center w-[100%] md:w-[50%] h-screen md:p-4 md:bg-gradient-to-l from-blue-700 to-indigo-800">
        <div class="relative w-[100%] md:hidden h-screen relative overflow-hidden shadow-2xl">
            <div class="w-full h-full absolute flex slide-container">
                <img src="https://api.stinl.gov.kh/uploads/images/7afa0870-3263-4a4a-b5ea-e6113f610cd4.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
                <img src="https://api.stinl.gov.kh/uploads/images/18d3177a-2278-4058-afcf-b5c801904c67.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
                <img src="https://www.stinl.gov.kh/uploads/images/40e5f8c8-c890-49a9-a1e3-00dd93f3173e.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
                <img src="https://api.stinl.gov.kh/uploads/images/88786fc7-976f-4d22-bc42-e34283b4a590.jpg" class="w-full h-full object-cover flex-shrink-0" style="opacity: 0.75;" />
            </div>
        </div>
        <main class="fox1 px-3">
            @yield('content')
        </main>
    </div>

    @include('layouts.footer')
</body>
</html>
