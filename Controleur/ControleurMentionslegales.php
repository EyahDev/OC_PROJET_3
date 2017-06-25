<?php

namespace Blog\Controleur;

use Blog\Framework\Controleur;

class ControleurMentionslegales extends Controleur {

    /**
     * Affichage de la vue
     */
    public function index() {
        $this->genererVue();
    }

}