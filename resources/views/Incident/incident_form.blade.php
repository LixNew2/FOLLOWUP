@extends('layout.app')

@section('content')
    <style>
        .form-container {
            max-width: 500px;
            margin: 100px auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-title {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 1.2rem;
            color: #34495e;
            display: block;
            margin-bottom: 5px;
        }

        .form-input{
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
            margin-right: 10px;
        }

        .form-select {
            width: 500px;
            height: 40px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
            margin-right: 10px;
        }

        .form-input:focus,
        .form-select:focus {
            border-color: #34495e;
            outline: none;
        }

        #desc {
            height: 160px;
            resize: none;
        }

        .btn-submit {
            background-color: #e74c3c;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #c0392b;
        }
    </style>

    <div class="form-container">
        <h1 class="form-title">Ajouter un Incident</h1>
        <form action='{{ route('incident.add') }}' method='POST' class="incident-form">
            @csrf

            <div class="form-group">
                <label for="patient_select">Patient :</label>
                <select id="patient_select" name="patient_select" class="form-select" required>
                    @foreach($patients as $patient)
                        <option value="{{$patient->id}}">{{$patient->nom}} {{$patient->prenom}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="desc">Description :</label>
                <textarea id="desc" name="desc" class="form-input" placeholder="Décrivez l'incident ici..." required></textarea>
            </div>

            <div class="form-group">
                <label for="level_select">Niveau de gravité :</label>
                <select id="level_select" name="level_select" class="form-select" required>
                    <option value="1">FAIBLE</option>
                    <option value="2">MOYEN</option>
                    <option value="3">GRAND</option>
                </select>
            </div>

            <div class="form-group">
                <label for="date_incident">Date :</label>
                <input type="date" id="date_incident" name="date_incident" class="form-input" placeholder="Choisissez une date" required>
            </div>

            <button type="submit" class="btn-submit">Ajouter</button>
        </form>
    </div>
@stop
