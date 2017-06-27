<?php

namespace Blog\Framework;

use Exception;

class Vue {

    // Nom du fichier de la vue demandé
    private $fichier;
    private $requete;

    // Titre de la vue (défini dans le fichier)
    private $titre;

    public function __construct($action, $controleur = '') {
        $fichier = 'Vue/';
        if ($controleur != '') {
            $fichier = $fichier . $controleur . '/';
        }
        $this->fichier = $fichier . $action . '.php';
    }

    private function nettoyageFailles($valeur) {
        return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
    }

    /**
     * Genère la vue demandé à l'utilisateur
     *
     * @param $fichier => Le fichier vue à charger
     * @param $donnees =>
     * @return string => Retourne le contenu(la vue) mis en tampon
     * @throws Exception
     */
    public function generateurVue($fichier, $donnees) {
        if (file_exists($fichier)) {

            // Extraction des données pour les intégrer dans la vue
            extract($donnees);

            // Début de la temporisation
            ob_start();

            // Affichage du contenu de la vue
            require $fichier;

            // Fin de la temporisation en renvoyant la vue à l'utilisateur
            return ob_get_clean();
        } else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }

    public function affichageVue($donnees, $navCategories, $nbSignalements) {
        // Génération de la vue demandé par l'utilisateur
        $contenu = $this->generateurVue($this->fichier, $donnees);

        // Variable necessaire pour la réécriture des URL
        $racineWeb = Configuration::get('racineWeb', '/');

        // Génération du gabarit
        $vue = $this->generateurVue('Vue/gabarit.php', array(
            'titre' => $this->titre,
            'contenu' => $contenu,
            'racineWeb' => $racineWeb,
            'navCategories' => $navCategories,
            'nbSignalements' => $nbSignalements
        ));

        // Affichage de la vue
        echo $vue;
    }
}