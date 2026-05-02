<?php

function render(string $view, array $data = []): void
{
    extract($data);
    require __DIR__ . '/../views/' . $view . '.php';
}

function displayErrors(array $errors): void
{
    if (empty($errors)) {
        return;
    }

    echo '<div class="errors"><ul>';
    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars((string)$error) . '</li>';
    }
    echo '</ul></div>';
}

function displayUsersTable(array $users): void
{
    $headers = [
        'id' => 'ID',
        'statut' => 'statut',
        'name' => 'prénom',
        'surname' => 'nom',
        'login' => 'login',
        'mail' => 'email',
        'created_at' => 'date de création',
        'last_login' => 'dernière connexion',
        'role' => 'rôle',
        'roles' => 'rôle',
        'action' => 'action',
        'details' => 'détails',
        'createur' => 'créateur',
        'date de création action' => 'date de création action',
        'dernière connexion' => 'dernière connexion',
    ];

    if (empty($users)) {
        echo '<p>Aucun résultat.</p>';
        return;
    }

    echo '<div class="table_container">';
    echo '<table class="table" id="table">';
    echo '<thead class="table_head"><tr class="table_head_tr">';

    foreach (array_keys($users[0]) as $column) {
        $label = $headers[$column] ?? $column;
        echo '<th class="table_head_th">' . htmlspecialchars((string)$label) . '</th>';
    }

    echo '</tr></thead><tbody class="table_body">';

    foreach ($users as $user) {
        $attributes = '';
        foreach ($user as $key => $data) {
            $attributes .= ' data-' . htmlspecialchars((string)$key) . '="' . htmlspecialchars((string)($data ?? '')) . '"';
        }

        echo "<tr$attributes>";
        foreach ($user as $key => $value) {
            if ($key === 'statut') {
                echo ((int)$value === 1) ? '<td class="td_statut actif"></td>' : '<td class="td_statut inactif"></td>';
            } else {
                echo '<td>' . htmlspecialchars((string)($value ?? '')) . '</td>';
            }
        }
        echo '</tr>';
    }

    echo '</tbody></table></div>';
}

function displayRoleSelect(PDO $pdo, int $currentRole): void
{
    $roles = getAllRoleNames($pdo);

    if ($currentRole === 3) {
        echo '<select name="role" id="role">';
        foreach ($roles as $role) {
            echo '<option value="' . htmlspecialchars((string)$role) . '">' . htmlspecialchars((string)$role) . '</option>';
        }
        echo '</select>';
    } else {
        echo '<input type="text" name="role" id="role" value="" readonly>';
    }
}

function displayRoleSearchSelect(PDO $pdo): void
{
    $roles = getAllRoleNames($pdo);
    echo '<select name="h_action" id="h_action" data-h_action>';
    echo '<option value=""></option>';
    foreach ($roles as $role) {
        echo '<option value="' . htmlspecialchars((string)$role) . '">' . htmlspecialchars((string)$role) . '</option>';
    }
    echo '</select>';
}

function displayActionSelect(PDO $pdo): void
{
    $actions = getDistinctActionNames($pdo);
    echo '<select name="h_action" id="h_action" data-h_action>';
    echo '<option value=""></option>';
    foreach ($actions as $action) {
        echo '<option value="' . htmlspecialchars((string)$action) . '">' . htmlspecialchars((string)$action) . '</option>';
    }
    echo '</select>';
}
