<?php

namespace Blog\Controleur;


use Blog\Modele\Billet;
use Blog\Modele\Categories;

class ControleurGestionBillets extends ControleurSecurise {

    /**
     * @var Billet => variable utile au constructeur
     */
    private $billet;
    private $categories;

    /**
     * ControleurGestionBillets constructor.
     */
    public function __construct() {
        $this->billet = new Billet();
        $this->categories = new Categories();
    }

    /**
     * Action par défaut du constructeur
     */
    public function index() {
        // Récuperation de tous les billets dans la base de données
        $billet = $this->billet->getBilletsAdmin();

        //Définition de variables vide pour le cas ou il n'y a rien à afficher
        $messageBillet = '';

        // Récuperation du message flash de confirmation
        $messageConfirmation = $this->requete->getSession()->getMessageFlash();

        if ($billet->rowCount() == 0){
            $messageBillet = 'Il n\'y aucun billet à afficher';
        }

        $this->genererVue(array(
            'recupBillets' => $billet,
            'messageBillet' => $messageBillet,
            'messageConfirmation' => $messageConfirmation
        ));
    }

    /**
     * Affiche les details du billet choisi
     */
    public function modification() {
        // Récupération de l'identifiant du billet à modifier
        $idBillet = $this->requete->getParametre('id');
        $categories = $this->categories->getCategories()->fetchAll();

        // Récuperation des informations modifiable
        $billet = $this->billet->getBillet($idBillet);

        // Génère la vue pour l'affichage
        $this->genererVue(array(
            'affichageBillet' => $billet,
            'categories' => $categories
        ));
    }

    public function suppression() {
        // Récuperation de l'identifiant du billet à supprimer
        $idBillet = $this->requete->getParametre("id");

        // Suppression du billet défini avec son identifiant
        $this->billet->supprBillet($idBillet);

        // Définition du message flash à afficher lorsque le message a été supprimer
        $this->requete->getSession()->setMessageFlash('confirmation', 'La suppression de l\'article a bien été effectué');

        // Redirection vers la liste des billet
        $this->redirection('GestionBillets');
    }

    /**
     * Publication des modifications dans la base de données
     */
    public function publication() {
        // Récupération des variables modifiés
        $idBillet = $this->requete->getParametre('id');
        $titre = $this->requete->getParametre('titreModifArticle');
        $contenu = $this->requete->getParametre('contenuArticleModif');
        $categorie = $this->requete->getParametre('categorieModifArticle');
        $urlTuile = $this->requete->getParametre('urlTuile');
        $urlPres = $this->requete->getParametre('urlPres');

        if ($urlTuile == '') {
            $urlTuile = 'Contenu/img/default/tuile_default.jpg';
        }

        if ($urlPres == '') {
            $urlPres = 'Contenu/img/default/pres_default.jpg';
        }

        // Définition du message de confirmation
        $this->requete->getSession()->setMessageFlash('confirmation', 'La modifiation du billet a été effectué.');

        // mise à jour du billet dans la base de données
        $this->billet->MAJBilet($idBillet, $titre, $contenu, $categorie, $urlTuile, $urlPres);

        // Redirection vers la liste de tous les billets
        $this->redirection('GestionBillets');
    }
}