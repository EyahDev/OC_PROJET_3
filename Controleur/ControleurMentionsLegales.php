<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 21/06/2017
 * Time: 00:13
 */

namespace Blog\Controleur;


use Blog\Framework\Controleur;

class ControleurMentionsLegales extends Controleur {

    public function index() {
        $this->genererVue();
    }

}