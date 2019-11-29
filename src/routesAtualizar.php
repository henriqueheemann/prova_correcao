<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/atualizar/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/atualizar/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'atualizar.phtml', $args);
    });
};
