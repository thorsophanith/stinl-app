<header class="flex items-center justify-between h-20 bg-white shadow-lg px-6  ">
    <div class="flex items-center">
        <button id="sidebar-toggle"
            class="text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md p-2 lg:hidden">
            <svg id="menu-icon"
                class="h-6 w-6"
                fill="none"
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
            <svg id="close-icon"
                class="h-6 w-6 hidden"
                fill="none"
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <h1 class="text-xl md:text-2xl font-bold ml-4 text-gray-900">Dashboard</h1>
    </div>
    <div class="flex items-center space-x-4">
        <button class="text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md p-2 relative">
            <svg
                class="h-6 w-6"
                fill="none"
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth="2"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
            </svg>
            @if(Auth::check())
               <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full bg-green-500 animate-ping ring-2 ring-white"></span>
                    <span class="absolute top-1 right-1 h-2.5 w-2.5 inline-flex size-2 rounded-full bg-green-500"></span>
                </form>
                    @else
                    <span class="absolute top-1 right-1 block h-2.5 w-2.5 rounded-full bg-red-500 animate-ping ring-2 ring-white"></span>
                    <span class="absolute top-1 right-1 h-2.5 w-2.5 inline-flex size-2 rounded-full bg-green-500"></span>
                    @endif
        </button>
        <div class="relative inline-block text-left" id="profile-dropdown-container">
            <div>
              <button
                     type="button"
                     class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-500 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 ease-in-out hover:scale-105"
                     id="menu-button"
                     aria-expanded="false"
                     aria-haspopup="true">
                    <!-- Heroicons user icon -->
                    <svg class="w-8 h-8 mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A9.953 9.953 0 0112 15c2.5 0 4.78 1 6.42 2.62M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="sr-only">Open user menu</span>
              </button>
            </div>

            <div
              class="origin-top-right absolute right-0 z-50 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transform transition-all duration-200 ease-out animate-fade-in hidden"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="menu-button"
              tabindex="-1"
              id="profile-dropdown-menu"
            >
              <div class="py-1 z-50" role="none">
                @auth
                <div class="px-4 py-2 border-b border-gray-200">
                  <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                  <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                </div>
                 @endauth

                 @guest
                     <p class="text-sm font-medium text-gray-900 px-5 py-2.5">Don`t have account?</p>
                 @endguest

                <div class="border-t border-gray-200 my-1" role="none"></div>

                <a class="cursor-pointer text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 transition-colors duration-150 rounded-md mx-1 my-1"
                  role="menuitem"
                  tabindex="-1"
                  id="menu-item-3"
                >
                    @if(Auth::check())
               <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                  <button type="submit" class="w-full text-start font-medium">Sign out</button>
                </form>
                    @else
                        <p>You are not logged in.</p>
                    @endif
                </a>
              </div>
            </div>
          </div>
    </div>
</header>