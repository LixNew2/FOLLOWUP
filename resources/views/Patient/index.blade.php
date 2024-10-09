@extends('layout.app')

@section('content')
    <style>
        .patient-list-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .patient-table {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
        }

        .page-title {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        #patient_table_header th {
            background-color: #34495e;
            color: white;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .patient-row td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .no-patients {
            text-align: center;
            color: #e74c3c;
        }

        .btn-delete {
            background-color: #e74c3c;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-delete:hover {
            background-color: #c0392b;
        }

        .btn-edit {
            background-color: #f39c12;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-edit:hover {
            background-color: #e67e22;
        }

        .btn-view {
            background-color: #3498db;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-view:hover {
            background-color: #2980b9;
        }

        .btn-save {
            background-color: #28a745;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-save:hover {
            background-color: #218838;
        }

        .btn-cancel {
            background-color: #dc3545;
            color: white;
            padding: 8px 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-cancel:hover {
            background-color: #c82333;
        }

        .show-off {
            display: none;
        }

        .patient-row {
            cursor: pointer;
        }

        .patient-row:hover {
            background-color: #f0f0f0;
        }
    </style>


    <div class="patient-list-container">
        <h1 class="page-title">Liste des patients</h1>
    </div>

    <div class="patient-list-container">
        <table id="patient_table" class="patient-table">
            <thead>
            <tr id="patient_table_header">
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Date de Naissance</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($patients as $patient)
                <tr class="patient-row">
                    <td>{{$patient->id}}</td>
                    <td>{{$patient->nom}}</td>
                    <td>{{$patient->prenom}}</td>
                    <td>{{$patient->dateNaissance}}</td>
                    <td>
                        <button id="b1" class="btn-delete" onclick="btn_del({{$patient->id}})">SUPPRIMER</button>
                        <button id="b2" class="btn-edit" onclick="btn_edit({{$patient->id}}, event)">MODIFIER</button>
                        <button id="b3" class="btn-view" onclick="btn_view({{$patient->id}})">VOIR</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="no-patients">Aucun patient enregistré.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <script>
        // Select all rows in the table body with the id 'patient_table'
        document.querySelectorAll('#patient_table tbody tr').forEach(row => {
            // Add a double-click event listener to each row
            row.addEventListener('dblclick', function() {
                // Get the id from the first cell of the row
                const id = this.cells[0].innerText;
                // Redirect to the patient specific page with the id
                window.location.href = `/patient_spec/${id}`;
            });
        });

        // Function to delete a patient
        function btn_del(id){
            // Confirm the deletion
            if (confirm('Êtes-vous sûr de vouloir supprimer ce patient ?')) {
                // Redirect to the delete patient URL
                window.location.href = `/patient/${id}`;
            }
        }

        // Function to view patient details
        function btn_view(id){
            // Redirect to the patient specific page with the id
            window.location.href = `/patient_spec/${id}`;
        }

        // Function to edit patient details
        function btn_edit(id, event){
            // Get the closest row to the event target
            const row = event.target.closest('tr');
            // Array to store the original values
            var base_values = [];

            // Loop through the first three cells to create input fields
            for(i = 1; i<4; i++){
                const input = document.createElement('input');
                // Set input type based on the cell index
                input.type = (i !== 3) ? "text" : "date";
                // Set input value to the cell's innerHTML
                input.value = row.cells[i].innerHTML;
                // Set input id
                input.id = "i"+i;

                // Store the original value
                base_values.push(row.cells[i].innerHTML);
                // Clear the cell's innerHTML
                row.cells[i].innerHTML = "";

                // Append the input to the cell
                row.cells[i].appendChild(input);
            }

            // Array of button text and class pairs
            const btns_text = [
                ["SAUVEGARDER", "btn-save"], ["ANNULER", "btn-cancel"]
            ];

            // Loop to create save and cancel buttons
            for(i = 0; i<2; i++){
                const btn = document.createElement("button");
                // Set button text content
                btn.textContent = btns_text[i][0];
                // Add class to the button
                btn.classList.add(btns_text[i][1]);
                // Set button id
                btn.id = "_b"+i;

                if(i===0){
                    // Save button onclick event
                    btn.onclick = function(){
                        // Get values from the input fields
                        const i1 = document.querySelector("#i1").value;
                        const i2 = document.querySelector("#i2").value;
                        const i3 = document.querySelector("#i3").value;
                        // Redirect to the update patient URL with the new values
                        window.location.href = `/patient/${id}/${i1}/${i2}/${i3}`;
                    }
                }else{
                    // Cancel button onclick event
                    btn.onclick = function(){
                        // Get the original buttons
                        const btn_sup = row.cells[4].querySelector('#b1');
                        const btn_edit = row.cells[4].querySelector('#b2');
                        const btn_view = row.cells[4].querySelector('#b3');
                        const _b1 = row.cells[4].querySelector('#_b0');
                        const _b2 = row.cells[4].querySelector('#_b1');

                        // Show the original buttons
                        btn_sup.classList.add('btn-delete');
                        btn_edit.classList.add('btn-edit');
                        btn_view.classList.add('btn-view');
                        btn_sup.classList.remove('show-off');
                        btn_edit.classList.remove('show-off');
                        btn_view.classList.remove('show-off');

                        // Remove the save and cancel buttons
                        _b1.remove();
                        _b2.remove();

                        // Restore the original cell values
                        for(i = 1; i<4; i++){
                            row.cells[i].innerHTML = "";
                            row.cells[i].innerHTML = base_values[i-1];
                        }
                    }
                }

                // Append the button to the cell
                row.cells[4].appendChild(btn);
            }

            // Get the original buttons
            const btn_sup = row.cells[4].querySelector('#b1');
            const btn_edit = row.cells[4].querySelector('#b2');
            const btn_view = row.cells[4].querySelector('#b3');

            // Hide the original buttons
            btn_sup.classList.add('show-off');
            btn_edit.classList.add('show-off');
            btn_view.classList.add('show-off');
        }
    </script>
@stop
