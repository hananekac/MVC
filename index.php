
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('controller/frontend.php');

try{

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['postID']) && $_GET['postID'] > 0) {
                post();
            }
            else {
                throw new Exception('Erreur : aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == "addComment"){
            if (isset($_GET['postID']) && $_GET['postID'] > 0){
                if ( !empty($_POST['author'])  && !empty($_POST['comment'])  )
                addComment($_GET['postID'],$_POST['author'],$_POST['comment']);
                else
                    throw new Exception('Erreur : Tous les champs sont obligatoires');
            }
        }
        elseif ( $_GET['action'] == "modifyComment" )
        {
            modifyComment($_GET['commentId']);
        }

        elseif ($_GET['action'] == "updateComment")
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0)
                if ( !empty($_POST['author'])  && !empty($_POST['comment'])  )
                    updateComment($_GET['commentId'],$_POST['author'],$_POST['comment']);
                else
                    throw new Exception('Erreur : Tous les champs sont obligatoires');
    }
    else {
        listPosts();
    }


}
catch (Exception $e){
    echo $e->getMessage();
}
