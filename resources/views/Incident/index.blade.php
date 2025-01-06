@extends('layout.app')

@section('content')
    <style>
        .incident-list-container {
            margin-top: 20px;
            display: flex;
            justify-content: center;
        }

        .incident-table {
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

        #incident_table_header th {
            background-color: #34495e;
            color: white;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
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

        .show-off{
            display: None;
        }

        .incident-row {
            cursor: pointer;
        }

        .incident-row:hover {
            background-color: #f0f0f0;
        }

        /* Style pour la barre de recherche */
        #search_bar {
            width: 300px; /* Largeur de la barre de recherche */
            padding: 10px; /* Espacement intérieur */
            border: 1px solid #ddd; /* Bordure grise */
            border-radius: 5px; /* Coins arrondis */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre légère */
            font-size: 1rem; /* Taille de la police */
            margin-right: 10px; /* Espacement à droite */
            transition: border-color 0.3s; /* Transition douce pour la couleur de la bordure */
        }

        #search_bar:focus {
            border-color: #3498db; /* Couleur de bordure au focus */
            outline: none; /* Supprimer l'outline par défaut */
        }

        /* Style pour le sélecteur de recherche */
        #search_type {
            padding: 10px; /* Espacement intérieur */
            border: 1px solid #ddd; /* Bordure grise */
            border-radius: 5px; /* Coins arrondis */
            background-color: white; /* Couleur de fond */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre légère */
            font-size: 1rem; /* Taille de la police */
            cursor: pointer; /* Curseur en forme de main */
            transition: border-color 0.3s; /* Transition douce pour la couleur de la bordure */
        }

        #search_type:focus {
            border-color: #3498db; /* Couleur de bordure au focus */
            outline: none; /* Supprimer l'outline par défaut */
        }

        /* Ajout d'un conteneur pour centrer la barre de recherche et le sélecteur */
        .search-container {
            display: flex; /* Flexbox pour aligner les éléments */
            justify-content: center; /* Centrer horizontalement */
            margin-bottom: 20px; /* Espacement en bas */
        }
    </style>
    <div class="incident-list-container">
        <h1 class="page-title">Liste des incidents</h1>
    </div>

    <div class="search-container">
        <input type="text" id="search_bar" oninput="search()" placeholder="Rechercher...">
        <select id="search_type">
            <option value="id">ID</option>
            <option value="desc">Description</option>
            <option value="level">Niveau</option>
            <option value="date">Date</option>
            <option value="id_patient">ID Patient</option>
        </select>
    </div>

    <div class="incident-list-container">
        <table id="incident_table" class="incident-table">
            <thead>
            <tr id="incident_table_header">
                <th onclick="elements_sort(this)">ID</th>
                <th onclick="elements_sort(this)">Description</th>
                <th onclick="elements_sort(this)">Niveau</th>
                <th onclick="elements_sort(this)">Date</th>
                <th onclick="elements_sort(this)">ID Patient</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="table_body">
            @forelse($incidents as $incident)
                <tr class="incident-row">
                    <td>{{$incident->id}}</td>
                    <td>{{$incident->description}}</td>
                    <td>{{$incident->level}}</td>
                    <td>{{$incident->date}}</td>
                    <td>{{$incident->id_patient}}</td>
                    <td>
                        <button id="b1" class="btn-delete" onclick="btn_del({{$incident->id}})">SUPPRIMER</button>
                        <button id="b2" class="btn-edit" onclick="btn_edit({{$incident->id}}, event)">MODIFIER</button>
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
        function search(){
            let search = document.getElementById("search_bar").value.toLowerCase();
            let selected = document.getElementById("search_type").value;
            let incidents = <?php echo json_encode($incidents->toArray()) ?>;

            console.log(search);
            console.log(selected)

            let incidents_list = [];

            incidents.forEach(incident => {
                if(selected === "id"){
                    if(incident.id.toString().includes(search)){
                        incidents_list.push(incident)
                    }
                }else if(selected === "desc"){
                    if(incident.description.toString().toLowerCase().includes(search)){
                        incidents_list.push(incident)
                    }
                }else if(selected === "level"){
                    if(incident.level.toString().toLowerCase().includes(search)){
                        incidents_list.push(incident)
                    }
                }else if(selected === "date"){
                    if(incident.date.toString().toLowerCase().includes(search)){
                        incidents_list.push(incident)
                    }
                }else{
                    if(incident.id_patient.toString().toLowerCase().includes(search)){
                        incidents_list.push(incident)
                    }
                }
            })

            display(incidents_list);
        }


        function elements_sort(header){
            let value = header.innerText.toLowerCase()

            let incidents = <?php echo json_encode($incidents->toArray()) ?>;
            if(value === "description"){
                incidents.sort((a, b) => a.description.localeCompare(b.description));
                display(incidents);
            }else if(value === "niveau"){
                incidents.sort((a, b) => a.level - b.level);
                display(incidents);
            }else if(value === "date"){
                incidents.sort((a, b) => a.date.localeCompare(b.date));
                display(incidents);
            }else if(value === "id"){
                incidents.sort((a, b) => a.id - b.id);
                display(incidents);
            }else if(value === "id patient"){
                incidents.sort((a, b) => a.id_patient - b.id_patient);
                display(incidents);
            }else {
                console.log("Bad colomn !");
            }
        }

        function display(incidents){
            let rows = document.querySelectorAll("#incident_table td");

            //Clear the table
            rows.forEach(row => {
                row.remove();
            })

            let body = document.getElementById("table_body");
            incidents.forEach(incident => {
                let tr = document.createElement('tr');
                tr.classList.add('incident-row')

                let td_id = document.createElement('td');
                td_id.innerHTML = incident.id;
                tr.appendChild(td_id);

                for(let i = 0; i<3; i++){
                    var td = document.createElement('td');
                    if(i === 0){
                        td.innerHTML = incident.description;
                    }else if(i === 1){
                        td.innerHTML = incident.level;
                    }else if(i === 2){
                        td.innerHTML = incident.date;
                    }

                    tr.appendChild(td);
                }

                var id = document.createElement('td');
                id.innerHTML = incident.id_patient;
                tr.appendChild(id);

                var td_btn = document.createElement('td');
                for(let i = 0; i<2; i++){
                    let btn = document.createElement('button');
                    btn.id = i+1;

                    if(i === 0){
                        btn.classList.add('btn-delete');
                        btn.addEventListener('click', function() {
                            btn_del(incident.id);
                        });
                        btn.innerHTML = "SUPPRIMER";
                    }else{
                        btn.classList.add('btn-edit');
                        btn.addEventListener('click', function() {
                            btn_edit(incident.id);
                        });
                        btn.innerHTML = "MODIFIER";
                    }

                    td_btn.appendChild(btn);
                }
                tr.appendChild(td_btn);
                body.appendChild(tr);
            })
        }

        function btn_del(id){
            if (confirm('Êtes-vous sûr de vouloir supprimer cet incident ?')) {
                window.location.href = `/incident/${id}`;
            }
        }

        function btn_edit(id, event) {
            // Get the closest table row from the event target
            const row = event.target.closest('tr');
            var base_values = [];

            // Loop through the first three cells of the row
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

                    // Store the original cell value and clear the cell
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
                    // Save button onclick handler
                    btn.onclick = function () {
                        const i1 = document.querySelector("#i1").value;
                        const i2 = document.querySelector("#i2").value;
                        const i3 = document.querySelector("#i3").value;
                        window.location.href = `/incident/${id}/${i1}/${i2}/${i3}`;
                    };
                } else {
                    // Cancel button onclick handler
                    btn.onclick = function () {
                        // Get the delete and edit buttons
                        const btn_sup = row.cells[5].querySelector('#b1');
                        const btn_edit = row.cells[5].querySelector('#b2');
                        const _b1 = row.cells[5].querySelector('#_b0');
                        const _b2 = row.cells[5].querySelector('#_b1');

                        // Show the delete and edit buttons
                        btn_sup.classList.add('btn-delete');
                        btn_edit.classList.add('btn-edit');
                        btn_sup.classList.remove('show-off');
                        btn_edit.classList.remove('show-off');

                        // Remove the save and cancel buttons
                        _b1.remove();
                        _b2.remove();

                        // Restore the original cell values
                        for (i = 1; i < 4; i++) {
                            row.cells[i].innerHTML = "";
                            row.cells[i].innerHTML = base_values[i - 1];
                        }
                    };
                }

                // Append the save and cancel buttons to the cell
                row.cells[5].appendChild(btn);
            }

            // Hide the delete and edit buttons
            const btn_sup = row.cells[5].querySelector('#b1');
            const btn_edit = row.cells[5].querySelector('#b2');

            btn_sup.classList.add('show-off');
            btn_edit.classList.add('show-off');
        }
    </script>
@stop
