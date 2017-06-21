<?php $this->titre = "Jean Forteroche - Catégorie : un billet pour l'Alaska"; ?>
<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background: url(<?= $titreCat['url_img_pres']?>), no-repeat, fixed, center; background-size: cover">
        <div class="wrapper content_header clearfix">
            <h1 class="title">
                <?= $this->nettoyageFailles($titreCat['categorie']) ?>
                <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                    <a class="voleeAdmin" href="<?= "categorieadmin/modification/" .$titreCat['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </h1>
        </div>
    </section><!-- end top -->

<?php foreach ($affichageArticles as $articles) : ?>

    <section class="wrapper">
        <div class="content">
            <h1>
                <?= $this->nettoyageFailles($articles['titre']) ?>
                <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                    <a class="voleeAdmin" href="<?= "gestionarticles/modification/" .$articles['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </h1>
            <p class="infoArticle">
                <i class="fa fa-calendar-o" aria-hidden="true"></i> <?= $articles['article_date']?>
                <a href="index.php#aPropos"><i class="fa fa-user iconPresArticle" aria-hidden="true"></i> <?= $articles['pseudo_auteur'] ?></a>
                <a href="<?= 'article/index/' .$articles['id']?>#commentaires"><i class="fa fa-comment iconPresArticle" aria-hidden="true"></i> <?= $articles['nbCom'] ?> commentaire(s) </a>
                <i  class="fa fa-tag iconPresArticle" aria-hidden="true"></i> <?= $this->nettoyageFailles($articles['categorie']) ?></p>
            <hr/>
            <p><?= $articles['extrait'] ?></p>
            <a href="<?= 'Article/index/' .$articles['id'] ?>"><button data-title="Tous les Articles">Lire la suite</button></a>
        </div><!-- end content -->
    </section>

<?php endforeach; ?>
    <section class="wrapper">
        <div style="text-align: center" class="content">
            <div class="pagination">

            <?php if($_GET['page'] > 1) : ?>
                <a href="categorie/index/5/<?= $_GET['page'] - 1 ?>">&laquo;</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $nbPagesNecessaires; $i++) : ?>

                <a href="categorie/index/5/<?= $i ?>" <?= ($_GET['page'] == $i)? 'class="active"' : ''?>> <?= $i?> </a>
            <?php endfor; ?>
            <?php if($_GET['page'] != $nbPagesNecessaires) : ?>
                <a href="categorie/index/5/<?= $_GET['page'] + 1 ?>">&raquo;</a>
            <?php endif; ?>
            </div>
        </div>
    </section>

</section>
