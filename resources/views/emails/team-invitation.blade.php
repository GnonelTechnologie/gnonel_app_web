<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invitation à rejoindre une équipe</title>
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
            background-color: #007bff;
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
            background-color: #28a745;
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
        <h1>Invitation à rejoindre une équipe</h1>
    </div>
    
    <div class="content">
        <p>Bonjour,</p>
        
        <p><strong>{{ $owner->name }}</strong> vous a invité à rejoindre son équipe <strong>"{{ $team->team_name }}"</strong> sur la plateforme GNONEL.</p>
        
        <p>Pour accepter cette invitation et configurer votre compte, veuillez cliquer sur le bouton ci-dessous :</p>
        
        <div style="text-align: center;">
            <a href="{{ url('/teams/configure-account/' . $token) }}" class="button">
                Configurer mon compte
            </a>
        </div>
        
        <p>Ce lien vous permettra de :</p>
        <ul>
            <li>Définir votre mot de passe</li>
            <li>Renseigner vos informations personnelles (nom, prénom, téléphone)</li>
            <li>Accéder à l'équipe et commencer à collaborer</li>
        </ul>
        
        <p><strong>Note :</strong> Ce lien est valide pendant 24 heures. Si vous ne configurez pas votre compte dans ce délai, vous devrez demander une nouvelle invitation.</p>
        
        <p>Cordialement,<br>
        L'équipe GNONEL</p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Veuillez ne pas y répondre.</p>
        <p>Si vous n'êtes pas à l'origine de cette demande, vous pouvez ignorer cet email.</p>
    </div>
</body>
</html> 