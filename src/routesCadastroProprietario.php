<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/cadastroProprietario/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastroProprietario/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'cadastroProprietario.phtml', $args);

    });

    $app->post('/cadastroProprietario/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastroProprietario/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $nomeProprietario = $_POST['nomeProprietario'];

        $resultSet = $conexao->query("INSERT INTO proprietario (nomeProprietario) 
                                      VALUES ('$nomeProprietario')");

        return $response->withRedirect('/cadastro/');
    });

};
