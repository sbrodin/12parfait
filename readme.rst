#####################
Application 12parfait
#####################

12parfait est une application de pronostics en ligne entre amis qui permet de définir
des scores sur des matchs de football (d'autres sports viendront peut-être ensuite).
Un système de points est en place :
    - bon résultat (victoire, nul, défaite) : 4 points,
    - bon score pour l'équipe 1 : 3 points,
    - bon score pour l'équipe 2 : 3 points,
    - bonne différence de buts : 2 points.
Et le total de points possibles à marquer pour un match est donc de 12 !
Un classement est disponible pour vous faire une idée de votre niveau par rapport
aux autres.
Vous pourez aussi bientôt créer des "ligues" pour sélectionner des championnats sur
lesquels placer vos pronostics et rester entre amis.

*******************
Release Information
*******************

Ce dépôt contient le code pour développeurs.
Pour une utilisation en environnement de production, il est nécessaire de
modifier la variable ENVIRONMENT qui se trouve à la racine dans le fichier index.php.

*******************
Server Requirements
*******************

PHP version 5.4 ou plus récent est recommandé.

************
Installation
************

Copiez tous les fichiers. Ensuite copiez les fichiers depuis _application/config
vers application/config.
Changez les 2 fichiers de configuration config.php and database.php pour
correspondre à la configuration de votre serveur et à votre base de données.
Demandez une structure de base à cette adresse : `stanislas.brodin@gmail.com <mailto:stanislas.brodin@gmail.com>`_.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

**********
Ressources
**********

Cette application a été développée en utilisant `CodeIgniter <http://www.codeigniter.com/>`_.

****
TODO
****

Liste des éléments restants à faire :
    - Edition des niveaux des équipes
    - Ajouter cookie pour langue
    - Gestion des messages
    - Envoyer un email à l'inscription
    - Mes scores
        - prendre en compte les filtres
        - ajouter histogramme points par journée par championnat
    - Home
        - essayer l'affichage des tableaux en mode cards bootstrap
        - afficher/cacher message d'aide
    - Profil
        - gestion des messages d'aide
    - Classement
        - avoir un petit podium au-dessus du tableau (à terminer)
        - ajouter le nombre de 12parfait
        - ajouter un filtre par date
    - Habillage du site
    - Ajout du système de log
    - Inclure la nav dans le header pour moins de fichiers à charger
    - Inclure un système de trophées + message à la réception du trophée
        - 5 niveaux :
            - bois
            - bronze
            - argent
            - or
            - diamant
        - liste des trophées :
            - nombre de parrainages envoyés (5, 20, 50, 100, 200)
            - nombre de parrainages acceptés (1, 5, 10, 20, 50)
            - nombre de paris placés (10, 100, 200, 500, 1000)
            - nombre de jours consécutifs de connexion (5, 20, 50, 100, 500)
            - nombre de jours de connexion (10, 50, 100, 500, 1000)
            - nombre de 12parfait (3, 10, 20, 50, 100)
            - nombre de points (50, 200, 500, 2000, 5000)
            - participation à une "ligue" (5, 20, 50, 100, 200)
            - victoires de "ligue" (1, 5, 10, 20, 50)
            - nombre de trophées (3, 10, 20, 50, 100)
    - Inclure un système de jokers dépendant du nombre de trophées non utilisés
    - Ajouter le système de "ligue"
        - identifiant unique
        - lien vers la "ligue"
        - email d'invitation aux membres de la ligue
        - choix des championnats sur lesquels parier
        - comparaison des scores dans la "ligue"
        - comparaison des scores entre "ligues"
        - système de message dans la ligue
            - possibilité de signaler des messages
            - contrôles de tous les messages échangés
