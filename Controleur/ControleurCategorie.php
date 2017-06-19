<?php

namespace Blog\Controleur;


use Blog\Framework\Controleur;
use Blog\Modele\Billet;
use Blog\Modele\Categories;

class ControleurCategorie extends Controleur {

    private $billet;
    private $categorie;

    public function __construct() {
        $this->billet = new Billet();
        $this->categorie = new Categories();
    }

    public function index() {
        // Récuperation de l'identifiant de la catégorie
        $idCategorie = $this->requete->getParametre('id');

        // Récuperation du titre de la catégorie
        $titreCategorie = $this->categorie->getTitreCategorie($idCategorie);

        // Récupération des billets lié à la catégorie
        $billets = $this->billet->getBilletsCategorie($idCategorie);

        // Génération de la vue
        $this->genererVue(array(
            'affichageBillets' => $billets,
            'titreCat' => $titreCategorie
        ));
    }

}