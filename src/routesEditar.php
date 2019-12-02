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

        // $adicionarDono - $conexao->query('SELECT * FROM proprietario')->fetchAll();
        // $args['adicionarDono'] = $adicionarDono;

        // $queryDono - $conexao->query('SELECT nomeProprietario FROM dono WHERE id = ' . $args['id'])->fetchAll();

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

        // $queryDono - $conexao->query('SELECT nomeProprietario FROM proprietario WHERE id = ' . $args['id'])->fetchAll();
        // $args['donos'] = $queryDono;

        // $adicionarDono - $conexao->query('SELECT * FROM proprietario')->fetchAll();
        // $args['adicionarDono'] = $adicionarDono;


        if ($editar['modelo']== null || $editar['marca']== null || $editar['ano']== null) {
            $args['erro'] = "Erro! Tente Novamente.";
        } else {
            $resultSet = $conexao->query ('UPDATE carro SET modelo = "' . $editar['modelo'] . '", 
                                                            marca = "' . $editar['marca'] . '",
                                                            ano = ' . $editar['ano'] . ' WHERE id = ' . $args['id'])->fetchAll();
        }
        
        // Render index view
        return $container->get('renderer')->render($response, 'editar.phtml', $args);
    });
};
