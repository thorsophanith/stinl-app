
//  ស្វ័យគុណ
function closeErrorDialog() {
    document.getElementById('errorDialog').classList.add('hidden');
}


  let formToSubmit = null;
  function showDeleteDialog(form) {
      formToSubmit = form;
      const dialog = document.getElementById('deleteDialog');
      const box = document.getElementById('deleteBox');
      dialog.classList.remove('pointer-events-none');
      dialog.classList.add('opacity-100');
      box.classList.add('opacity-100', 'scale-100');
      window.scrollTo({ top: 0, behavior: 'smooth' });
  }
  function cancelDelete() {
      const dialog = document.getElementById('deleteDialog');
      const box = document.getElementById('deleteBox');
      box.classList.remove('opacity-100', 'scale-100');
      box.classList.add('scale-95', 'opacity-0');
      dialog.classList.remove('opacity-100');
      setTimeout(() => {
          dialog.classList.add('pointer-events-none');
      }, 300);
  }
  function confirmDelete() {
      if (formToSubmit) formToSubmit.submit();
  }
  
                  //  Create standards
  
  
  document.addEventListener('DOMContentLoaded', () => {
      const tabs = document.querySelectorAll('.lab-tab');
      const sections = document.querySelectorAll('.lab-section');
      function activateTab(selected) {
          sections.forEach(sec => {
              sec.style.display = (selected === 'all' || sec.dataset.tab === selected) ? 'block' : 'none';
          });
          tabs.forEach(tab => {
              tab.classList.toggle('border-blue-500', tab.dataset.tab === selected);
              tab.classList.toggle('text-blue-600', tab.dataset.tab === selected);
          });
      }
      activateTab('all');
      tabs.forEach(tab => {
          tab.addEventListener('click', () => activateTab(tab.dataset.tab));
      });
      document.querySelectorAll('.add-parameter').forEach(button => {
          button.addEventListener('click', () => {
              const labIndex = button.dataset.lab;
              const section = document.querySelector(`.parameter-section[data-lab="${labIndex}"]`);
              const groups = section.querySelectorAll('.parameter-groups');
              const lastIndex = groups.length;
  
              const template = groups[0].cloneNode(true);
              template.querySelectorAll('input').forEach(input => {
              const oldName = input.name;
              const newName = oldName.replace(/\[parameters\]\[\d+\]/, `[parameters][${lastIndex}]`);
              input.name = newName;
              input.value = '';
              });
              const label = template.querySelector('.parameter-label');
              if (label) label.textContent = `Parameter ${lastIndex + 1}`;
  
              section.appendChild(template);
          });
      });
      document.addEventListener('click', function(e) {
          if (e.target.classList.contains('remove-parameters')) {
              const group = e.target.closest('.parameter-groups');
              const section = group.parentElement;
              const allGroups = section.querySelectorAll('.parameter-groups');
              if (allGroups.length > 1) {
              group.remove();
              } else {
              Swal.fire({
                  icon: 'warning',
                  title: 'Oops!',
                  text: 'At least one parameter is required.',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
                  });
              }
          }
      });
  });
  
  
  // {{-- Use @push('scripts') and @stack('scripts') for scripts --}}
  
  document.addEventListener('DOMContentLoaded', function() {
      const filterTabs = document.querySelectorAll('.filter-tab');
      const standardSections = document.querySelectorAll('.standard-section');
      const defaultTab = document.querySelector('.filter-tab[data-filter="all"]');
      if (defaultTab) {
          defaultTab.classList.add('bg-blue-500', 'text-white');
          defaultTab.classList.remove('bg-gray-100', 'text-gray-700');
      }
      filterTabs.forEach(tab => {
          tab.addEventListener('click', function() {
              const filter = this.dataset.filter;
              filterTabs.forEach(t => {
              t.classList.remove('bg-blue-500', 'text-white');
              t.classList.add('bg-gray-100', 'text-gray-700');
              });
              this.classList.add('bg-blue-500', 'text-white');
              this.classList.remove('bg-gray-100', 'text-gray-700');
              standardSections.forEach(section => {
                  section.style.display = (filter === 'all' || section.dataset.labType === filter) ? 'block' : 'none';
              });
          });
      });
      document.querySelectorAll('.add-parameter').forEach(button => {
          button.addEventListener('click', function() {
              const labType = this.dataset.labType;
              const container = this.closest('.standard-section').querySelector('.parameters-container');
              const template = document.getElementById('parameter-template').innerHTML;
              const index = Date.now();
              const html = template
                  .replace(/TEMPLATE_LAB_TYPE/g, labType)
                  .replace(/TEMPLATE_INDEX/g, index)
                  .replace(/\[parameters\]\[TEMPLATE_INDEX\]/g, `[parameters][${index}]`)
                  .replace(/standards\[TEMPLATE_LAB_TYPE\]\[parameters\]/g, `standards[${labType}][parameters]`);
              const div = document.createElement('div');
              div.className = 'parameter-group mb-3 p-3 border rounded';
              div.innerHTML = html;
              container.appendChild(div);
              div.querySelector('.remove-parameter')?.addEventListener('click', function() {
                  this.closest('.parameter-group')?.remove();
              });
          });
      });
      document.querySelectorAll('.remove-parameter').forEach(btn => {
          btn.addEventListener('click', function() {
              this.closest('.parameter-group')?.remove();
          });
      });
  });
  
           // profile
  
            document.addEventListener('DOMContentLoaded', () => {
              const menuButton = document.getElementById('menu-button');
              const dropdownMenu = document.getElementById('profile-dropdown-menu');
              const dropdownContainer = document.getElementById('profile-dropdown-container');
              const toggleDropdown = () => {
                const isExpanded = menuButton.getAttribute('aria-expanded') === 'true';
                menuButton.setAttribute('aria-expanded', !isExpanded);
                dropdownMenu.classList.toggle('hidden');
              };
              /**
               * Handles clicks outside the dropdown to close it.
               *
               * @param {MouseEvent} event - The click event.
               */
              const handleClickOutside = (event) => {
                if (!dropdownMenu.classList.contains('hidden') && !dropdownContainer.contains(event.target)) {
                  menuButton.setAttribute('aria-expanded', 'false');
                  dropdownMenu.classList.add('hidden');
                }
              };
              menuButton.addEventListener('click', toggleDropdown);
              document.addEventListener('mousedown', handleClickOutside);
            });
              const sidebar = document.getElementById('sidebar');
              const sidebarToggle = document.getElementById('sidebar-toggle');
              const menuIcon = document.getElementById('menu-icon');
              const closeIcon = document.getElementById('close-icon');
              const sidebarBackdrop = document.getElementById('sidebar-backdrop');
              function toggleSidebar() {
              const isOpen = sidebar.classList.contains('-translate-x-full');
  
              if (isOpen) {
                  sidebar.classList.remove('-translate-x-full');
                  sidebar.classList.add('translate-x-0');
                  menuIcon.classList.add('hidden');
                  closeIcon.classList.remove('hidden');
                  sidebarBackdrop.classList.remove('hidden');
              } else {
                  sidebar.classList.remove('translate-x-0');
                  sidebar.classList.add('-translate-x-full');
                  menuIcon.classList.remove('hidden');
                  closeIcon.classList.add('hidden');
                  sidebarBackdrop.classList.add('hidden');
              }
          }
          sidebarToggle.addEventListener('click', toggleSidebar);
          sidebarBackdrop.addEventListener('click', toggleSidebar);
          window.addEventListener('resize', () => {
              if (window.innerWidth >= 1024) {
                  sidebar.classList.remove('-translate-x-full');
                  sidebar.classList.add('translate-x-0');
                  menuIcon.classList.remove('hidden');
                  closeIcon.classList.add('hidden');
                  sidebarBackdrop.classList.add('hidden');
              } else {
                  if (sidebar.classList.contains('translate-x-0') && !sidebar.classList.contains('-translate-x-full')) {
                      menuIcon.classList.add('hidden');
                      closeIcon.classList.remove('hidden');
                      sidebarBackdrop.classList.remove('hidden');
                  } else {
                      menuIcon.classList.remove('hidden');
                      closeIcon.classList.add('hidden');
                      sidebarBackdrop.classList.add('hidden');
                  }
              }
          });
          if (window.innerWidth >= 1024) {
              sidebar.classList.remove('-translate-x-full');
              sidebar.classList.add('translate-x-0');
              menuIcon.classList.remove('hidden');
              closeIcon.classList.add('hidden');
              sidebarBackdrop.classList.add('hidden');
          }
          let counter = document.querySelectorAll('.parameter-row').length;
  
  function updateRemoveButtonVisibility() {
      const container = document.getElementById('parameters-container');
      const rows = container.querySelectorAll('.parameter-row');
      const removeBtn = document.getElementById('remove-parameter');
      removeBtn.style.display = rows.length > 1 ? 'inline-block' : 'none';
  }
  updateRemoveButtonVisibility();