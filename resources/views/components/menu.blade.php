<style>
    body {
        font-family: 'Helvetica Neue', Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    #menu {
        background-color: rgb(44, 62, 80);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 60px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    #menu a {
        color: white;
        text-decoration: none;
        display: inline-block;
        padding: 10px 20px;
        margin: 0 10px;
        font-size: 16px;
        font-weight: bold;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    #menu a:hover {
        background-color: #e74c3c;
        transform: translateY(-2px);
        letter-spacing: 1px;
    }

    #menu a:last-child {
        margin-right: 0;
    }
</style>
<body>
    <div id="menu">
        <a href="/login">Se Connecter</a>
        <a href="/" id="btn1">Home</a>
        <a href="/patient">Patients</a>
        <a href="/incident">Incidents</a>
        <a href="/patient_form">Ajouter un patient</a>
        <a href="/incident_form">Ajouter un incident</a>
    </div>
</body>

