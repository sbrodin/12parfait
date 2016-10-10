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
Demander une structure de base à cette adresse : `stanislas.brodin@gmail.com <mailto:stanislas.brodin@gmail.com/>`_.

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
    - Update des matchs à revoir
    - Afficher un message différent pour les journées déjà terminées
    - Classement, ajouter le nombre de 12parfait, 0, 3, 4, 6 et 7
    - Habillage du site
    - Intégration des shorts names d'équipe pour petits écrans