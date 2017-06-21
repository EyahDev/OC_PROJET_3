<?php $this->titre  = "Jean Forteroche - Modération des commentaires"; ?>

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
                <?= $messageConfirmation ?>
                <h3>Commentaires signalés</h3>
                <p id="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Attention supprimer un commentaire avec des réponses supprimera également les réponses associées <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></p>
                <?php if ($recupCommentaires->rowCount()) :?>
                    <div id="demo">
                        <!-- Responsive table starts here -->
                        <!-- For correct display on small screens you must add 'data-title' to each 'td' in your table -->
                        <div class="table-responsive-vertical shadow-z-1">
                            <!-- Table starts here -->
                            <table id="table" class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Titre de l'article</th>
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
                                        <td data-title="Titre de l'article"><a href="<?= "article/index/" . $affichageCommentaire['article_id'] ?>#commentaires"><?= $this->nettoyageFailles($affichageCommentaire['titre']) ?></a></td>
                                        <td data-title="Auteur"><?= $this->nettoyageFailles($affichageCommentaire['auteur']); ?></td>
                                        <td data-title="Commentaires"><?= $this->nettoyageFailles($affichageCommentaire['contenu']); ?></td>
                                        <?php if ($affichageCommentaire['signalement'] < 3) : ?>
                                            <td data-title="Signalement"><?= $affichageCommentaire['signalement'] ?></td>
                                        <?php elseif ($affichageCommentaire['signalement'] <= 6 ) : ?>
                                            <td class="orange" data-title="Signalement"><?= $affichageCommentaire['signalement'] ?></td>
                                        <?php else : ?>
                                            <td class="rouge" data-title="Signalement"><?= $affichageCommentaire['signalement'] ?></td>
                                        <?php endif; ?>
                                        <td data-title="Action"><a href="<?= "signalement/approuver/" . $affichageCommentaire['id']?>" class="vert"><i class="fa fa-check" aria-hidden="true"></i> Approuvé</a> /
                                            <a href="<?= "signalement/suppression/" . $affichageCommentaire['id']?>" class="rouge" "><i class="fa fa-times" aria-hidden="true"></i> Supprimer</p></td>
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
                                    <th>Titre du Article</th>
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
                                        <td data-title="Titre de l'article"><a href="<?= "article/index/" . $affichageCommentaireApprouve['article_id'] ?>#commentaires"><?= $this->nettoyageFailles($affichageCommentaireApprouve['titre']); ?></a></td>
                                        <td data-title="Auteur"><?= $this->nettoyageFailles($affichageCommentaireApprouve['auteur']); ?></td>
                                        <td data-title="Commentaires"><?= $this->nettoyageFailles($affichageCommentaireApprouve['contenu']); ?></td>
                                        <?php if ($affichageCommentaireApprouve['signalement'] < 3) : ?>
                                            <td data-title="Signalement"><?= $affichageCommentaireApprouve['signalement'] ?></td>
                                        <?php elseif ($affichageCommentaireApprouve['signalement'] <= 6 ) : ?>
                                            <td class="orange" data-title="Signalement"><?= $affichageCommentaireApprouve['signalement'] ?></td>
                                        <?php else : ?>
                                            <td class="rouge" data-title="Signalement"><?= $affichageCommentaireApprouve['signalement'] ?></td>
                                        <?php endif; ?>

                                        <td data-title="Action"><a href="<?= "signalement/suppression/" . $affichageCommentaireApprouve['id']?>" class="rouge"><i class="fa fa-times" aria-hidden="true"></i> Supprimer</a></td></td>
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



