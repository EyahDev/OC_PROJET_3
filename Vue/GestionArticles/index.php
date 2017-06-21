<?php $this->titre  = "Jean Forteroche - Gerer les articles"; ?>

<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix infoCategorie">
            <div class="work_nav">
                <ul class="btn clearfix">
                    <li><a href="admin" class="previous" data-title="Retour"></a></li>
                </ul>
            </div><!-- end work_nav -->
            <h1 class="title">Gerer les articles</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentAdmin">
            <h3>Articles publiés</h3>
            <?= $messageConfirmation?>
            <?php if ($recupArticles->rowCount()) : ?>
                <div id="demo">
                    <!-- Responsive table starts here -->
                    <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
                    <div class="table-responsive-vertical shadow-z-1">
                        <!-- Table starts here -->
                        <table id="table" class="table table-hover">
                            <thead>
                            <tr>
                                <th>Titre de l'article</th>
                                <th>Date de publication</th>
                                <th>Catégorie</th>
                                <th>Commentaires</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($recupArticles AS $affichageArticle) : ?>
                                <tr>
                                    <td data-title="Titre de l'article"><?= $this->nettoyageFailles($affichageArticle['titre']); ?></td>
                                    <td data-title="Date de publication"><time><?= $affichageArticle['article_date']?></time></td>
                                    <td data-title="Catégorie"><?= $this->nettoyageFailles($affichageArticle['categorie']) ?></td>
                                    <td data-title="Commentaires"><?= $affichageArticle['nbArticle']?></td>
                                    <td data-title="Action">
                                        <a href="<?= "gestionArticles/modification/" . $affichageArticle['id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i> Modifier</a> /
                                        <a class="alertSignalement" href="<?= "gestionArticles/suppression/" . $affichageArticle['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php else : ?>
                <p>Aucun articles n'a été publiés</p>
            <?php endif; ?>
        </div><!-- end content -->
    </section>

</section><!-- end main -->