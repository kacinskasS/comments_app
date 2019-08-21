<?php
require_once ROOT_DIR.'/src/models/Comment.php';

function indexAction()
{
    $parameters = [
        'form' => view(TEMPLATE_DIR.'crud/comment_form.html.php'),
        'list' => view(TEMPLATE_DIR.'crud/comment_list.html.php', ['comments' => getAllComments()])
    ];

    return view(TEMPLATE_DIR.'base.html.php', $parameters);
}

function newAction()
{
    header('Content-Type: application/json');
    $comment = newComment();

    if (isset($comment['id'])) {
        $comment = getComment($comment['id']);

        $template = TEMPLATE_DIR.'crud/comment.html.php';

        if ($comment['parent_id'] !== 0) {
            $template = TEMPLATE_DIR.'crud/sub_comment.html.php';
        }

        $comment['comment'] = view($template, ['comment' => $comment]);
    }

    return json_encode($comment);
}







