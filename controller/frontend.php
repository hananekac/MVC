<?php

    require_once './model/PostManager.php';
    require_once './model/CommentManager.php';

    function listPosts()
    {
        $post = new PostManager();
        $posts = $post->getPosts();
        require './views/frontend/listPostView.php';
    }

    function post()
    {
        $post = new PostManager();
        $comment = new CommentManager();
        $post = $post->getPost($_GET['postID']);
        $comments = $comment->getComments($_GET['postID']);
        require './views/frontend/postView.php';
    }

    function addComment($postId,$author,$comment)
    {
        $com = new CommentManager();
        $result = $com->newComment($postId,$author,$comment);
        if ($result)
            header('Location: index.php?action=post&postID=' . $postId);
        else
            throw new Exception("Erreur lors de l'ajout du commentaire, veuillez réessayer ultérieurement");
    }

    function modifyComment($commentId)
    {
        $com = new CommentManager();
        $comment = $com->getComment($commentId);
        require './views/frontend/updateCommentView.php';
    }
    function updateComment($commentId,$author,$comment)
    {
        $com = new CommentManager();
        $result = $com->updateComment($commentId,$author,$comment);
        if ($result)
            header('Location: index.php');
        else
            throw new Exception("Erreur lors de la mise à jour du commentaire, veuillez réessayer ultérieurement");
    }