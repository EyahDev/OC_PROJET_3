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

<?php foreach ($affichageBillets as $billets) : ?>

    <section class="wrapper">
        <div class="content">
            <h1>
                <?= $this->nettoyageFailles($billets['titre']) ?>
                <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                    <a class="voleeAdmin" href="<?= "gestionbillets/modification/" .$billets['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </h1>
            <p class="infoBillet">
                <i class="fa fa-calendar-o" aria-hidden="true"></i> <?= $billets['billet_date']?>
                <a href="index.php#aPropos"><i class="fa fa-user iconPresArticle" aria-hidden="true"></i> <?= $billets['pseudo_auteur'] ?></a>
                <a href="<?= 'billet/index/' .$billets['id']?>#commentaires"><i class="fa fa-comment iconPresArticle" aria-hidden="true"></i> <?= $billets['nbCom'] ?> commentaire(s) </a>
                <i  class="fa fa-tag iconPresArticle" aria-hidden="true"></i> <?= $this->nettoyageFailles($billets['categorie']) ?></p>
            <hr/>
            <p><?= $billets['extrait'] ?></p>
            <a href="<?= 'billet/index/' .$billets['id'] ?>"><button data-title="Tous les billets">Lire la suite</button></a>
        </div><!-- end content -->
    </section>

<?php endforeach; ?>

</section>
