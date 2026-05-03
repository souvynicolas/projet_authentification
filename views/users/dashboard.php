<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<body class="body_dashboard">
    <?php require __DIR__ . '/../layout/header.php'; ?>
    <main class="main_dashboard">
        <div class="table_container dashboard">
            <?php displayUsersTable($users); ?>
        </div>
        <div><?php displayErrors($errors ?? []); ?></div>
        <form class="form_dashboard" method="POST" action="index.php?page=dashboard">
            <input type="hidden" name="d_create_id" data-create_id id="d_create_id">
            <input type="hidden" name="d_login" id="d_login">
            <?php if (!empty($autroles)): ?>
                <button type="submit" name="btn_enable">Activer</button>
                <button type="submit" name="btn_disable">Désactiver</button>
            <?php endif; ?>
        </form>
    </main>
    <script src="assets/javascript.js"></script>
</body>
</html>
