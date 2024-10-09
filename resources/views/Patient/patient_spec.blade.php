@extends('layout.app')

@section('content')
    <style>
        .patient-details-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .patient-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }

        .patient-name {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .patient-dob {
            font-size: 1.2rem;
            color: #34495e;
        }

        .incident-section {
            margin-top: 50px;
        }

        .incident-title {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #e74c3c;
            text-align: center;
        }

        .incident-table {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 1000px;
            border-collapse: collapse;
            margin: 0 auto;
        }

        #patient_table_header th {
            background-color: #34495e;
            color: white;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .incident-row:last-child td:first-child {
            border-bottom-left-radius: 10px;
        }

        .incident-row:last-child td:last-child {
            border-bottom-right-radius: 10px;
        }

        .incident-row td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .no-incidents {
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
            display: None;
        }
    </style>


    <div class="patient-details-container">
        <div class="patient-details">
            <h1 class="patient-name">{{$patient->nom}} {{$patient->prenom}}</h1>
            <p class="patient-dob"><strong>Date de naissance :</strong> {{$patient->dateNaissance}}</p>
        </div>
    </div>

    <div class="incident-section">
        <h2 class="incident-title">Incidents</h2>
        <table id="patient_table" class="incident-table">
            <thead>
            <tr id="patient_table_header">
                <th>ID</th>
                <th>Description</th>
                <th>Niveau</th>
                <th>Date</th>
                <th>ID Patient</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($incidents as $incident)
                <tr class="incident-row">
                    <td>{{$incident->id}}</td>
                    <td>{{$incident->description}}</td>
                    <td>{{$incident->level}}</td>
                    <td>{{$incident->date}}</td>
                    <td>{{$incident->id_patient}}</td>
                    <td>
                        <button id="b1" class="btn-delete" onclick="btn_del({{$incident->id}}, {{$incident->id_patient}})">SUPPRIMER</button>
                        <button id="b2" class="btn-edit" onclick="btn_edit({{$incident->id}}, {{$incident->id_patient}}, event)">MODIFIER</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="no-incidents">Aucun incident enregistré.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <script>
        function btn_del(id, patient_id){
            if(confirm('Êtes-vous sûr de vouloir supprimer cet incident ?')) {
                window.location.href = `/incident/${id}/${patient_id}`;
            }
        }
        function btn_edit(id, patient_id, event) {
            // Get the closest table row from the event target
            const row = event.target.closest('tr');
            var base_values = [];

            // Loop through the first three cells (excluding the first cell)
            for (i = 1; i < 4; i++) {
                if (i === 2) {
                    // Create a select element for the second cell
                    const select = document.createElement('select');
                    select.id = "i" + i;

                    // Define the options for the select element
                    const options = [
                        { value: 1, text: "FAIBLE" },
                        { value: 2, text: "MOYEN" },
                        { value: 3, text: "GRAND" }
                    ];

                    // Append options to the select element
                    options.forEach(optionData => {
                        const option = document.createElement('option');
                        option.value = optionData.value;
                        option.text = optionData.text;
                        select.appendChild(option);
                    });

                    // Set the select value to the current cell value and store the original value
                    select.value = row.cells[i].innerHTML;
                    base_values.push(row.cells[i].innerHTML);
                    row.cells[i].innerHTML = "";

                    // Append the select element to the cell
                    row.cells[i].appendChild(select);

                } else {
                    // Create an input element for the first and third cells
                    const input = document.createElement('input');
                    input.type = (i !== 3) ? "text" : "date";
                    input.value = row.cells[i].innerHTML;
                    input.id = "i" + i;

                    // Store the original value and clear the cell
                    base_values.push(row.cells[i].innerHTML);
                    row.cells[i].innerHTML = "";

                    // Append the input element to the cell
                    row.cells[i].appendChild(input);
                }
            }

            // Define the text and classes for the save and cancel buttons
            const btns_text = [
                ["SAUVEGARDER", "btn-save"], ["ANNULER", "btn-cancel"]
            ];

            // Loop to create and append the save and cancel buttons
            for (i = 0; i < 2; i++) {
                const btn = document.createElement("button");
                btn.textContent = btns_text[i][0];
                btn.classList.add(btns_text[i][1]);
                btn.id = "_b" + i;

                if (i === 0) {
                    // Save button onclick event
                    btn.onclick = function () {
                        const i1 = document.querySelector("#i1").value;
                        const i2 = document.querySelector("#i2").value;
                        const i3 = document.querySelector("#i3").value;
                        window.location.href = `/incident_spec/${id}/${patient_id}/${i1}/${i2}/${i3}`;
                    };
                } else {
                    // Cancel button onclick event
                    btn.onclick = function () {
                        const btn_sup = row.cells[5].querySelector('#b1');
                        const btn_edit = row.cells[5].querySelector('#b2');
                        const _b1 = row.cells[5].querySelector('#_b0');
                        const _b2 = row.cells[5].querySelector('#_b1');

                        // Restore the original buttons and remove the save and cancel buttons
                        btn_sup.classList.add('btn-delete');
                        btn_edit.classList.add('btn-edit');
                        btn_sup.classList.remove('show-off');
                        btn_edit.classList.remove('show-off');

                        _b1.remove();
                        _b2.remove();

                        // Restore the original cell values
                        for (i = 1; i < 4; i++) {
                            row.cells[i].innerHTML = "";
                            row.cells[i].innerHTML = base_values[i - 1];
                        }
                    };
                }

                // Append the save and cancel buttons to the last cell
                row.cells[5].appendChild(btn);
            }

            // Hide the original edit and delete buttons
            const btn_sup = row.cells[5].querySelector('#b1');
            const btn_edit = row.cells[5].querySelector('#b2');

            btn_sup.classList.add('show-off');
            btn_edit.classList.add('show-off');
        }
    </script>
@stop
