CHANGELOG
=========
Ici sont notés les ajouts, modifications et réglages de bugs selon les versions.

## [v0.1.9] - (15-01-2021)

### Ajouté
- Ajout du chemin auteur dans AuteurController.php
- Ajout de la vue page dans auteur/. Elle permet de voir la page de l'auteur
- Ajout de la vue listeAuteur

### Modifié
- Mise en place du lien vers listeAuteur

### Réglé
- Apostrophe manquante dans dateDecesAuteur dans le formulaire de la vue ajoutAuteur
- Correction de l'obtention des noms de fichiers d'image
- Correction du "content" de page en "body"

## [v0.1.8] - (15-01-2021)

### Ajouté
- Ajout d'un lien temporaire vers ajoutAuteur
- Création de la vue ajoutAuteur
- Ajout de badges avec la fonction form_help de SYMFONY pour signaler la nécessité des champs

### Modifié
- Typage des variables dans AjoutAuteurType.php
- Mise en place du contrôleur de ajoutAuteur

### Réglé
- Authentification utilisateur temporairement retirée de ajoutAuteur
- Le continuum des années pour l'insertion se limite au 5e sièce de notre ère.
- Correction des bugs de ajoutAuteur

## [v0.1.6] - (13-01-2021)

### Ajouté
- Ajout du contrôleur Auteur
- Ajout de l'entité Fichier

### Modifié
- Remplacement dans Oeuvre de couverture d'un String à une liaison vers Fichier
- Remplacement dans Auteur de image d'un String à une liaison vers Fichier
- Remplacement du formulaire AjoutAuteur afin d'y appliquer les modifications

### Réglé
- Correction du problème graphique de la vue listeGenre, il manquait la fin de balise </table>

## [v0.1.5] - (13-01-2021)

### Ajouté
- Ajout des formulaires AjoutGenre et AjoutAuteur
- Ajout du contrôleur Genre
- Ajout de la vue ajoutGenre
- Ajout temporaire d'un lien vers l'ajout de Genre
- Ajout d'une partie listeGenres dans GenreController
- Ajout d'une vue listeGenres

### Modifié
- Changement du terme "Envoyé" de ajoutGenre en "Enregistrer"
- Insertion d'un pipe dans les titres pour améliorer le visuel et la compréhension

### Réglé
- Ajout des "use" manquants dans GenreController.php
- Ajout du bloc "parent" de TWIG du titre dans index.html.twig, ainsi que de celui du body en plus dans ajout.html.twig
- Correction du corps TWIG de listeGenre de "content" en body

## [v0.1.4] - (11-01-2021)

### Ajouté
- Ajout de l'entité Genre
- Ajout de l'entité Auteur
- Ajout de l'entité Oeuvre
- Création de la migration

### Modifié

### Réglé

## [v0.1.3] - (06-01-2021)

### Ajouté
- Ajout du lien vers la page admin dans le footer
- Ajout des Cards dans la page d'accueil
- Ajout des couvertures de test
- Ajout d'un style CSS dans base afin d'éviter qu'un texte soit souligné lorsqu'il est survolé

### Modifié
- Déplacement des élèments de connexion/deconnexion/inscription vers le footer
- Déplacement du footer dans un bloc TWIG du même nom
- Cards rendue cliquables
- Refonte du style des Cards
- Transformation du style Bootswatch de United en Lux
- Changement de couleur de la barre nav en dark plutôt que primary

### Réglé
- Affichage des icônes de réseaux sociaux

## [v0.1.2] - (06-01-2021)

### Ajouté
- Ajout d'un footer
- Ajout d'un élèment style CSS dans base.html.twig pour le style du footer

### Modifié
- Déplacement des élèments "À propos", "Autre fonds", "Liens", "Chronique", "Nous contacter" de la barre de navigation vers le footer

### Réglé

## [v0.1.1] - (06-01-2021)

### Ajouté
- Le Changelog (ce document)
- Ajout de la librairie apache-pack
- Ajout des liens "Livres de photographie", "Commande", "À propos", "Autre fonds", "Liens", "Chronique", "Nous contacter" dans la barre de navigation

### Modifié
- Les liens sans noms renommés en "Parutions", "Auteurs", "Oeuvres", "Bibliophilie" dans la barre de navigation

### Réglé

## [v0.1.0] - (06-01-2021)

### Ajouté
- Création du git et du repository à cette adresse : https://github.com/TomRobette/tqf
- Ajout d'une barre de recherche dans celle de navigation (uniquement visuelle pour lors)

### Modifié
- Modification visuelle de la barre de navigation

### Réglé

## [v0.1.0] - (04-01-2021)

### Ajouté
- Création de la structure du site
- Création de la base de la vue
- Création du .env.local
- Ajout de la librairie security-bundle
- Ajout de la librairie orm-pack
- Ajout de la librairie maker-bundle
- Création et liaison avec la BD (vide)
- Création de l'entité User
- Création du controleur AccueilController et de la vue accueil/index.html.twig
- Ajout des liens de connexion/deconnexion/inscription dans la barre de navigation

### Modifié
- Configuration de la route

### Réglé
- Problème de liaison avec Bootswatch