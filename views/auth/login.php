<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body class="login_body">
    <form class="login_form" action="index.php?page=login" method="post" autocomplete="off">
        <?php displayErrors($errors ?? []); ?>
        <div class="login_form_log_pass">
            <div class="login_form_log">
                <label for="login">Login</label>
                <input type="text" name="login" id="login" autocomplete="off">
            </div>
            <div class="login_form_pass">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" autocomplete="off">
            </div>
        </div>
        <div class="login_form_button">
            <button type="submit">Se connecter</button>
        </div>
    </form>
</body>
</html>
