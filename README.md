# 🔐 Projet Authentification

Premier projet réalisé dans le cadre de l’épreuve E6.

Application web d’authentification développée avec PHP, MySQL, HTML, CSS et JavaScript.

---

## 🚀 Description

Ce projet permet de gérer un système d’authentification avec une gestion des utilisateurs et rôles associés.

Il permet :

- La connexion utilisateur
- La gestion des utilisateurs (Création,mise à jour,suppression, activation/désactivation,recherche)
- La gestion des rôles
- Le suivi des actions (logs)

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
- Recherche utilisateurs
- Gestion des rôles
- Historique des actions
- Journalisation des événements

---


## doumentation
 synthèse des documents remit dans dossier documentations list_doc.png

## 🌍 Site en ligne

Le projet est disponible ici :

```txt
https://projet1-authentification.nicolassweb.fr

Solution de secours

## ⚙️ Installation en local

### 1. Installer XAMPP

* Télécharger XAMPP : https://www.apachefriends.org/fr/index.html
* Installer le logiciel (laisser les options par défaut)
* Lancer le **XAMPP Control Panel**
* Démarrer :

  * **Apache**
  * **MySQL**

---

### 2. télécharger le dossier

cliquer sur code en haut a droite
download zip
extraire le dossier et renommer le dossier en : projet_authentification
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
* Donner un nom à la base : `authentification_test`
* Cliquer sur **Créer**

---

#### Étape 3 : Importer le fichier `.sql`

* Cliquer sur la base que vous venez de créer
* Aller dans l’onglet **"Importer"**
* Cliquer sur **"Choisir un fichier"**
* Sélectionner le fichier `authentification_test.sql` présent dans le projet
* Cliquer sur **Importer**

👉 Si tout se passe bien, les tables apparaissent

   si erreur remplacer dans fichier gestion_de_stock_test.sql utfm_mb4_0900_ai_ci par utfm_mb4_0900_unicode_ci


### 5. Configurer la connexion à la base de données

Dans le projet, ouvrir le fichier de connexion dans  le dossier config.php database.php et vérifier :

```php
$host = "localhost";
$user = "root";
$password = "";
$database = authentification_test";
```

---

### 6. Lancer le projet

Dans votre navigateur :

```txt
http://localhost/projet_authentification
```

---
