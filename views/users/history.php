<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/style.css">
    <title>Historique</title>
</head>
<body>
    <?php require __DIR__ . '/../layout/header.php'; ?>
    <main class="history_main">
        <?php displayUsersTable($action_logs); ?>
        <form class="history_form" action="index.php" method="GET">
            <input type="hidden" name="page" value="history">
            <div>
                <label for="h_date_start">Date de création de :</label>
                <input type="datetime-local" name="h_date_start" id="h_date_start" value="<?= htmlspecialchars(str_replace(' ', 'T', (string)$h_date_start)) ?>">
                 </div>
                  <div>
                <label for="h_date_end">à:</label>
                <input type="datetime-local" name="h_date_end" id="h_date_end" value="<?= htmlspecialchars(str_replace(' ', 'T', (string)$h_date_end)) ?>">
            </div>
            <div>
                <label for="h_action">action</label>
                <?php displayActionSelect(getPDO()); ?>
            </div>
            <div>
                <label for="h_createur">Créateur</label>
                <input type="text" name="h_createur" id="h_createur" value="<?= htmlspecialchars((string)$h_createur) ?>">
            </div>
            <div>
                <label for="h_login">Login</label>
                <input type="text" name="h_login" id="h_login" value="<?= htmlspecialchars((string)$h_login) ?>">
            </div>
            <button type="submit">Rechercher</button>
        </form>
        <?php displayErrors($errors ?? []); ?>
    </main>
</body>
</html>
