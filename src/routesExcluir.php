<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/excluir/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/excluir/' route");

        $conexao = $container->get('pdo');

        $resultSet = $conexao->query ('DELETE FROM carro WHERE id = ' . $args['id'])->fetchAll();

        // Render index view
        return $container->get('renderer')->render($response, 'tabela.phtml', $args);
    });
};
