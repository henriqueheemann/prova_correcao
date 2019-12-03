<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/editar/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editar/' route");

        $conexao = $container->get('pdo');
        
        $resultSet = $conexao->query ('SELECT * FROM carro WHERE id = ' . $args['id'])->fetchAll();
        
        $_SESSION['carroEditar']['modelo'] = $resultSet[0]['modelo'];
        $_SESSION['carroEditar']['marca'] = $resultSet[0]['marca'];
        $_SESSION['carroEditar']['ano'] = $resultSet[0]['ano'];
        
        // Render index view
        return $container->get('renderer')->render($response, 'editar.phtml', $args);
    });

    $app->post('/editarCarro/[{id}]', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editarCarro/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $editar = $_POST;

        $resultSet = $conexao->query('UPDATE carro SET modelo = "' . $editar['modelo'] . '",
                                                       marca = "' . $editar['marca'] . '",
                                                       ano = ' . $editar['ano'] . ' WHERE id = ' . $args['id'])->fetchAll();
                 
        return $container->get('renderer')->render($response, 'editar.phtml', $args);
    });
};