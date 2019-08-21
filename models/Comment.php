<?php

require_once ROOT_DIR.'/lib/Db.php';

function getAllComments()
{
    $query = "SELECT id, name, comment, date, parent_id FROM comments ORDER BY parent_id ASC, date DESC";

    $comments = dbQuery($query);

    if (empty($comments)) {
        return ['fail' => 'No Comments'];
    }

    $ordered_comments = array();

    foreach ($comments as $comment) {
        if ($comment['parent_id'] == 0) {
            $ordered_comments[$comment['id']] = $comment;
        } else {
            $ordered_comments[$comment['parent_id']]['child'][$comment['id']] = $comment;
        }
    }

    return $ordered_comments;
}

function newComment()
{
    if (isset($_POST)) {

        $email = $_POST["email"];

        $errors = [];

        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {
            $errors['email'] = 'neteisingas el. paštas';
        }

        if (!isset($_POST['name']) || '' === $_POST['name']) {
            $errors['name'] = 'nurodykite vardą pavardę';
        }

        if (!isset($_POST['comment']) || '' === $_POST['comment']) {
            $errors['comment'] = 'nepalikite tuščio komentaro';
        }

        if (empty($errors)) {
            $query = "INSERT INTO comments(email, name, comment, parent_id) VALUES (?,?,?,?)";
            $types = ['s', 's', 's', 'i'];
            if (!isset($_POST['parent_id'])) {
                $_POST['parent_id'] = 0;
            }
            $args = [$_POST['email'], $_POST['name'], $_POST['comment'], $_POST['parent_id']];
            $comment_id = dbQuery($query, $types, $args, 'w', true);

            return ['id' => $comment_id];
        }

        return ['error' => $errors];
    } else {
        return false;
    }

}

function getComment($commentId)
{
    $query = "SELECT id, name, comment, date, parent_id FROM comments WHERE id = ?";

    $comment = dbQuery($query, ['s'], [$commentId]);

    if (!empty($comment)) {
        $comment = reset($comment);
    }

    return $comment;
}


function email_valid()
{
    if (isset($_POST["submit"])) {


        $email = $_POST["email"];

        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) {

            echo "not valid email";
        } else {
            echo "valid email";
        }

    }
}