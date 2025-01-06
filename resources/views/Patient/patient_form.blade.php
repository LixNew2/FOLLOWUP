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

        .form-input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
            margin-right: 10px;
        }

        .form-input:focus {
            border-color: #34495e;
            outline: none;
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
        <h1 class="form-title">Ajouter un Patient</h1>
        <form action='{{ route('patient.add') }}' method='POST' class="patient-form">
            @csrf
            <div class="form-group">
                <label for="name">Nom :</label>
                <input type="text" id="name" name="name" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="date_naiss">Date de naissance :</label>
                <input type="date" id="date_naiss" name="date_naiss" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" class="form-input" pattern="^[A-z-a-z]+@(gmail|outlook|orange|wanadoo)\.(com|fr|eu)$" required>
            </div>
            <div class="form-group">
                <label for="age_depistage_surdite">Age dépisatage surdité :</label>
                <input type="number" id="age_depistage_surdite" name="age_depistage_surdite" class="form-input" min="0" max="120" required>
            </div>
            <button type="submit" class="btn-submit">Ajouter</button>
        </form>
    </div>
@stop
