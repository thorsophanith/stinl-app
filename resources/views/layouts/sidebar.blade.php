<aside id="sidebar"
        class="fixed inset-y-0 left-0 z-30 w-64 h-screen bg-white shadow-xl transform transition-transform duration-300 ease-in-out
               -translate-x-full lg:translate-x-0 lg:static lg:inset-0 rounded-r-2xl overflow-y-auto">
        <div class="flex items-center justify-center py-4 bg-gradient-to-r from-blue-700 to-indigo-800 text-white shadow-lg rounded-br-2xl">
            <span class="">
                <img src="https://verify.stinl.gov.kh/Images/stinl_logo.png" alt="" width="100" height="100" class="shadow-2xl shadow-[#646ac48a] hover:animate-none duration-1000 scale-95 rounded-full">
            </span>
        </div>
        <nav class="mt-8">
            <a
                href="/"
                class="flex items-center py-3 px-6 gap-x-2 text-gray-700 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 transition duration-200 ease-in-out rounded-xl mx-3 my-2 font-medium"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>

                Home
            </a>

            <a
                href="{{ route('standard.index') }}"
                class="flex items-center py-3 px-6 gap-x-2 text-gray-700 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 transition duration-200 ease-in-out rounded-xl mx-3 my-2 font-medium"
            >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="m7.875 14.25 1.214 1.942a2.25 2.25 0 0 0 1.908 1.058h2.006c.776 0 1.497-.4 1.908-1.058l1.214-1.942M2.41 9h4.636a2.25 2.25 0 0 1 1.872 1.002l.164.246a2.25 2.25 0 0 0 1.872 1.002h2.092a2.25 2.25 0 0 0 1.872-1.002l.164-.246A2.25 2.25 0 0 1 16.954 9h4.636M2.41 9a2.25 2.25 0 0 0-.16.832V12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 12V9.832c0-.287-.055-.57-.16-.832M2.41 9a2.25 2.25 0 0 1 .382-.632l3.285-3.832a2.25 2.25 0 0 1 1.708-.786h8.43c.657 0 1.281.287 1.709.786l3.284 3.832c.163.19.291.404.382.632M4.5 20.25h15A2.25 2.25 0 0 0 21.75 18v-2.625c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125V18a2.25 2.25 0 0 0 2.25 2.25Z" />
            </svg>
            Standard
            </a>
        </nav>
    </aside>