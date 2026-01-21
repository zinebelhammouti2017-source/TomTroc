# TomTroc – Projet 4 OpenClassrooms (Option B)

## Présentation
TomTroc est un site de mise en relation entre lecteurs permettant l’échange de livres.

Ce projet a été réalisé dans le cadre du **Projet 4 OpenClassrooms – Option B (scénario fictif)**.
Il s’agit d’un **MVP** (première version fonctionnelle) développé en **PHP natif**, avec une architecture **MVC**, sans framework PHP.

---

## Fonctionnalités principales
- Inscription et connexion des utilisateurs
- Page « Mon compte » : profil + bibliothèque personnelle
- Gestion des livres (CRUD) : ajouter, modifier, supprimer
- Upload d’images pour les livres (sécurisé)
- Page « Nos livres à l’échange » : liste + recherche par titre
- Page détail d’un livre + bouton « Envoyer un message »
- Messagerie interne (conversations + lecture + envoi)
- Page 404 personnalisée

---

## Architecture du projet (MVC)
- **Controllers/** : gestion des actions et navigation
- **models/** : accès aux données et requêtes SQL (PDO)
- **services/** : logique métier (upload, livres, messagerie)
- **views/** : affichage (header/footer factorisés)
- **public/** : point d’entrée + assets (CSS, images, uploads)

---

## Sécurité
- Requêtes préparées **PDO**
- Protection XSS avec `htmlspecialchars`
- Contrôle d’accès par session
- Upload d’images sécurisé :
  - contrôle erreurs PHP
  - limite de taille
  - vérification type MIME
  - nom unique
  - chemin stocké en base

---

## Prérequis
- PHP 8+
- MySQL
- Serveur local (XAMPP / WAMP / MAMP)

---

## Installation en local

### Cloner le dépôt

1. Cloner le projet
2. Configurer le fichier `config/bdd.php` à partir de `bdd.exemple.php`
3. Importer la base de données (Importer le fichier sql/sitetomtroc.sql dans phpMyAdmin.)
4. Lancer le projet via un serveur local (XAMPP)

```bash
git clone https://github.com/zinebelhammouti2017-source/TomTroc.git
