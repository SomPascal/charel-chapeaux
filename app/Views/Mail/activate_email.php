<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charel Chapeau</title>
</head>
<body>
    <h1>Hi <?= esc($user->username) ?></h1>
    <p>Votre code est: <?= esc($code) ?></p>
</body>
</html>