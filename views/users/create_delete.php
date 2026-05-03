<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer / supprimer utilisateur</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body class="body_create">
    <?php require __DIR__ . '/../layout/header.php'; ?>
    <div><?php displayErrors($errors ?? []); ?></div>
    <main class="main_create">
        <div><?php displayUsersTable($users); ?></div>
        <form action="index.php?page=create_delete_user" method="POST" id="tableau" autocomplete="on" class="create_form">
            <input type="hidden" name="create_id" data-create_id id="create_id">
            <input type="hidden" name="confirm_delete" id="confirm_delete" value="0">
            <div>
                <label for="create_name">Prénom</label>
                <input type="text" name="create_name" id="create_name" value="" data-create_name>
            </div>
            <div>
                <label for="create_surname">Nom</label>
                <input type="text" name="create_surname" id="create_surname" value="" data-create_surname>
            </div>
            <div>
                <label for="create_login">Login</label>
                <input type="text" name="create_login" id="create_login" value="" data-create_login>
            </div>
            <div>
                <label for="create_mail">Email</label>
                <input type="email" name="create_mail" id="create_mail" value="" data-create_mail>
            </div>
            <div>
                <label for="create_password">Mot de passe</label>
                <input type="password" name="create_password" id="create_password" value="" data-create_password>
            </div>
            <div>
                <label for="create_verify_password">Vérification mot de passe</label>
                <input type="password" name="create_verify_password" id="create_verify_password" value="" data-create_verify_password>
            </div>
            <div>
                <label for="role">Rôle</label>
                <?php displayRoleSelect(getPDO(), $role_id); ?>
            </div>
            <button class="create_form_button" type="submit" id="btn_create" name="btn_create">créer</button>
            <button class="create_form_button" type="submit" id="btn_delete" name="btn_delete" data-button_delete>supprimer</button>
            <div id="confirm_box">
                <div><p>Êtes-vous sûr de vouloir supprimer cet utilisateur ?</p></div>
                <div class="confirm_box_button">
                    <button type="button" id="btn_confirm" name="btn_confirm">Oui</button>
                    <button type="button" id="btn_cancel" name="btn_cancel">Non</button>
                </div>
            </div>
        </form>
    </main>
    
    <script src="assets/javascript.js"></script>
</body>
</html>
