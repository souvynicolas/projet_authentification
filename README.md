# 🔐 Projet Authentification

Deuxième projet réalisé dans le cadre de l’épreuve E6.

Application web d’authentification développée avec PHP, MySQL, HTML, CSS et JavaScript.

---

## 🚀 Description

Ce projet permet de gérer un système d’authentification avec différents utilisateurs et rôles.

Il permet :

- la connexion utilisateur
- la gestion des utilisateurs
- la gestion des rôles
- le suivi des actions (logs)

---

## 🛠️ Technologies utilisées

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- XAMPP
- phpMyAdmin

---

## ✨ Fonctionnalités

- Connexion utilisateur
- Création d’utilisateurs
- Modification d’utilisateurs
- Suppression d’utilisateurs
- Gestion des rôles
- Historique des actions
- Journalisation des événements

---

## 🌍 Site en ligne

Le projet est disponible ici :

```txt
https://projet1_authentification.nicolassweb.fr



## ⚙️ Installation en local

### 1. Installer XAMPP

* Télécharger XAMPP : https://www.apachefriends.org/fr/index.html
* Installer le logiciel (laisser les options par défaut)
* Lancer le **XAMPP Control Panel**
* Démarrer :

  * **Apache**
  * **MySQL**

---

### 2. Cloner le projet

```bash
git clone https://github.com/souvynicolas/projet_authentification.git
```

---

### 3. Placer le projet

Déplacer le dossier dans :

```txt
C:\xampp\htdocs
```

---

### 4. Importer la base de données avec phpMyAdmin

#### Étape 1 : Ouvrir phpMyAdmin

Dans votre navigateur :

```txt
http://localhost/phpmyadmin
```

---

#### Étape 2 : Créer une base de données

* Cliquer sur **"Nouvelle base de données"** (à gauche ou en haut)
* Donner un nom à la base : `projet_authentification`
* Cliquer sur **Créer**

---

#### Étape 3 : Importer le fichier `.sql`

* Cliquer sur la base que vous venez de créer
* Aller dans l’onglet **"Importer"**
* Cliquer sur **"Choisir un fichier"**
* Sélectionner le fichier `authentification_test.sql` présent dans le projet
* Cliquer sur **Exécuter**

👉 Si tout se passe bien, les tables apparaissent

---

### 5. Configurer la connexion à la base de données

Dans le projet, ouvrir le fichier de connexion (ex : `config.php`) et vérifier :

```php
$host = "localhost";
$user = "root";
$password = ""; // mettre votre mot de passe si vous en avez un
$database = authentification_test"; // nom de la base créée
```

---

### 6. Lancer le projet

Dans votre navigateur :

```txt
http://localhost/projet_authentification
```

---
