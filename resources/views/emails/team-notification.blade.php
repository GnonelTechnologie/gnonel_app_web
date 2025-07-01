<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ajouté à une équipe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Vous avez été ajouté à une équipe</h1>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $team->member->name }},</p>
        
        <p><strong>{{ $owner->name }}</strong> vous a ajouté à son équipe <strong>"{{ $team->team_name }}"</strong> sur la plateforme GNONEL.</p>
        
        <p>Vous pouvez maintenant :</p>
        <ul>
            <li>Accéder à l'espace équipe</li>
            <li>Collaborer avec les autres membres</li>
            <li>Partager des références et spécifications</li>
            <li>Bénéficier des fonctionnalités selon la souscription de l'équipe</li>
        </ul>
        
        <div style="text-align: center;">
            <a href="{{ url('/dashboard') }}" class="button">
                Accéder à mon espace
            </a>
        </div>
        
        <p>Pour accéder à l'équipe, connectez-vous à votre compte et vous verrez la liste de vos équipes dans votre profil.</p>
        
        <p>Cordialement,<br>
        L'équipe GNONEL</p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Veuillez ne pas y répondre.</p>
        <p>Si vous ne reconnaissez pas cette action, veuillez contacter le support.</p>
    </div>
</body>
</html> 