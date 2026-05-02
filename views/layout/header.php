<?php $role_id = $role_id ?? currentRole(); ?>
<header class="header">
    <div class="header_nav">
        <ul class="header_nav_list">
            <li class="header_nav_list_li"><a href="index.php?page=dashboard">Accueil</a></li>
            <li class="header_nav_list_li"><a href="index.php?page=search_user">Rechercher utilisateur</a></li>
            <?php if ($role_id === 2 || $role_id === 3): ?>
                <li class="header_nav_list_li"><a href="index.php?page=edit_user">Modifier utilisateur</a></li>
            <?php endif; ?>
            <?php if ($role_id === 3): ?>
                <li class="header_nav_list_li"><a href="index.php?page=create_delete_user">Créer/supprimer Utilisateur</a></li>
                <li class="header_nav_list_li"><a href="index.php?page=history">Historique actions</a></li>
            <?php endif; ?>
            <li class="header_nav_list_li"><a href="index.php?page=logout">Se déconnecter</a></li>
        </ul>
    </div>
</header>
