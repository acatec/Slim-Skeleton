<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

$app->get('/i/[{name}]', \eduslim\application\controller\DemoController::class);
