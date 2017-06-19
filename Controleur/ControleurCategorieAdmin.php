<?php

namespace Blog\Controleur;


use Blog\Modele\Billet;
use Blog\Modele\Categories;

class ControleurCategorieAdmin extends ControleurSecurise {

    private $categorie;
    private $billet;

    public function __construct() {
        $this->categorie = new Categories();
        $this->billet = new Billet();
    }

    public function index() {
        $categories = $this->categorie->getCategories();

        // Récuperation du message flash de confirmation
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        $this->genererVue(array(
            'categories' => $categories,
            'messageConfirmation' => $messageConfirmation
        ));
    }

    public function creer() {
        $nvCategorie = $this->requete->getParametre('nvCategorie');
        $urlPres = $this->requete->getParametre('categorieURLPres');

        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/cat_pres_default.jpg';
        }

        $this->categorie->setNvCategorie($nvCategorie, $urlPres);

        $this->requete->getSession()->setMessageFlash('confirmation', 'La catégorie a bien été créée');

        $this->redirection("CategorieAdmin");
    }

    public function suppression() {
        $idCategorie = $this->requete->getParametre('id');

        $this->categorie->suppressionCategorie($idCategorie);

        $this->requete->getSession()->setMessageFlash('confirmation', 'La catégorie a bien été supprimée');

        $this->redirection("CategorieAdmin");
    }

    public function modification() {
        $idCategorie = $this->requete->getParametre('id');

        $categorie = $this->categorie->getCategorie($idCategorie);

        $this->genererVue(array(
            'categorie' => $categorie
        ));
    }

    public function modifier() {
        $idCategorie = $this->requete->getParametre('idCategorie');
        $nomCategorie = $this->requete->getParametre('ModifCategorie');
        $urlPres = $this->requete->getParametre('ModifCategorieURLPres');

        $this->categorie->MAJCategorie($nomCategorie, $idCategorie, $urlPres);

        $this->requete->getSession()->setMessageFlash('confirmation', 'La catégorie a bien été modifié');

        $this->redirection('CategorieAdmin');

    }
}