<?php

namespace Blog;

use Blog\Framework\Routeur;
use Blog\Autoloader\Autoloader;

require_once 'Autoloader/Autoloader.php';
Autoloader::register();

$routeur = new Routeur();
$routeur->routerRequete();
