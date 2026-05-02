<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <title>Modifier utilisateur</title>
</head>
<body class="body_edit">
    <?php require __DIR__ . '/../layout/header.php'; ?>
    <main class="edit_main">
        <div><?php displayUsersTable($users); ?></div>
        <form action="index.php?page=edit_user" class="edit_form" method="POST" id="tableau">
            <input type="hidden" name="id" data-id id="id">
            <div>
                <label for="name">Prénom</label>
                <input class="edit_input_name" type="text" name="name" id="name" value="" data-name>
            </div>
            <div>
                <label for="surname">Nom</label>
                <input type="text" class="edit_input_surname" name="surname" id="surname" value="" data-surname>
            </div>
            <div>
                <label class="edit_form_mail_label" for="mail">Email</label>
                <input class="edit_input_mail" type="email" name="mail" id="mail" value="" data-mail>
            </div>
            <div>
                <label for="login">Login</label>
                <input class="edit_input_login" type="text" name="login" id="login" value="" data-login>
            </div>
            <div>
                <label for="role">Rôle</label>
                <?php displayRoleSelect(getPDO(), $role_id); ?>
            </div>
            <button type="submit" id="bt_modify" class="edit_form_button">Modifier</button>
        </form>
    </main>
    <?php displayErrors($errors ?? []); ?>
    <script src="assets/javascript.js"></script>
</body>
</html>
