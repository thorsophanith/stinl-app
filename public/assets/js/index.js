
          // profile


          document.addEventListener('DOMContentLoaded', () => {
            const menuButton = document.getElementById('menu-button');
            const dropdownMenu = document.getElementById('profile-dropdown-menu');
            const dropdownContainer = document.getElementById('profile-dropdown-container');
            /**
             * Toggles the visibility of the dropdown menu.
             */
            const toggleDropdown = () => {
              const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
              menuButton.setAttribute('aria-expanded', !isExpanded);
              dropdownMenu.classList.toggle('hidden'); // Show/hide the dropdown
            };
            /**
             * Handles clicks outside the dropdown to close it.
             *
             * @param {MouseEvent} event - The click event.
             */
            const handleClickOutside = (event) => {
              // If the dropdown is visible and the click is outside the dropdown container, close it
              if (!dropdownMenu.classList.contains('hidden') && !dropdownContainer.contains(event.target)) {
                menuButton.setAttribute('aria-expanded', 'false');
                dropdownMenu.classList.add('hidden');
              }
            };

            // Add event listener to the menu button to toggle the dropdown
            menuButton.addEventListener('click', toggleDropdown);

            // Add event listener to the document to close the dropdown when clicking outside
            document.addEventListener('mousedown', handleClickOutside);
          });

      // Get references to the sidebar, toggle button, menu icon, close icon, and backdrop
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        const sidebarBackdrop = document.getElementById('sidebar-backdrop');

        // Function to toggle sidebar visibility
        function toggleSidebar() {
            // Check if the sidebar has the '-translate-x-full' class
            const isOpen = sidebar.classList.contains('-translate-x-full');

            if (isOpen) {
                // If closed, open it by removing '-translate-x-full' and adding 'translate-x-0'
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                menuIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                sidebarBackdrop.classList.remove('hidden'); // Show backdrop
            } else {
                // If open, close it by adding '-translate-x-full' and removing 'translate-x-0'
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                menuIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                sidebarBackdrop.classList.add('hidden'); // Hide backdrop
            }
        }

        // Add event listeners
        sidebarToggle.addEventListener('click', toggleSidebar);
        sidebarBackdrop.addEventListener('click', toggleSidebar); // Close sidebar when backdrop is clicked

        // Handle initial state for larger screens where sidebar is always visible
        // This ensures the correct icon is shown if the page loads on a large screen
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) { // Tailwind's 'lg' breakpoint
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                menuIcon.classList.remove('hidden'); // Ensure menu icon is visible
                closeIcon.classList.add('hidden'); // Ensure close icon is hidden
                sidebarBackdrop.classList.add('hidden'); // Hide backdrop on large screens
            } else {
                // On smaller screens, if sidebar is open, keep menu icon hidden and close icon visible
                // Otherwise, ensure menu icon is visible and close icon is hidden
                if (sidebar.classList.contains('translate-x-0') && !sidebar.classList.contains('-translate-x-full')) {
                    menuIcon.classList.add('hidden');
                    closeIcon.classList.remove('hidden');
                    sidebarBackdrop.classList.remove('hidden'); // Show backdrop if sidebar is open
                } else {
                    menuIcon.classList.remove('hidden');
                    closeIcon.classList.add('hidden');
                    sidebarBackdrop.classList.add('hidden'); // Hide backdrop if sidebar is closed
                }
            }
        });

        // Initial check on page load
        if (window.innerWidth >= 1024) {
            sidebar.classList.remove('-translate-x-full');
            sidebar.classList.add('translate-x-0');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            sidebarBackdrop.classList.add('hidden');
        }

    //  create

        let counter = 1;
    document.getElementById('add-parameter').addEventListener('click', function () {
        const container = document.getElementById('parameters-container');
        const newRow = container.firstElementChild.cloneNode(true);

        newRow.querySelectorAll('input').forEach(input => {
            const name = input.getAttribute('name');
            const newName = name.replace(/\[\d+\]/, `[${counter}]`);
            input.setAttribute('name', newName);
            input.value = ''; // Clear value
        });

        container.appendChild(newRow);
        counter++;
    });