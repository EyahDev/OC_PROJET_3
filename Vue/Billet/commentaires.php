<?php

function affichage($reponses, $marge, $niveau, $commentaires, $parent = null) {
echo '<div class="conteneurComEnfants">';
    foreach ($reponses as $reponse) {

        if ($parent) : ?>
            <?php if ($niveau == 3) : ?>
            <div>
                <div class="contentComs" >
                    <div class="contentComs2">
                        <p class="userCom" style="font-size: 60px"><i class="fa fa-user-circle" aria-hidden="true"></i></p>
                        <p class="auteurCom" style="margin-bottom: 0">
                            <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                                <a class="supprVolee" href="<?= 'signalement/suppressiondirect/' .$reponse['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <?php endif; ?>
                            <strong><?=  htmlspecialchars($reponse['auteur'], ENT_QUOTES, 'UTF-8', false) ?></strong> en réponse à <strong><?=  htmlspecialchars($parent['contenu'], ENT_QUOTES, 'UTF-8', false)?></strong> - <time><?= $reponse['dateFormate']?></time>
                        </p>
                        <p class="contenuCom"><?= htmlspecialchars($reponse['contenu'], ENT_QUOTES, 'UTF-8', false) ?></p>

                        <form class="formSignalement" id="signaler" method="POST" action="billet/signaler">
                            <input type="hidden" name="idCom" value="<?= $reponse['id'] ?>">
                            <input type="hidden" name="idBillet" value="<?= $reponse['billet_id']?>">
                            <button class="buttonSignalement" type="submit"><i class="fa fa-flag" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <hr />
                </div>
            </div>

            <?php else : ?>

                    <div>
                        <div class="contentComs">
                            <div class="contentComs2">
                                <p class="userCom" style="font-size: 60px"><i class="fa fa-user-circle" aria-hidden="true"></i></p>
                                <p class="auteurCom" style="margin-bottom: 0">
                                    <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                                        <a class="supprVolee"href="<?= 'signalement/suppressiondirect/' .$reponse['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                                    <?php endif; ?>
                                    <strong><?=  htmlspecialchars($reponse['auteur'], ENT_QUOTES, 'UTF-8', false) ?></strong> en réponse à <strong><?=  htmlspecialchars($parent['auteur'], ENT_QUOTES, 'UTF-8', false)?></strong> - <time><?= $reponse['dateFormate']?></time>
                                </p>
                                <p class="contenuCom"><?= htmlspecialchars($reponse['contenu'], ENT_QUOTES, 'UTF-8', false) ?></p>
                                <button class="repondre" data-to="<?= $reponse['id'] ?>">Répondre</button>

                                <form class="formSignalement" id="signaler" method="POST" action="billet/signaler">
                                    <input type="hidden" name="idCom" value="<?= $reponse['id'] ?>">
                                    <input type="hidden" name="idBillet" value="<?= $reponse['billet_id']?>">
                                    <button class="buttonSignalement"  type="submit"><i class="fa fa-flag" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                        <form class="formRepondre" data-to="<?= $reponse['id'] ?>" action="billet/commenter" method="POST">
                            <label for="auteurCom">Votre pseudo</label>
                            <input type="text" id="auteurCom" name="auteur" required />
                            <label for="txtCommentaire">Votre commentaire</label>
                            <textarea name="contenu" id="txtCommentaire" required></textarea>
                            <input type="hidden" name="id" value="<?= $reponse['billet_id'] ?>">
                            <input type="hidden" name="reponse" value="<?= $reponse['id'] ?>">
                            <button class="buttonRepondre" type="submit">Commenter</button>
                        </form>
                        <hr />
                    </div>
            <?php endif; ?>
        <?php else : ?>
            <div>
                <div class="contentComs">
                    <div class="contentComs2">
                        <p class="userCom" style="font-size: 60px"><i class="fa fa-user-circle" aria-hidden="true"></i></p>
                        <p class="auteurCom" style="margin-bottom: 0">
                            <?php if(isset($_SESSION['idUtilisateur'])) : ?>
                                <a class="supprVolee" href="<?= 'signalement/suppressiondirect/' .$reponse['id'] ?>"><i class="fa fa-times" aria-hidden="true"></i></a>
                            <?php endif; ?>
                            <strong><?= htmlspecialchars($reponse['auteur'], ENT_QUOTES, 'UTF-8', false) ?></strong> - <time><?= $reponse['dateFormate']?></time>
                        </p>
                        <p class="contenuCom"><?= htmlspecialchars($reponse['contenu'], ENT_QUOTES, 'UTF-8', false)?></p>
                        <button class="repondre" data-to="<?= $reponse['id'] ?>">Répondre</button>

                        <form class="formSignalement" id="signaler" method="POST" action="billet/signaler">
                            <input type="hidden" name="idCom" value="<?= $reponse['id'] ?>">
                            <input type="hidden" name="idBillet" value="<?= $reponse['billet_id']?>">
                            <button class="buttonSignalement"  type="submit"><i class="fa fa-flag" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
                <form class="formRepondre" data-to="<?= $reponse['id'] ?>" action="billet/commenter" method="POST">
                    <label for="auteurCom">Votre pseudo</label>
                    <input type="text" id="auteurCom" name="auteur" required />
                    <label for="txtCommentaire">Votre commentaire</label>
                    <textarea name="contenu" id="txtCommentaire" required></textarea>
                    <input type="hidden" name="id" value="<?= $reponse['billet_id'] ?>">
                    <input type="hidden" name="reponse" value="<?= $reponse['id'] ?>">
                    <button class="buttonRepondre" type="submit">Commenter</button>
                </form>
                <hr />
            </div>

        <?php endif;?>
        <?php
        if (isset($commentaires['reponseCom'][$reponse[0]])) {
            if ($niveau == 3){
                affichage($commentaires['reponseCom'][$reponse[0]], $marge, $niveau, $commentaires, $reponse);
            } else {
                affichage($commentaires['reponseCom'][$reponse[0]], $marge+20, $niveau+1, $commentaires, $reponse);
            }

        }
    }
    echo '</div>';
}
affichage($comTraites['Com'],0,0, $comTraites);

?>


