<?php

namespace Blog\Framework;

use Blog\Modele\Categories;
use Exception;

class Routeur {

    private $categories;

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
     * Genère la vue erreur quand une erreur est levé
     *
     * @param Exception $exception => Récuperation du message d'erreur
     */
    private function gererErreur(Exception $exception) {

        $vue = new Vue('erreur');

        $this->categories = new Categories();

        $navCategories = $this->categories->getCategories()->fetchAll();

        $vue->affichageVue(array('msgErreur' => $exception->getMessage()), $navCategories);
    }

    /**
     * Genere le controleur necessaire en fonction de la requête entrante
     *
     * @param Requete $requete => Accès au fonction de la classe Requete
     * @return mixed|string => ??
     * @throws Exception => leve une erreur si aucun fichier n'est trouvé
     */
    private function creerControleur(Requete $requete) {
        // Controleur par défaut
        $controleur  = "Accueil";
        if ($requete->existeParametre('controleur')) {
            // Récuperation de la valeur du paramètre controleur
            $controleur = $requete->getParametre('controleur');

            // Transforme le tout en minuscule et passe la premiere lettre en MAJ
            $controleur = ucfirst(strtolower($controleur));
        }

        // Construction du nom du fichier du controleur
        $classeControleur  = 'Controleur' . $controleur;
        $fichierControleur = 'Controleur/' . $classeControleur . '.php';

        // Vérification si le fichier existe
        if (file_exists($fichierControleur)) {
            $classeControleur = "Blog\Controleur\\" . $classeControleur;

            // instanciation du controleur demandé
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

            // Génération du controleur necessaire
            $controleur = $this->creerControleur($requete);

            // Récupération de l'action
            $action = $this->creerAction($requete);

            // Execute l'action dans le controleur
            $controleur->executerAction($action);

        } catch (Exception $e) {
            // Affiche la vue erreur si une erreur est levé
            $this->gererErreur($e);
        }
    }
}