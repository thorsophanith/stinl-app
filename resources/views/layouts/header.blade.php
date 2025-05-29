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
            <span class="absolute top-1 right-1 block h-2 w-2 rounded-full bg-red-500 ring-2 ring-white"></span>
        </button>
        <div class="relative inline-block text-left" id="profile-dropdown-container">
            <div>
              <button
                type="button"
                class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-500 text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200 ease-in-out hover:scale-105"
                id="menu-button"
                aria-expanded="false"
                aria-haspopup="true"
              >
                <span class="font-semibold text-lg">JD</span>
                <span class="sr-only">Open user menu</span>
              </button>
            </div>
        
            <div
              class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none transform transition-all duration-200 ease-out animate-fade-in hidden"
              role="menu"
              aria-orientation="vertical"
              aria-labelledby="menu-button"
              tabindex="-1"
              id="profile-dropdown-menu"
            >
              <div class="py-1 z-50" role="none">
                <div class="px-4 py-2 border-b border-gray-200">
                  <p class="text-sm font-medium text-gray-900">John Doe</p>
                  <p class="text-xs text-gray-500">john.doe@example.com</p>
                </div>

                <div class="border-t border-gray-200 my-1" role="none"></div>

                <a
                  href="#"
                  class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100 transition-colors duration-150 rounded-md mx-1 my-1"
                  role="menuitem"
                  tabindex="-1"
                  id="menu-item-3"
                >
                  Sign out
                </a>
              </div>
            </div>
          </div>
        
        {{-- <img
            class="h-10 w-10 rounded-full object-cover border-2 border-blue-500 shadow-md"
            src="https://placehold.co/40x40/4F46E5/FFFFFF?text=JD"
            alt="User Avatar"
            onerror="this.onerror=null; this.src='https://placehold.co/40x40/4F46E5/FFFFFF?text=JD';"
        /> --}}
    </div>
</header>