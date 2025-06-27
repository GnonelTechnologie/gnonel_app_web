<!DOCTYPE html>
<html>

<head>
    <title>Test Email</title>
</head>

<body>
    <h1>Bonjour Mr {{ $data['name'] }}!</h1>
    <p>Votre compte a bien été créé.</p>
    <p>Merci de vous connecter à partir de lien : {{ $data['link'] }}</p>
    <p>Merci, L'équipe GNONEL!</p>
</body>

</html>
