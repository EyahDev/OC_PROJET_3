<?php $this->titre = "Jean Forteroche - Catégorie : un billet pour l'Alaska"; ?>
<?php include 'Vue/nav.php'?>

<section class="main clearfix">
    <section class="top" style="background-image: url(<?= $titreCat['url_img_pres']?>)">
        <div class="wrapper content_header clearfix">
            <h1 class="title">
                <?= $titreCat['categorie']?>
                <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                    <a style="font-size: 18px" href="<?= "categorieadmin/modification/" .$titreCat['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </h1>
        </div>
    </section><!-- end top -->

<?php foreach ($affichageBillets as $billets) : ?>

    <section class="wrapper">
        <div class="content">
            <h1 style="margin-bottom: 20px">
                <?= $billets['titre']?>
                <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                    <a style="font-size: 18px" href="<?= "gestionbillets/modification/" .$billets['id']?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                <?php endif; ?>
            </h1>
            <p class="infoBillet" style="margin-bottom: 15px">
                <i class="fa fa-calendar-o" aria-hidden="true"></i> <?= $billets['billet_date']?>
                <a style="text-decoration: none" href="index.php#aPropos"><i style="padding-left: 10px;" class="fa fa-user" aria-hidden="true"></i> <?= $billets['pseudo_auteur'] ?></a>
                <a href="<?= 'billet/index/' .$billets['id']?>#commentaires"><i style="padding-left: 10px;" class="fa fa-comment" aria-hidden="true"></i> <?= $billets['nbCom'] ?> commentaire(s) </a>
                <i style="padding-left: 10px;" class="fa fa-tag" aria-hidden="true"></i> <?= $billets['categorie'] ?></p>
            <hr/>
            <p><?= $billets['extrait']?></p>
            <a href="<?= 'billet/index/' .$billets['id'] ?>"><button data-title="Tous les billets">Lire la suite</button></a>
        </div><!-- end content -->
    </section>

<?php endforeach; ?>

</section>
