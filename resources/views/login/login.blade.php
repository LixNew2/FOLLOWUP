<head>
    <title></title>
    <meta charset="utf-8">
    <style>
        /* Conteneur principal */
        .form-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Titre du formulaire */
        .form-title {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Groupe de formulaire */
        .form-group {
            margin-bottom: 20px;
        }

        /* Labels */
        label {
            font-size: 1.1rem;
            color: #34495e;
            display: block;
            margin-bottom: 5px;
        }

        /* Champs de texte */
        .form-input {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        /* Focus des champs */
        .form-input:focus {
            border-color: #34495e;
            outline: none;
        }

        /* Bouton de soumission */
        .btn-submit {
            background-color: #e74c3c;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Hover du bouton */
        .btn-submit:hover {
            background-color: #c0392b;
        }

        /* Transition pour les effets */
        .btn-submit,
        .form-input {
            transition: all 0.3s ease-in-out;
        }

    </style>
</head>
<body>
<div class="form-container">
    <h1 class="form-title">Se connecter</h1>
    <form action="{{ route('login.con') }}" method="POST" class="incident-form">
        @csrf
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="text" name="email" id="email" class="form-input" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" class="form-input" placeholder="Mot de passe">
        </div>
        <button type="submit" class="btn-submit">Se connecter</button>
    </form>
</div>
</body>
