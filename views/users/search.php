<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche utilisateur</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body>
    <?php require __DIR__ . '/../layout/header.php'; ?>
    <main class="main_search">
        <div><?php displayUsersTable($users); ?></div>
        <form action="index.php" class="search_form" method="GET">
            <input type="hidden" name="page" value="search_user">
            <div class="search_form_name_surname">
                <label for="name">Prénom</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars((string)$name) ?>">
            </div>
            <div>
                <label for="surname">Nom</label>
                <input type="text" name="surname" id="surname" value="<?= htmlspecialchars((string)$surname) ?>">
            </div>
            <div class="search_form_mail_login">
                <label for="mail">Email</label>
                <input type="email" name="mail" id="mail" value="<?= htmlspecialchars((string)$mail) ?>">
            </div>
            <div>
                <label for="login">Login</label>
                <input type="text" name="login" id="login" value="<?= htmlspecialchars((string)$login) ?>">
            </div>
            <div>
                <label for="h_action">Rôle</label>
                <?php displayRoleSearchSelect(getPDO()); ?>
            </div>
            <button class="search_form_button" type="submit">rechercher</button>
        </form>
    </main>
</body>
</html>
