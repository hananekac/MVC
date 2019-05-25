<?php
require_once("model/Manager.php");
class PostManager extends Manager
{
    /*
     * Get all posts
     */
    function getPosts()
    {
        $db = parent::getConnect();

        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    /*
     * Get post by ID
     */
    function getPost($postID)
    {
        $db = parent::getConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ? ');
        $req->execute( array($postID) );
        $post = $req->fetch();
        return $post;
    }



}