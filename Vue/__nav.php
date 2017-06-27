<header id="nav-fixed">
    <div class="logo">
        <a href="index.php"><img src="Contenu/img/logo.png" title="Jean Forteroche" alt="logo_jeanforteroche"/></a>
    </div><!-- end logo -->

    <div id="menu_icon"></div>
    <nav>
        <ul>
            <li><a class="js-scrollTo" href="#accueil" class="selected">Accueil</a></li>
            <?php if (count($navCategories) > 1) : ?>
                <li class="dropdownCat">
                    <a>Catégories</a>
                    <ul class="dropdown-content catDP">
                        <?php foreach ($navCategories as $navCategorie) : ?>
                            <?php if ($navCategorie['nbArticles'] != 0 ) :?>
                            <li><a class="js-scrollTo" href="#cat<?= $navCategorie['id'] ?>"><?=$navCategorie['categorie'] ?></a></li>
                            <?php endif;?>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php else : ?>
            <li><a class="js-scrollTo" href="#cat<?=$navCategories[0]['id'] ?>"><?=$navCategories[0]['categorie'] ?></a></li>
            <?php endif;?>
            <li><a class="js-scrollTo" href="#derniersCom">Derniers commentaires</a></li>
            <li><a class="js-scrollTo" href="#aPropos">A propos</a></li>
            <li><a class="js-scrollTo" href="#contact">Contact</a></li>
            <?php if (isset($_SESSION['idUtilisateur'])) :?>
                <li class="dropdownAdmin">
                    <a><i class="fa fa-cogs" aria-hidden="true"></i></a>
                    <ul class="dropdown-content adminDP">
                        <li>
                            <a href="signalement">
                                <i class="fa fa-comments" aria-hidden="true"></i> Modération <?= ($nbSignalements['count'] != 0)? '('.$nbSignalements['count'].')' : '' ?>
                            </a>
                        </li>
                        <li>
                            <a href="nouvelarticle">
                                <i  class="fa fa-pencil" aria-hidden="true"></i> Nouvel article
                            </a>
                        </li>
                        <li>
                            <a href="gestionarticles">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Gérer les articles
                            </a>
                        </li>
                        <li>
                            <a href="categorieadmin">
                                <i class="fa fa-tags" aria-hidden="true"></i> Gérer les catégories
                            </a>
                        </li>
                        <li>
                            <a href="profiladmin"><i class="fa fa-user" aria-hidden="true"></i> Mon profil</a>
                        </li>
                        <li>
                            <a href="connexion/deconnecter">
                                <i class="fa fa-sign-out" aria-hidden="true"></i> Se déconnecter
                            </a>
                        </li>
                    </ul>
                </li>
            <?php else : ?>
                <li><a href="admin"><i class="fa fa-cogs" aria-hidden="true"></a></i></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>