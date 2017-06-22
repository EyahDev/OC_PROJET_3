<?php

namespace Blog\Controleur;

use Blog\Modele\Article;
use Blog\Modele\Categories;

class ControleurCategorieadmin extends ControleurSecurise {

    // Déclaration des variables pour le constructeur
    private $categorie;
    private $article;

    /**
     * Instantation des classes nécessaires
     *
     * ControleurCategorieadmin constructor.
     */
    public function __construct() {
        $this->categorie = new Categories();
        $this->article = new Article();
    }

    /**
     * Récupération des éléments pour la page catégorie de l'administration du blog et affichage de la vue
     * (action par défaut)
     */
    public function index() {
        // Récupération de toutes les catégories
        $categories = $this->categorie->getCategories();

        // Récuperation du message flash
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        $this->genererVue(array(
            'categories' => $categories,
            'messageConfirmation' => $messageConfirmation
        ));
    }

    /**
     * Fonction pour la création d'une nouvelle catégorie
     */
    public function creer() {
        // Récupération des informations pour la nouvelle catégorie
        $nvCategorie = $this->requete->getParametre('nvCategorie');
        $urlPres = $this->requete->getParametre('categorieURLPres');

        // Définition de l'image de présentation par défaut si la variable est vide
        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/cat_pres_default.jpg';
        }

        // Création de la nouvelle catégorie de la base de données
        $this->categorie->setNvCategorie($nvCategorie, $urlPres);

        // Définition d'un message flash de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation', 'La catégorie a bien été créée');

        // Redirection vers la page des d'administration des catégories
        $this->redirection("CategorieAdmin");
    }

    /**
     * Fonction pour la suppression d'une catégorie
     */
    public function suppression() {
        // Récupération de l'identifiant de la catégorie
        $idCategorie = $this->requete->getParametre('id');

        // Suppression de la catégorie dans la base de données
        $this->categorie->suppressionCategorie($idCategorie);

        // Création d'un message flash de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation', 'La catégorie a bien été supprimée');

        // Redirection vers la page d'administration des catégories
        $this->redirection("CategorieAdmin");
    }

    /**
     * Fonction pour afficher l'interface de modification de la catégorie
     */
    public function modification() {
        // Récupération de l'identifiant de la catégorie
        $idCategorie = $this->requete->getParametre('id');

        // Récupération des informations de la catégorie
        $categorie = $this->categorie->getCategorie($idCategorie);

        // Affichage de la vue avec les paramètres
        $this->genererVue(array(
            'categorie' => $categorie
        ));
    }

    /**
     * Fonction la modification d'une catégorie
     */
    public function modifier() {
        // Récupération des informations de la catégorie
        $idCategorie = $this->requete->getParametre('idCategorie');
        $nomCategorie = $this->requete->getParametre('ModifCategorie');
        $urlPres = $this->requete->getParametre('ModifCategorieURLPres');

        // Mise à jour de la catégorie dans la base de données
        $maj = $this->categorie->MAJCategorie($nomCategorie, $idCategorie, $urlPres);

        // Affiche un message de confirmation si il y a eu modification ou non
        if ($maj == 1) {
            // Définition du message de confirmation avec modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'La catégorie a bien été modifié');
        } else {
            // Définition du message de confirmation sans modif
            $this->requete->getSession()->setMessageFlash('confirmation', 'Aucune modification n\'a été appliqué');
        }

        // Redirection vers la page d'administration de la catégorie
        $this->redirection('CategorieAdmin');
    }
}