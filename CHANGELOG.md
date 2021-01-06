CHANGELOG
=========
Ici sont notés les ajouts, modifications et réglages de bugs selon les versions.


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