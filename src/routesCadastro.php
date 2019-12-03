<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/cadastro/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastro/' route");

        $conexao = $container->get('pdo');

        $resultSet = $conexao->query('SELECT * FROM proprietario')->fetchAll();

        $args['proprietarios'] = $resultSet;

        // Render index view
        return $container->get('renderer')->render($response, 'cadastro.phtml', $args);

    });

    $app->post('/cadastro/', function (Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/cadastro/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $modelo = $_POST['modelo'];
        $marca = $_POST['marca'];
        $ano = $_POST['ano'];

        $id_carro = $_POST['id_carro'];
        $id_proprietario = $_POST['id_proprietario'];

        $nomeProprietario = $_POST['nomeProprietario'];

        $resultSet = $conexao->query("INSERT INTO carro (modelo, marca, ano)
                                    VALUES ('$modelo', 
                                            '$marca', 
                                            '$ano'),
                                     INSERT INTO carro_proprietario (id_carro, id_proprietario)
                                    VALUES ('$id_carro', '$id_proprietario')");

        return $response->withRedirect('/cadastro/');
    });

};
