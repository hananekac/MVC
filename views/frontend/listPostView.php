<?php $title = "Mon Blog"; ?>

<?php ob_start(); ?>
<h1>Mon blog !</h1>
<p>Derniers articles du blog :</p>

<?php

    while ($data = $posts->fetch())
    {
        ?>
        <div class="news">
            <h3>
                <?= htmlspecialchars($data['title']) ?>
                <em>le <?= $data['creation_date_fr'] ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($data['content'])) ?>
                <br />
                <em><a href="index.php?action=post&postID=<?= $data['id'] ?> ">Commentaires</a></em>
            </p>
        </div>
        <?php
    }
    $posts->closeCursor();

    $content = ob_get_clean();
?>

<?php require 'template.php';?>
