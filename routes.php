<?php
// Titulinis puslapis
$routes['GET'][] = [
    '_name' => 'home',
    '_pattern' => '^/$',
    '_controller' => 'CommentsController',
    '_action' => 'indexAction',
    '_args' => false,
];

//add comment post
$routes['POST'][] = [
    '_name' => 'add_comment',
        '_pattern' => '^/api/comment(/|$)',
    '_controller' => 'CommentsController',
    '_action' => 'newAction',
    '_args' => false,
];

//add comment
$routes['GET'][] = [
    '_name' => 'add_comment',
    '_pattern' => '^/$',
    '_controller' => 'CommentsController',
    '_action' => 'addCommentAction',
    '_args' => false,
];

//add comment post
$routes['POST'][] = [
    '_name' => 'add_comment',
    '_pattern' => '^/$',
    '_controller' => 'CommentsController',
    '_action' => 'addCommentAction',
    '_args' => false,
];

//add comment post
$routes['GET'][] = [
    '_name' => 'php_info',
    '_pattern' => '^/php-info$',
    '_controller' => 'CommentsController',
    '_action' => 'phpInfoAction',
    '_args' => false,
];