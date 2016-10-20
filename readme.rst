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
aux autres. Vous pouvez créer des "Ligues" pour sélectionner des championnats sur
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

Copier tous les fichiers. Ensuite copiez les fichiers depuis _application/config
vers application/config.
Changez les 2 fichiers de configuration config.php and database.php pour
correspondre à la configuration de votre serveur et à votre base de données.
Demander une structure de base à cette adresse : `stanislas.brodin@gmail.com <mailto:stanislas.brodin@gmail.com>`_.

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

Listes des éléments restants à faire :
    - Ajouter des placeholder
    - Clean du code des vues
    - Home
        - essayer l'affichage des tableaux en mode cards bootstrap
        - voir les derniers et prochains matchs
        - afficher/cacher message d'aide
    - Profil, gestion des messages d'aide
    - Classement
        - avoir un petit podium au-dessus du tableau
        - mettre les 3 premiers en couleurs différentes (or, argent et bronze)
        - ajouter le nombre de 12parfait
        - ajouter des filtres par sport, championnat, journée, etc.
        - filtres dynamiques
    - Gérer les titles avec le fichier de langue
    - Afficher les bets des autres
    - Habillage du site