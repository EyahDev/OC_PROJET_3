<?php $this->titre  = "Jean Forteroche - Modération des commentaires"; ?>

<?php include 'Vue/nav.php'?>

    <section class="main clearfix">
        <section class="top" style="background: url(Contenu/img/Design-tips-ebook-1-1032x581.png), no-repeat, center, fixed; background-size: cover">
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
            <div class="content" style="margin-right: auto; margin-left: auto; text-align: center">
                <?= $messageConfirmation ?>
                <h3>Commentaires signalés</h3>
                <?php if ($recupCommentaires->rowCount()) :?>
                    <div id="demo">
                        <!-- Responsive table starts here -->
                        <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
                        <div class="table-responsive-vertical shadow-z-1">
                            <!-- Table starts here -->
                            <table id="table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Titre du billet</th>
                                    <th>Auteur</th>
                                    <th>Commentaires</th>
                                    <th>Signalement</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($recupCommentaires AS $affichageCommentaire) : ?>
                                    <tr>
                                        <td data-title="Titre du billet"><a href="<?= "billet/index/" . $affichageCommentaire['billet_id'] ?>#commentaires"><?= $this->nettoyageFailles($affichageCommentaire['titre']); ?></a></td>
                                        <td data-title="Auteur"><?= $this->nettoyageFailles($affichageCommentaire['auteur']); ?></td>
                                        <td data-title="Commentaires"><?= $this->nettoyageFailles($affichageCommentaire['contenu']); ?></td>
                                        <td data-title="Signalement"> <?= ($affichageCommentaire['moderation'] == 1)? $affichageCommentaire['signalement']. ' nouveau(x) signalement malgré votre approbation' : $affichageCommentaire['signalement'] ?></td>
                                        <td data-title="Action"><a href="<?= "signalement/approuver/" . $affichageCommentaire['id']?>" style="color: green;"><i class="fa fa-check" aria-hidden="true"></i> Approuvé</a> /
                                            <a href="<?= "signalement/suppression/" . $affichageCommentaire['id']?>" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a></td>
                                        <td data-title="Details"><a href="<?= "signalement/details/" . $affichageCommentaire['id'] ?>">Afficher <i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else : ?>
                    <p>Aucun commentaires n'a été signalés</p>
                <?php endif; ?>

                <h3>Commentaires approuvés</h3>
                <?php if ($recupCommentairesApprouves->rowCount()) :?>
                    <div id="demo">
                        <!-- Responsive table starts here -->
                        <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
                        <div class="table-responsive-vertical shadow-z-1">
                            <!-- Table starts here -->
                            <table id="table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Titre du billet</th>
                                    <th>Auteur</th>
                                    <th>Commentaires</th>
                                    <th>Signalement</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($recupCommentairesApprouves AS $affichageCommentaireApprouve) : ?>
                                    <tr>
                                        <td data-title="Titre du billet"><a href="<?= "billet/index/" . $affichageCommentaire['billet_id'] ?>#commentaires"><?= $this->nettoyageFailles($affichageCommentaire['titre']); ?></a></td>
                                        <td data-title="Auteur"><?= $this->nettoyageFailles($affichageCommentaireApprouve['auteur']); ?></td>
                                        <td data-title="Commentaires"><?= $this->nettoyageFailles($affichageCommentaireApprouve['contenu']); ?></td>
                                        <td data-title="Signalement"><?= $this->nettoyageFailles($affichageCommentaireApprouve['signalement']); ?></td>
                                        <td data-title="Action"><a href="<?= "signalement/suppression/" . $affichageCommentaireApprouve['id']?>" style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a></td></td>
                                        <td data-title="Details"><a href="<?= "signalement/details/" . $affichageCommentaireApprouve['id'] ?>">Afficher <i class="fa fa-eye" aria-hidden="true"></i> </a></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php else : ?>
                    <p>Aucun commentaires n'a été approuvés</p>
                <?php endif; ?>
            </div><!-- end content -->
        </section>

    </section><!-- end main -->



