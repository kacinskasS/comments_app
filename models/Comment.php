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

        $comment = $_POST["comment"];
        $safe_comment = htmlspecialchars($comment, ENT_QUOTES);

        $safe_email = htmlspecialchars($email, ENT_QUOTES);

        $name = $_POST["name"];
        $safe_name = htmlspecialchars($name, ENT_QUOTES);


        $errors = [];

        if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $safe_email)) {
            $errors['email'] = 'Neteisingas el. paštas';
        }

        $safe_namelength= strlen($safe_name);
        if($safe_namelength >= 64) {
            $errors['name'] = 'Įvestas per ilgas vardas';
        }

        $safe_emaillength= strlen($safe_email);
        if($safe_emaillength >= 64) {
            $errors['email'] = 'Įvestas per ilgas el. paštas';
        }

        $safe_commentlength= strlen($safe_comment);
        if($safe_commentlength >= 255) {
            $errors['comment'] = 'Įvestas per ilgas komentaras';
        }

        if (!isset($safe_name) || '' === $safe_name) {
            $errors['name'] = 'Nurodykite vardą pavardę';
        }

        if (!isset($safe_comment) || '' === $safe_comment) {
            $errors['comment'] = 'Nepalikite tuščio komentaro';
        }

        if (empty($errors)) {
            $query = "INSERT INTO comments(email, name, comment, parent_id) VALUES (?,?,?,?)";
            $types = ['s', 's', 's', 'i'];
            if (!isset($_POST['parent_id'])) {
                $_POST['parent_id'] = 0;
            }
            $args = [$safe_email, $safe_name, $safe_comment, $_POST['parent_id']];
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
