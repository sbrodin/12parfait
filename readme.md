# Application 12parfait

[12parfait](https://12parfait.fr) est une application gratuite de pronostics en ligne entre amis qui permet de définir
des scores sur des matchs de football (d'autres sports viendront peut-être ensuite).

Un système de points est en place :

- bon résultat (victoire, nul, défaite) : 4 points,
- bon score pour l'équipe 1 : 3 points,
- bon score pour l'équipe 2 : 3 points,
- bonne différence de buts : 2 points.

Et le total de points possibles à marquer pour un match est donc de 12 !

Un classement est disponible pour vous faire une idée de votre niveau par rapport
aux autres.

Vous pourrez aussi bientôt créer des "challenges" pour sélectionner des championnats sur
lesquels placer vos pronostics et rester entre amis.

## Release Information

Ce dépôt contient le code pour développeurs.

Pour une utilisation en environnement de production, il est nécessaire de
modifier la variable ENVIRONMENT qui se trouve à la racine dans le fichier index.php.

## Server Requirements

PHP version 5.4 ou plus récent est recommandé.

## Installation

Copiez tous les fichiers. Ensuite copiez les fichiers depuis _application/config_ vers _application/config_.

Changez les 2 fichiers de configuration config.php et database.php pour correspondre à la configuration de votre serveur et à votre base de données.

Minifier les fichiers CSS et JS présents dans les répertoires assets/css et assets/js avec gulp.

Demandez une structure de base à cette adresse : [stanislas.brodin@gmail.com](mailto:stanislas.brodin@gmail.com>).

## License

Please see the [license agreement](https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst).

## Ressources

Cette application a été développée en utilisant [CodeIgniter](http://www.codeigniter.com/>).

## TODO

Liste des éléments restants à faire :
- Ajouter des infos sur les équipes (visibilité publique)

    - intégralité des matchs de l'équipe

        - historique passé avec résultats

        - matchs à venir avec liens vers les pronostics

    - infos diverses sur l'équipe

- Gérer les envois de mails massifs

- Améliorer l'email d'inscription

- Mes scores

    - prendre en compte les filtres

    - ajouter histogramme points par journée par championnat

- Home

    - afficher/cacher message d'aide

- Gestion des erreurs (404, db, etc.)

- Profil

    - gestion des messages d'aide

- Classement

    - ajouter le nombre de 12parfait

    - ajouter un filtre par date

- Ajouter un filtre pour les logs

- Inclure la nav dans le header pour moins de fichiers à charger

- Ajouter le système de "challenge"

    - identifiant unique

    - lien vers le "challenge"

    - email d'invitation aux membres du "challenge"

    - choix des championnats sur lesquels parier

    - comparaison des scores dans le "challenge"

    - comparaison des scores entre "challenges"

    - système de message dans le "challenge"

        - possibilité de signaler des messages

        - contrôles de tous les messages échangés

- Inclure un système de trophées + message à la réception du trophée

    - 5-6 niveaux :

        - bois

        - bronze

        - argent

        - or

        - platinium

        - diamant (au cas où)

    - liste des trophées :

        - nombre de parrainages envoyés (5, 20, 50, 100, 200)

        - nombre de parrainages acceptés (1, 5, 10, 20, 50)

        - nombre de paris placés (10, 100, 200, 500, 1000)

        - nombre de jours consécutifs de connexion (5, 20, 50, 100, 500)

        - nombre de jours de connexion (10, 50, 100, 500, 1000)

        - nombre de 12parfait (3, 10, 20, 50, 100)

        - nombre de points (50, 200, 500, 2000, 5000)

        - participation à un "challenge" (5, 20, 50, 100, 200)

        - victoires de "challenge" (1, 5, 10, 20, 50)

        - nombre de trophées (3, 10, 20, 50, 100)

- Inclure un système de jokers dépendant du nombre de trophées non utilisés
