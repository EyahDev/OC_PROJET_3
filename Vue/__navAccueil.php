<header id="nav-fixed">
    <div class="logo">
        <a href="index.php"><img src="Contenu/img/logo.png" title="Jean Forteroche" alt="logo_jeanforteroche"/></a>
    </div><!-- end logo -->

    <div id="menu_icon"></div>
    <nav>
        <ul>
            <li><a class="js-scrollTo" href="#accueil" class="selected">Accueil</a></li>
            <?php if (count($navCategories) > 1) : ?>
                <li class="dropdown">
                    <a>Catégories</a>
                    <ul class="dropdown-content">
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
            <li><a href="admin"><i class="fa fa-cogs" aria-hidden="true"></a></i></li>
        </ul>
    </nav>
</header>