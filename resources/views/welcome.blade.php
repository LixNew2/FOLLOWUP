@extends("layout.app")

@section("content")
    <style>
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 40px;
            text-align: center;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            border-bottom: 5px solid #34495e;
        }

        .header h1 {
            font-size: 40px;
            font-weight: bold;
            margin: 0;
        }

        .header p {
            font-size: 20px;
            margin: 10px 0 0 0;
        }

        .content {
            margin: 40px auto;
            max-width: 1200px;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            line-height: 1.8;
        }

        .content h2 {
            font-size: 30px;
            margin-bottom: 20px;
            color: #34495e;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }

        .content p {
            font-size: 18px;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .content ul {
            list-style-type: none;
            margin-left: 0;
            padding-left: 0;
        }

        .content ul li {
            padding-left: 30px;
            position: relative;
            font-size: 18px;
        }

        .content ul li:before {
            content: '✔';
            color: #2c3e50;
            font-weight: bold;
            position: absolute;
            left: 0;
            font-size: 20px;
        }

        .highlight {
            background-color: #f1f8ff;
            border-left: 6px solid #e74c3c;
            padding: 20px;
            margin: 30px 0;
            font-size: 18px;
            border-radius: 8px;
        }

        .highlight p {
            margin: 0;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #2c3e50;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #34495e;
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 30px;
            }

            .header p {
                font-size: 18px;
            }

            .content {
                padding: 0 20px;
            }

            .content h2 {
                font-size: 24px;
            }

            .content p,
            .content ul li {
                font-size: 16px;
            }
        }
    </style>
    <div class="header">
        <h1>Bienvenue chez FollowUP</h1>
        <p>Une application innovante pour le suivi des patients implantés cochléaires.</p>
    </div>

    <div class="content">
        <h2>À propos de FollowUP</h2>
        <p>FollowUP est une application Web dédiée au suivi des patients implantés cochléaires au Centre Hospitalier Universitaire (CHU) de Montpellier. Notre objectif est de fournir une solution complète pour améliorer le suivi des implants et des incidents liés, en conformité avec les recommandations de la Haute Autorité de Santé (HAS).</p>

        <div class="highlight">
            <p><strong>Chaque année, environ 1 500 implants cochléaires sont posés en France.</strong> Le projet FollowUP assure un suivi détaillé de ces implants pour garantir une meilleure prise en charge des patients tout au long de leur parcours de soins.</p>
        </div>

        <h2>Objectifs de FollowUP</h2>
        <ul>
            <li>Assurer un suivi personnalisé des patients implantés cochléaires.</li>
            <li>Gérer efficacement les incidents et les réglages des implants.</li>
            <li>Mettre en place des indicateurs de qualité pour la prise en charge des patients.</li>
            <li>Améliorer la communication entre les professionnels de santé grâce à la télémédecine.</li>
        </ul>

        <h2>Principaux défis</h2>
        <p>Face à la croissance du nombre de patients implantés, FollowUP répond aux défis suivants :</p>
        <ul>
            <li>Offrir un service de qualité à une cohorte croissante de patients.</li>
            <li>S'assurer de la satisfaction des patients et de l'efficacité des soins.</li>
            <li>Maintenir un registre exhaustif des incidents pour améliorer la prise en charge.</li>
        </ul>

        <h2>Implants cochléaires</h2>
        <p>Les implants cochléaires permettent aux personnes atteintes de surdité sévère à profonde de retrouver progressivement l'audition. FollowUP joue un rôle clé dans le suivi post-implantation en offrant une solution de gestion des incidents et des réajustements nécessaires pour optimiser l'usage des implants.</p>
    </div>
@stop
