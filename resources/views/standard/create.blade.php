@extends('includes.app')

@section('content')
<div class="w-full py-6 px-3">

    <form action="{{ route('standard.storeOne') }}" method="POST" onsubmit="syncAllEditableContents()">
        @csrf
        <a href="{{ route('standard.index') }}" class="bg-blue-300 py-1.5 px-3 rounded-md text-blue-600 hover:underline mb-4 inline-block">
            ← Back home
        </a>
         <h1 class="text-lg md:text-2xl font-medium mb-6 text-gray-800">Standard Add (Microbiological and Chemical)</h1>
        <div id="alertBox" class="hidden fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded shadow-md z-50 max-w-md text-center font-semibold" role="alert"></div>
        <div class="grid md:grid-cols-2 gap-4">
            @foreach (['code', 'cs', 'name_en', 'name_kh', 'codex'] as $field)
                <div>
                    <label class="block font-semibold text-gray-700 mb-1">{{ ucfirst(str_replace('_', ' ', $field)) }}:</label>
                    <input type="text" name="{{ $field }}" @if(in_array($field, ['code', 'name_en', 'name_kh'])) required @endif
                        class="leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3">
                </div>
            @endforeach
        </div>

        <div class="mb-6 pt-7">
            <div class="flex gap-1 border-b">
                <button type="button" class="lab-tab active-tab px-4 pt-3 text-sm font-semibold border rounded-t-xl py-1" data-tab="all">All Standards</button>
                @foreach ($labTypeTranslations as $type => $label)
                    <button type="button" class="lab-tab px-4 pt-3 text-sm font-semibold border rounded-t-xl py-1 hover:border-blue-400" data-tab="{{ $type }}">{{ $label }}</button>
                @endforeach
            </div>
        </div>

        @php
            $labTypes = ['Microbiological', 'Chemical'];
        @endphp

        @foreach ($labTypes as $index => $labType)
        <div id="section{{ $labType }}" class="lab-section" data-tab="{{ $labType }}">
            <h3 class="card-header mt-16 mb-10 bg-blue-600 text-white py-3 ring-2 ring-blue-400 px-5 rounded-md font-medium pb-3">{{ $labType }} Standard</h3>
            <input type="hidden" name="standards[{{ $index }}][lab_type]" value="{{ $labType }}">

            <div id="params{{ $labType }}" class="space-y-6 mt-4"></div>
            <button type="button" class="add-param-btn bg-green-600 text-white mt-5 px-3 py-1.5 rounded-md mt-2" data-labtype="{{ $labType }}">+ Add Parameter</button>
        </div>
        @endforeach

        <div class="pt-6 text-center">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-semibold">Submit</button>
        </div>
    </form>
</div>



<style>
    .input-wrapper { position: relative; margin-bottom: 1rem; }
    .editable-input {
      min-height: 2.5rem; padding: 0.5rem 0.75rem; border: 1px solid #ccc;
      border-radius: 0.375rem; font-size: 1rem; white-space: pre-wrap;
      overflow-wrap: break-word; outline: none; cursor: text;
    }
    .editable-input:focus {
      border-color: #2563eb; box-shadow: 0 0 0 2px #bfdbfe;
    }
    .superscript { vertical-align: super; font-size: 0.75em; }
    .subscript { vertical-align: sub; font-size: 0.75em; }
    .button-sup, .button-sub {
      margin-top: 0.5rem; cursor: pointer; border: none;
      padding: 0.1rem 0.3rem; border-radius: 0.375rem; user-select: none;
      color: white;
    }
    .button-sup { background: #2563eb; margin-right: 0.5rem; }
    .button-sub { background: #16a34a; }
    .remove-param-btn {
      background: #ef4444; color: white; border: none;
      padding: 0.25rem 0.5rem; border-radius: 0.375rem;
      cursor: pointer; font-size: 0.875rem;
      position: absolute; top: 0.5rem; right: 0.5rem;
    }
    .parameter-block {
      /* border: 1px solid #ddd; padding: 1rem; border-radius: 0.375rem; */
      position: relative;
    }
  </style>


<script>
// Tab switching behavior
const tabButtons = document.querySelectorAll('.lab-tab');
const labSections = document.querySelectorAll('.lab-section');

tabButtons.forEach(button => {
    button.addEventListener('click', () => {
        const tab = button.getAttribute('data-tab');

        tabButtons.forEach(btn => btn.classList.remove('active-tab'));
        button.classList.add('active-tab');

        labSections.forEach(section => {
            if (tab === 'all' || section.dataset.tab === tab) {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        });
    });
});

let paramIndex = { Microbiological: 0, Chemical: 0 };

  function createParameterHTML(labType, index) {
    const prefix = `standards[${labType === 'Microbiological' ? 0 : 1}][parameters][${index}]`;
    const editableId1 = `criteriaValue1_${labType}_${index}`;
    const hiddenId1 = `hiddenCriteriaValue1_${labType}_${index}`;
    const editableId2 = `criteriaValue2_${labType}_${index}`;
    const hiddenId2 = `hiddenCriteriaValue2_${labType}_${index}`;

    return `
      <div class="parameter-block mb-9 px-4 py-7 border rounded ease-out duration-300 bg-gray-100 ring1" data-index="${index}">
        <div class="font-semibold text-blue-700 text-2xl mb-7">Parameter <span class="param-number">${index + 1}</span></div>
        <button type="button" class="remove-param-btn" onclick="removeParameter(this)">Remove</button>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 max-md:gap-2 gap-5 ">
        <div><label class="block text-sm font-medium">Parameter Name EN</label><input type="text" name="${prefix}[name_en]" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"></div>
        <div><label class="block text-sm font-medium">Parameter Name KH</label><input type="text" name="${prefix}[name_kh]" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"></div>
        <div><label class="block text-sm font-medium">Formular</label><input type="text" name="${prefix}[formular]" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"></div>
        <div><label class="block text-sm font-medium">Criteria Operator</label><input type="text" name="${prefix}[criteria_operator]" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"></div>
        <div><label class="block text-sm font-medium">Method</label><input type="text" name="${prefix}[method]" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"></div>
        <div><label class="block text-sm font-medium">LOQ</label><input type="text" name="${prefix}[LOQ]" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"></div>
        <div class="input-wrapper">
          <label class="block text-sm font-medium">Criteria Value 1</label>
          <div contenteditable="true" id="${editableId1}" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" spellcheck="false"></div>
          <input type="hidden" name="${prefix}[criteria_value1]" id="${hiddenId1}">
          <button type="button" class="button-sup" onclick="toggleSuperscript('${editableId1}')">(x²)</button>
          <button type="button" class="button-sub" onclick="toggleSubscript('${editableId1}')">(x₂)</button>
        </div>

        <div class="input-wrapper">
          <label class="block text-sm font-medium">Criteria Value 2</label>
          <div contenteditable="true" id="${editableId2}" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out" spellcheck="false"></div>
          <input type="hidden" name="${prefix}[criteria_value2]" id="${hiddenId2}">
          <button type="button" class="button-sup" onclick="toggleSuperscript('${editableId2}')">(x²)</button>
          <button type="button" class="button-sub" onclick="toggleSubscript('${editableId2}')">(x₂)</button>
        </div>
        <div><label class="block text-sm font-medium">Unit</label><input type="text" name="${prefix}[unit]" class="form-control leading-tight focus:outline-none form-control bg-white border border-gray-300 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full p-3 dark:text-[16px] dark:text-gray-700  dark:placeholder-gray-400 dark:focus:ring-sky-500 dark:focus:border-sky-400 focus:ring-[1px] duration-300 ease-out"></div>
      </div>
      </div>
    `;
  }

  function updateParameterNumbers(containerId) {
    const container = document.getElementById(containerId);
    const parameterBlocks = container.querySelectorAll('.parameter-block');
    parameterBlocks.forEach((block, i) => {
      const numberSpan = block.querySelector('.param-number');
      if (numberSpan) {
        numberSpan.textContent = i + 1;
      }
    });
  }

  function removeParameter(button) {
    const paramDiv = button.closest('.parameter-block');
    const container = paramDiv.parentElement;
    if (container.querySelectorAll('.parameter-block').length <= 1) {
      showAlert('Cannot remove the last parameter. At least one parameter is required.');
      return;
    }
    paramDiv.remove();
    updateParameterNumbers(container.id);
  }

  function addParameter(labType) {
    const containerId = `params${labType}`;
    const container = document.getElementById(containerId);
    const index = paramIndex[labType]++;
    const paramHTML = createParameterHTML(labType, index);
    container.insertAdjacentHTML('beforeend', paramHTML);
    updateParameterNumbers(containerId);
  }

  function showAlert(message) {
    const alertBox = document.getElementById('alertBox');
    alertBox.textContent = message;
    alertBox.classList.remove('hidden');
    setTimeout(() => alertBox.classList.add('hidden'), 3000);
  }

  function toggleSuperscript(editableId) {
      toggleFormat(editableId, 'sup', 'superscript');
    }
  
    function toggleSubscript(editableId) {
      toggleFormat(editableId, 'sub', 'subscript');
    }
  
    function toggleFormat(editableId, tagName, className) {
      const editableDiv = document.getElementById(editableId);
      const selection = window.getSelection();
  
      if (!selection.rangeCount) return;
  
      const range = selection.getRangeAt(0);
  
      if (!editableDiv.contains(range.commonAncestorContainer)) return;
  
      if (selection.toString().length === 0) {
        alert('Please select the text you want to toggle ' + tagName);
        return;
      }
  
      if (isSelectionFullyInsideTag(range, editableDiv, tagName)) {
        const formatNode = getTagAncestor(range.commonAncestorContainer, editableDiv, tagName);
        if (formatNode) {
          unwrapTag(formatNode, range);
          return;
        }
      }
  
      wrapSelectionWithTag(range, tagName, className);
    }
  
    function isSelectionFullyInsideTag(range, editableDiv, tagName) {
      let ancestor = range.commonAncestorContainer;
      while (ancestor && ancestor !== editableDiv) {
        if (ancestor.nodeType === Node.ELEMENT_NODE && ancestor.tagName.toLowerCase() === tagName) {
          return true;
        }
        ancestor = ancestor.parentNode;
      }
      return false;
    }
  
    function getTagAncestor(node, editableDiv, tagName) {
      let ancestor = node;
      while (ancestor && ancestor !== editableDiv) {
        if (ancestor.nodeType === Node.ELEMENT_NODE && ancestor.tagName.toLowerCase() === tagName) {
          return ancestor;
        }
        ancestor = ancestor.parentNode;
      }
      return null;
    }
  
    function unwrapTag(tagNode, range) {
      const parent = tagNode.parentNode;
      while (tagNode.firstChild) {
        parent.insertBefore(tagNode.firstChild, tagNode);
      }
      parent.removeChild(tagNode);
  
      range.setStart(parent, Array.prototype.indexOf.call(parent.childNodes, tagNode) + 1);
      range.collapse(true);
  
      const selection = window.getSelection();
      selection.removeAllRanges();
      selection.addRange(range);
    }
  
    function wrapSelectionWithTag(range, tagName, className) {
      const tag = document.createElement(tagName);
      tag.className = className;
  
      const content = range.extractContents();
      tag.appendChild(content);
  
      range.insertNode(tag);
  
      range.setStartAfter(tag);
      range.collapse(true);
  
      const selection = window.getSelection();
      selection.removeAllRanges();
      selection.addRange(range);
    }
  
    // Sync both Criteria Value 1 and 2 editable div content into hidden inputs before submitting form
    function syncAllEditableContents() {
      ['Microbiological', 'Chemical'].forEach(labType => {
        const containerId = labType === 'Microbiological' ? 'paramsMicrobiological' : 'paramsChemical';
        const container = document.getElementById(containerId);
  
        // For Criteria Value 1
        const editableDivs1 = container.querySelectorAll('.editable-input[id^="criteriaValue1_"]');
        editableDivs1.forEach(div => {
          const hiddenId = div.id.replace('criteriaValue1', 'hiddenCriteriaValue1');
          const hiddenInput = document.getElementById(hiddenId);
          if (hiddenInput) hiddenInput.value = div.innerHTML.trim();
        });
  
        // For Criteria Value 2
        const editableDivs2 = container.querySelectorAll('.editable-input[id^="criteriaValue2_"]');
        editableDivs2.forEach(div => {
          const hiddenId = div.id.replace('criteriaValue2', 'hiddenCriteriaValue2');
          const hiddenInput = document.getElementById(hiddenId);
          if (hiddenInput) hiddenInput.value = div.innerHTML.trim();
        });
      });
    }

  function syncAllEditableContents() {
    ['Microbiological', 'Chemical'].forEach(lab => {
      const count = paramIndex[lab];
      for (let i = 0; i < count; i++) {
        const id1 = `criteriaValue1_${lab}_${i}`;
        const id2 = `criteriaValue2_${lab}_${i}`;
        const h1 = `hiddenCriteriaValue1_${lab}_${i}`;
        const h2 = `hiddenCriteriaValue2_${lab}_${i}`;
        document.getElementById(h1).value = document.getElementById(id1).innerHTML;
        document.getElementById(h2).value = document.getElementById(id2).innerHTML;
      }
    });
  }

  window.addEventListener('DOMContentLoaded', () => {
    addParameter('Microbiological');
    addParameter('Chemical');

    document.querySelectorAll('.add-param-btn').forEach(button => {
      button.addEventListener('click', () => {
        const labType = button.getAttribute('data-labtype');
        addParameter(labType);
      });
    });
  });


</script>
@endsection













