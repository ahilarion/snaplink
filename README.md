# Snaplink - Projet PHP 🚀

## Sommaire 📑

1. [Contexte](#contexte)
2. [Fonctionnalités Principales](#fonctionnalités-principales)
   - [Création de compte 📧🔐](#1-création-de-compte)
   - [Connexion et Déconnexion 🚪](#2-connexion-et-déconnexion)
   - [Liste d'URLs raccourcies 📋](#3-liste-durls-raccourcies)
   - [Raccourcir une URL ✂️](#4-raccourcir-une-url)
   - [Redirection au clic sur une URL raccourcie 🖱️🔗](#5-redirection-au-clic-sur-une-url-raccourcie)
3. [Gestion de Compte](#gestion-de-compte)
   - [Nombre de clics sur un lien 🖱️📊](#1-nombre-de-clics-sur-un-lien)
   - [Désactivation et Suppression d'un lien raccourci 🚫🗑️](#2-désactivation-et-suppression-dun-lien-raccourci)
   - [Stockage de fichiers associés à des URLs raccourcies 📁💾](#3-stockage-de-fichiers-associés-à-des-urls-raccourcies)
4. [Modalités de Réalisation](#modalités-de-réalisation)
5. [Auteurs](#auteurs) 👨‍💻👨‍💻👨‍💻
6. [Démo en ligne](#démo-en-ligne) 🌐

## Contexte

Bienvenue dans le projet Snaplink ! L'objectif de ce projet est de créer un raccourcisseur de liens similaire à des services tels que Bitly ou TinyURL en utilisant PHP. Les raccourcisseurs de liens sont des outils essentiels pour créer des liens plus courts, notamment utilisés dans les réseaux sociaux et les campagnes de communication.

## Fonctionnalités Principales

1. ### Création de compte 📧🔐
   - Les utilisateurs peuvent créer un compte en fournissant une adresse e-mail et un mot de passe.
   - Les mots de passe sont sécurisés grâce à la fonction PHP `password_hash` et vérifiés avec `password_verify`.

2. ### Connexion et Déconnexion 🚪
   - Les utilisateurs peuvent se connecter à leur compte.
   - Ils peuvent également se déconnecter en toute sécurité.

3. ### Liste d'URLs raccourcies 📋
   - Les utilisateurs connectés peuvent afficher la liste de toutes les URLs qu'ils ont précédemment raccourcies.

4. ### Raccourcir une URL ✂️
   - Un formulaire permet aux utilisateurs connectés de saisir une URL à raccourcir.
   - La fonction `random_bytes` est utilisée pour générer des URLs raccourcies aléatoires.

5. ### Redirection au clic sur une URL raccourcie 🖱️🔗
   - Toute personne peut suivre une URL raccourcie et sera redirigée vers la destination initiale.
   - Utilisation des fonctions `http_response_code`, `header`, et des connaissances en HTTP.

## Gestion de Compte

1. ### Nombre de clics sur un lien 🖱️📊
   - Affichage du nombre de clics par URL sur le compte utilisateur.
   - Les clics sont enregistrés dans un stockage externe et mis à jour à chaque utilisation du lien.

2. ### Désactivation et Suppression d'un lien raccourci 🚫🗑️
   - Les utilisateurs peuvent désactiver un lien raccourci existant.
   - Ils ont également la possibilité de supprimer définitivement un lien de leur compte.

3. ### Stockage de fichiers associés à des URLs raccourcies 📁💾
   - Au lieu de soumettre une URL, les utilisateurs peuvent envoyer des fichiers qui seront stockés sur le serveur.
   - Au clic sur le lien, les utilisateurs peuvent télécharger le fichier associé.

## Modalités de Réalisation

- Ce projet doit être réalisé en groupe de 3 à 4 personnes.
- Les détails sur la durée et les modalités de rendu seront spécifiés dans le mail accompagnant ce sujet.

## Auteurs

- Alan Hilarion 👨‍💻
- Killian Vincent 👨‍💻
- Léon Gallet 👨‍💻

## Démo en ligne 🌐

Vous pouvez découvrir notre démo en suivant ce [lien](https://snaplink.luwa.fr/index.php).
