<?php

function indexAction()
{
    $baseTemplate = ROOT_DIR.'/src/views/templates/base.html.php';

    $formTemplate = ROOT_DIR.'/src/views/templates/crud/comment_form.html.php';
    $parameters['form'] = view($formTemplate);

    return view($baseTemplate, $parameters);
}

