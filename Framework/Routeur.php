<?php

namespace Blog\Framework;

use Blog\Modele\Categories;
use Blog\Modele\Commentaire;
use Exception;

class Routeur {

    private $categories;
    private $signalement;

    /**
     * Récupération de la valeur du paramètre Action
     *
     * @param Requete $requete => Accès à la classe Requete par la variable $requete
     * @return mixed|string => Retourne la valeur du paramètre action
     */
    private function creerAction(Requete $requete) {
        // Action par défaut
        $action = "index";
        if ($requete->existeParametre('action')) {
            $action = $requete->getParametre('action');
        }
        return $action;
    }

    /**
     * Génère la vue erreur quand une erreur est levée
     *
     * @param Exception $exception => Récupération du message d'erreur
     */
    private function gererErreur(Exception $exception) {

        $vue = new Vue('erreur');

        $this->categories = new Categories();
        $this->signalement = new Commentaire();

        $navCategories = $this->categories->getCategories()->fetchAll();
        $nbSignalements = $this->signalement->getNbSignalements();

        $vue->affichageVue(array('msgErreur' => $exception->getMessage()), $navCategories, $nbSignalements);
    }

    /**
     * Géneère le contrôleur nécessaire en fonction de la requête entrante
     *
     * @param Requete $requete => Accès aux fonctions de la classe Requete
     * @return mixed|string
     * @throws Exception => lève une erreur si aucun fichier n'est trouvé
     */
    private function creerControleur(Requete $requete) {
        // Contrôleur par défaut
        $controleur  = "Accueil";
        if ($requete->existeParametre('controleur')) {
            // Récupération de la valeur du paramètre contrôleur
            $controleur = $requete->getParametre('controleur');

            // Transforme le tout en minuscule et passe la première lettre en MAJ
            $controleur = ucfirst(strtolower($controleur));
        }

        // Construction du nom du fichier du contrôleur
        $classeControleur  = 'Controleur' . $controleur;
        $fichierControleur = 'Controleur/' . $classeControleur . '.php';

        // Vérification si le fichier existe
        if (file_exists($fichierControleur)) {
            $classeControleur = "Blog\Controleur\\" . $classeControleur;

            // Instanciation du contrôleur demandé
            $controleur = new $classeControleur();

            $controleur->setRequete($requete);

            return $controleur;

        } else {
            throw new Exception("Fichier '$fichierControleur' est introuvable");

        }
    }

    /**
     * Route la requête entrante
     */
    public function routerRequete() {
        try {
            // Fusion des paramètres GET et POST
            $requete = new Requete(array_merge($_GET, $_POST));

            // Génération du contrôleur nécessaire
            $controleur = $this->creerControleur($requete);

            // Récupération de l'action
            $action = $this->creerAction($requete);

            // Exécute l'action dans le contrôleur
            $controleur->executerAction($action);

        } catch (Exception $e) {
            // Affiche la vue erreur si une erreur est levée
            $this->gererErreur($e);
        }
    }
}