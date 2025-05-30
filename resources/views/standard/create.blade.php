<form action="{{ route('standard.store') }}" method="POST">
    @csrf
    <!-- Standard fields -->
    <input type="text" name="code" placeholder="Code" required>
    <input type="text" name="codex" placeholder="Codex" required>
    <input type="text" name="name_en" placeholder="Standard Name EN" required>
    <input type="text" name="name_kh" placeholder="Standard Name KH" required>
    <select name="lab_type" required>
        <option value="">-- Select Lab Type --</option>
        <option value="Microbiological">Microbiological</option>
        <option value="Chemical">Chemical</option>
        <option value="Others">Others</option>
    </select>


    <div id="parameters-container">
        <!-- Template row -->
        <div class="parameter-row">
            <input type="text" name="parameters[0][name_en]"  placeholder="Param Name EN" required>
            <input type="text" name="parameters[0][name_kh]" placeholder="Param Name KH" required>
            <input type="text" name="parameters[0][formular]" placeholder="Formular">
            <input type="text" name="parameters[0][criteria_operator]" placeholder="Criteria Operator" required>
            <input type="number" name="parameters[0][criteria_value1]" placeholder="Criteria value1" required>
            <input type="number" name="parameters[0][criteria_value2]" placeholder="Criteria value2">
            <input type="text" name="parameters[0][unit]" placeholder="Unit" required>
            <input type="text" name="parameters[0][LOQ]" placeholder="LOQ">
            <input type="text" name="parameters[0][method]" placeholder="Method" >
        </div>
    </div>

    <button type="button" id="add-parameter">Add Parameter</button>
    <button type="submit">Create Standard</button>
</form>

<script>
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

</script>
