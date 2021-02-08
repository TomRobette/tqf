CHANGELOG
=========
Ici sont notés les ajouts, modifications et réglages de bugs selon les versions.

## [v0.4] - (08-02-2021)

### Ajouté
- Installation du bundle vich/uploader-bundle
- Ajout du bundle uploader dans bundle.php
- Création du fichier vich_uploader.yaml
- Mise en place du chemin couvertures, auteurs et bibliophilie dans vich_uploader.yaml

### Modifié
- Changement du bundle CKEditor en 'all' dans bundle.php
- Changement du champ image de l'entité Biblio en les champs de vich_uploader
- Modification du champ 'image' des formulaires AjoutBiblioType et ModifBiblioType en 'imageFile' de vich uploader
- Modification du champ 'image' des vues ajoutBiblio et modifBiblio en 'imageFile' de vich uploader
- Mise à jour du contrôleur Biblio selon vich uploader
- Mise à jour de l'entité Oeuvre selon vich uploader
- Supression des anciennes images
- Mise à jour des formulaires AjoutOeuvreType et ModifOeuvreType selon vich uploader
- Mise à jour des vues ajoutOeuvre et modifOeuvre selon vich uploader
- Mise à jour des vues listeOeuvres et listeLivresPhoto selon vich uploader
- Mise à jour de la vue accueil selon vich uploader
- Mise à jour du contrôleur parutions selon vich uploader
- Mise à jour de l'entité Auteur selon vich uploader
- Mise à jour des formulaires AjoutAuteurType et ModifAuteurType selon vich uploader
- Mise à jour des vues ajoutAuteur et modifAuteur selon vich uploader
- Mise à jour de la vue listeAuteurs selon vich uploader
- Mise à jour du contrôleur Auteur selon vich uploader
- Mise à jour du contrôleur Accueil selon vich uploader
- Changement du namer de vich uploader en base64

### Réglé
- Changement de la redirection de modifBiblio vers 'listeBiblios' en redirection vers 'bibliophilie'
- Changement du {{base64}} de pageOeuvre en {{ vich_uploader_asset(oeuvre) }}
- Ajout de ../ sur les chemons de vich uploader parce que ce n'est pas dynamique...

## [v0.3.2] - (05-02-2021)

### Ajouté
- Ajout de l'entité Type
- Ajout de l'entité Biblio
- Ajout des formulaires AjoutBiblioType et ModifBiblioType
- Ajout du contrôleur Biblio
- Ajout d'un répertoire Bibliophilie
- Ajout d'une route vers le répertoire bibliophilie
- Ajout des contrôleurs bibliophilie, ajoutBiblio et modifBiblio
- Ajout des vues bibliophilie, ajoutBiblio et modifBiblio
- Mise en place du lien vers bibliophilie

### Modifié
- Refonte de l'affichage de listeOeuvres
- Refonte de l'affichage de listeLivresPhoto
- Refonte en deux colonnes de parutions
- Modification du footer À propos
- Ajout d'un lien email dans À propos

### Réglé
- Supression des vues Paiement

## [v0.3.1] - (05-02-2021)

### Ajouté
- Mise en place du lien vers parutions

### Modifié
- Refonte de l'affichage de listeOeuvres
- Refonte de l'affichage de listeLivresPhoto
- Refonte en deux colonnes de parutions

### Réglé

## [v0.3] - (05-02-2021)

### Ajouté
- Création d'une checklist pour le projet
- Ajout d'un bouton dynamique selon codePP dans la vue pageOeuvre
- Création du contrôleur Parution
- Création de la vue Parution

### Modifié
- Onglet commande de la barre de navigation commenté
- Déplacement de l'onglet Les amis du temps qu'il fait devant celui l'accueil
- Déplacement de l'onglet Chronique
- Modification du contrôleur accueil pour afficher les dernières sorties du mois
- Modification de la vue accueil pour afficher les dernières sorties du mois
- Ajout du champ dateAjout dans l'entité Oeuvre
- Ajout de l'auto-insertion de la dateAjout dans ajoutOeuvre
- Ajout du champs caractere dans l'entité auteur
- Ajout du champs caractere dans AjoutAuteurType et ModifAuteurType
- Ajout du champs caractere dans les vues ajoutAuteur et modifAuteur

### Réglé

## [v0.2.11] - (04-02-2021)

### Ajouté
- Mise en place du lien vers contact
- Ajout d'un contrôleur listeLivresPhoto
- Ajout d'une vue listePhoto
- Mise en place du lien vers listeLivresPhoto

### Modifié

### Réglé

## [v0.2.10] - (04-02-2021)

### Ajouté
- Ajout d'un alphabet de navigation dans la vue listeOeuvre
- Ajout d'un get('char') pour le contrôleur listeOeuvres

### Modifié
- Ajout d'un champ "caractere" dans l'entité Oeuvre
- Ajout du champ caractere dans les formulaires modifOeuvre et ajoutOeuvre
- Ajout du champ caractere dans les vues modifOeuvre et ajoutOeuvre

### Réglé

## [v0.2.9] - (03-02-2021)

### Ajouté
- Création du formulaire ContactType
- Ajout du contrôleur contact
- Installation de postfix (3, serveur1.arras-sio.com)
- Modification du .env.local pour MAILER
- Installation de symfony/swiftmailer-bundle
- Ajout de email.html.twig dans static/ pour avoir une base de mail propre

### Modifié

### Réglé
- Correction du problème de Checkbox obligatoirement cochée dans les formulaires AjoutOeuvre et ModifOeuvre

## [v0.2.8] - (03-02-2021)

### Ajouté
- Mise en place du lien vers chronique
- Ajout de la vue listeChroniques
- Ajout du contrôleur listeChroniques
- Ajout du contrôleur pageAdmin
- Ajout de la vue pageAdmin
- Mise en place du lien vers pageAdmin
- Ajout de la vue modifGenre
- Ajout du formulaire ModifGenreType
- Ajout du contrôleur modifGenre

### Modifié
- Modification de la vue modifChronique, ajoutChronique, modifApropos et ajoutApropos pour que le titre de page soit correct
- Liens admins du footer déplacés dans pageAdmin
- Ajout du lien vers modifGenre dans la vue listeGenre

### Réglé
- Changement de "return new JsonResponse($data);" en "return $this->json($data);" dans le contrôleur chronique
- Correction du problème de carousel qui se chevauche

## [v0.2.7] - (01-02-2021)

### Ajouté
- Mise en place du chemin vers apropos
- Ajout de l'entité Chronique
- Ajout des contrôleurs chronique, ajoutChornique et modifChronique
- Ajout des formulaires AjoutChroniqueType et ModifChroniqueType
- Ajout des vues chronique, ajoutChornique et modifChronique

### Modifié
- "Commentage" de la partie À propos du footer
- Déplacement de la barre de recherche à la place du "à propos"

### Réglé
- Correction du bug de la suppression d'auteur plutôt que l'oeuvre dans pageOeuvre

## [v0.2.6] - (01-02-2021)

### Ajouté
- Ajout de l'entité Apropos qui contiendra une page modifiable d'à propos
- Ajout d'un contrôleur Static
- Ajout de la vue apropos.html.twig
- Ajout des contrôleurs ajoutApropos et modifApropos
- Ajout des formulaires AjoutAproposType et ModifAproposType
- Ajout des vues ajoutApropos et modifApropos

### Modifié
- Ajout de statut et codePP (Paypal) dans l'entité oeuvre
- Ajout de statut et code PP dans ajoutOeuvre et modifOeuvre
- Ajout de statut et code PP dans les vues ajout et modif Oeuvre
- Suppression du lien "autre fonds" dans le footer
- Migration des modifications

### Réglé
- Modification de la condition TWIG dans apropos en |length
- Correction du $id du find() de modifApropos en 1

## [v0.2.5] - (01-02-2021)

### Ajouté

### Modifié

### Réglé
- Supression de webpack-encore
- Réglage du bug de manifest.json avec le widget ckeditor

## [v0.2.4] - (21-01-2021)

### Ajouté
- Mise en place de condition de connexion pour ajoutAuteur, modifAuteur, ajoutOeuvre, modifOeuvre, ajoutGenre, listeGenres

### Modifié

### Réglé

## [v0.2.3] - (21-01-2021)

### Ajouté
- Création d'un Authentificateur ConnectFrom
- Création de SecurityController
- Création de la vue login.html.twig
- Ajout de inscrire dans AccueilController
- Création de la vue inscription
- Ajout du formulaire InscriptionType
- Ajout du formulaire LoginType
- Ajout d'un rappel visuel dans le footer pour savoir qui est connecté

### Modifié
- Ajout des bioCourte des auteurs dans les pageOeuvre
- Changement de coleur des liens des pages dans le <style> de base.html.twig
- Modification de l'encodeur dans security.yaml
- Ajout du lien connexion dans le footer
- Modification de login() dans SecurityController
- Refonte des vues inscription et login
- Ajout du RedirectResponse vers accueil dans ConnectFromAuthenticator.php
- Conditionnement des boutons suppression et modification de listeAuteurs et listeOeuvres
- Mise en commentaire de l'inscription lorsque l'administrateur n'est pas connecté
- Suppression du symbole de maison pour l'accueil dans la barre de navigation au profit du titre du site
- Refonte des liens admin et user dans le footer
- Déplacement du lien "les amis du temps qu'il fait" dans la navbar
- Ajout des liens de modification et de suppression (Conditionnés) dans pageOeuvre
- Ajout des liens de modification et de suppression (Conditionnés) dans pageAuteur
- Ajout d'un mt-3 (margin-top-3) dans les composants de listeOeuvres, listeAuteurs et accueil

### Réglé
- Correction d'un texte en trop au début du CHANGELOG
- Ajout des use nécessaires dans SecurityController et AccueilController
- Suppression des security.authorization_utils dans SecurityController

## [v0.2.2] - (21-01-2021)

### Ajouté
- Ajout du formulaire modifOeuvreType
- Ajout de modifOeuvre dans le OeuvreController
- Ajout de la vue modifOeuvre
- Ajout d'un README.md

### Modifié

### Réglé
- Ajout du use ModifOeuvreType dans OeuvreController
- Modification des getImage() et setImage() de modifOeuvre

## [v0.2.1] - (21-01-2021)

### Ajouté
- Ajout du formulaire modifAuteurType
- Ajout de modifAuteur dans AuteurController
- Ajout de la vue modifAuteur

### Modifié
- Modification de la vue listeAuteur pour le lien vers modifAuteur

### Réglé
- Ajout du use ModifAuteurType dans AuteurController
- Remplacement des "place_holders" par "data" dans ModifAuteurType
- Suppression des "data" dans ModifAuteurType car ils sont inutiles
- Il n'y avait pas de FichierRepository
- Arrêt du transfert de données entre l'image d'un auteur et la modification

## [v0.2.0] - (20-01-2021)

### Ajouté
- Installation de php7.3-zip
- Installation du bundle ckeditor (composer require friendsofsymfony/ckeditor-bundle)
- Installation de ckeditor
- Installation des assets de ckeditor
- Ajout d'un répertoire ckeditor dans uploads afin d'y diriger les fichiers des composants textes (images, vidéos, etc)
- Ajout d'une nouvelle route ckeditor_directory dans services.yaml
- Création d'un fichier config.yml dans config/

### Modifié
- Modification de config/packages/twig.yaml
- Modification des champs "extrait" et "description" de AjoutOeuvreType pour ckeditor
- Mise en place en raw des balises d'extrait et de description dans pageOeuvre
- Modification des champs "bioCourte", "bioLongue", "oeuvresExt", et "liensWeb" de AjoutAuteurType pour ckeditor
- Mise en place en raw des balises bioCourte, bioLongue, oeuvresExt et de liensWeb dans pageAuteur

### Réglé

## [v0.1.11] - (19-01-2021)

### Ajouté
- Création de la vue listeOeuvres
- Création de la vue pageOeuvre

### Modifié
- Mise en place du lien vers listeOeuvres
- Ajout du lien vers l'oeuvre dans pageAuteur
- Ajout de la librairie twig/intl-extra (pour l'affichage de l'argent)
- Ajout d'un style particulier pour les liens entre auteurs et oeuvres

### Réglé
- Correction du tri de listeOeuvre par rapport à "titre" plutôt que "nom"
- Correction de la virgule en trop dans la liste des auteurs de l'oeuvre
- Ajout du h4 "oeuvre" dans pageAuteur
- Correction de la variable oeuvre.id en i.id dans le foreach de pageAuteur
- Correction de l'affichage de l'argent dans pageOeuvre
- Correction de l'affichage en majuscules des paragraphes de pageAuteur et pageOeuvre

## [v0.1.10] - (15-01-2021)+(18-01-2021)

### Ajouté
- Ajout du formulaire AjoutAuteurType
- Ajout du contrôleur OeuvreController
- Ajout de ajoutOeuvre dans le OeuvreController
- Ajout de la vue ajoutOeuvre
- Ajout de listeOeuvres et oeuvre/id/ dans OeuvreController

### Modifié
- Ajout dans le champs genre (dans AjoutAuteurType) de l'association avec l'entité
- Typage de la variable "couverture" retiré de l'entité Oeuvre
- Modification des champs d'entrées dans ajoutOeuvre
- Mise en place du lien vers ajoutOeuvre
- Ajout du champ Auteurs pour l'ajoutOeuvre

### Réglé
- Remplacement des form.variable dans les form_help de ajoutAuteur
- Correction des appels de librairies de OeuvreController
- Correction du bug "choice_label", il correspondait en fait à la valeur affichée DEPUIS L'ENTITÉ

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