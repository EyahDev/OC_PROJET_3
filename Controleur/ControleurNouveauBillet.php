<?php

namespace Blog\Controleur;


use Blog\Modele\Billet;
use Blog\Modele\Categories;

class ControleurNouveauBillet extends ControleurSecurise
{

    /**
     * @var Billet => Variable utile au constructeur
     */
    private $billet;
    private $categories;

    /**
     * ControleurNouveauBillet constructor.
     */
    public function __construct() {
        $this->billet = new Billet();
        $this->categories = new Categories();
    }

    /*
     * Action par défaut du contrôleur
     */
    public function index() {
        $recupCategories = $this->categories->getCategories()->fetchAll();

        $this->genererVue(array('categories' => $recupCategories));
    }

    /**
     * Publication du nouveau billet dans la base de données
     */
    public function publication() {
        //
        // Recuperation des informations du nouveau billet
        $auteur = $this->requete->getParametre('auteurNvArticle');
        $titre = $this->requete->getParametre('titreNvBillet');
        $contenu = $this->requete->getParametre('contenuNvBillet');
        $categorie = $this->requete->getParametre('categorieNvArticle');
        $urlTuile = $this->requete->getParametre('urlTuile');
        $urlPres = $this->requete->getParametre('urlPres');

        if ($urlTuile == '') {
            $urlTuile = 'Contenu/img/default/tuile_default.jpg';
        }

        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/pres_default.jpg';
        }

        $this->billet->setNvBillet($titre, $contenu, $categorie, $urlTuile, $urlPres, $auteur);

        // Incrémnetation du nombre de billets liés à la catégorie
        $this->categories->setNbBillets($categorie);

        // Définition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation', 'Votre nouvel article a bien été publié.');

        $this->redirection('admin');

    }
}
