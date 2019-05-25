<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("model/Manager.php");
class  CommentManager extends Manager
{
    /*
     * Get comments of a post
     */
    function getComments($postID)
    {
        $db = parent::getConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute([$postID]);

        return $comments;
    }

    /*
     * Add comment to a post
     */
    function newComment($postID,$author,$comment)
    {
        $db = parent::getConnect();
        $insert = $db->prepare('INSERT INTO comments (post_id, author, comment, comment_date)  VALUES(?,?,?,now())  ');
        $affectedLine = $insert->execute([$postID,$author,$comment]);
        return $affectedLine;
    }

    /*
     * Get comment
     */
    function getComment($commentId)
    {
        $db = parent::getConnect();
        $comment = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ? ');
        $comment->execute([$commentId]);

        return $comment->fetch();
    }

    /*
     * Update comment
     */

    function updateComment($commentId,$author,$comment)
    {
        $db = parent::getConnect();
        $update = $db->prepare('UPDATE comments SET author = ? ,  comment = ? WHERE id = ? ');
        $result = $update->execute([$author,$comment,$commentId]);
        return $result;

    }


}