<?php $this->titre = "Jean Forteroche - Modification \"A propos\""; ?>

<section class="main clearfix">
    <section class="top bgAdmin">
        <div class="wrapper content_header clearfix ">
            <div class="work_nav">

                <ul class="btn clearfix">
                    <li><a href="profiladmin" class="previous" data-title="Retour"></a></li>
                    <li><a href="admin" class="grid" data-title="Administration"></a></li>
                </ul>

            </div><!-- end work_nav -->
            <h1 class="title">Rédaction de la section "A propos"</h1>
        </div>
    </section><!-- end top -->

    <section class="wrapper">
        <div class="content contentCatAdmin">
            <?= $messageFlash ?>
            <form action="profiladmin/publierApropos" method="POST">
                <label for="URLauteur">URL de l'image de présentation de la catatégorie<br/>
                    <strong>Attention : </strong> L'image doit avoir une taille d'environ <strong>466x466px</strong> sous peine d'avoir des problèmes d'affichage.<br/>
                </label>
                <input type="text" id="URLauteur" name="URLauteur" value="<?= ($this->nettoyageFailles($infoUtilisateur['url_img_apropos']) == 'Contenu/img/default/user_default.png')? '' : $this->nettoyageFailles($infoUtilisateur['url_img_apropos']) ?>" placeholder="Une image par défaut sera générée si vous n'en avez pas" />
                <label for="aProposRedac">A propos</label>
                <textarea class="tinyMCE" id="aProposRedac" name="contenuApropos" style="height: 500px"><?= $infoUtilisateur['apropos']?></textarea>
                <input type="hidden" name="idUtilisateur" value="<?= $infoUtilisateur['id']?>">
                <button class="buttonRepondre" type="submit">Publier</button>
            </form>
        </div><!-- end content -->
    </section>
</section><!-- end main -->