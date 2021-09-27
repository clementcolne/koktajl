# Koktajl
Koktajl est un projet scolaire développé durant ma 3ème année de licence.
Il s'agit d'un site web référençant des recettes de cocktails, où l'on peut se créer un compte et enregistrer nos recettes préférées. 

## Fonctionnalités
- Créer un compte
- Supprimer son compte
- Modifier son compte
- Consulter une recette
- Ajouter une recette aux favoris
- Supprimer une recette des favoris
- Effectuer une recherche par mot clé avec auto-complétion
- Effectuer une recherche par filtre

## Technologies
- PHP
- HTML
- CSS with [Bootstrap](https://getbootstrap.com)
- [JQuery](https://jquery.com)
- SQL (MySql)

## Déploiement
Pour déployer le projet, lancer la stack [WAMP](https://www.wampserver.com) pour Windows, [MAMP](https://www.mamp.info/en/mac/) pour Mac, et [LAMP](https://doc.ubuntu-fr.org/lamp) pour les distributions Linux.
Ensuite, cloner le projet avec la commande `git@github.com:clementcolne/koktajl.git`
Enfin, exécuter le fichier `assets/database/install.php` par l'adresse `http://localhost:8888/koktajl/assets/database/install.php` pour Mac par exemple.
Suite à cela, la base de données est installée, configurée et remplie, vous pouvez accéder à la page d'accueil à l'adresse `http://localhost:8888/koktajl/index.php`
