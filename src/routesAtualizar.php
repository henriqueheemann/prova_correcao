<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/atualizar/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/atualizar/' route");

        $conexao = $container->get('pdo');

        $resultSet = $conexao->query ('SELECT * FROM carro WHERE id = ' . $args['id'])->fetchAll();

        $_SESSION['carroAtualizar']['modelo'] = $resultSet[0]['modelo'];
        $_SESSION['carroAtualizar']['marca'] = $resultSet[0]['marca'];
        $_SESSION['carroAtualizar']['ano'] = $resultSet[0]['ano'];

        // Render index view
        return $container->get('renderer')->render($response, 'atualizar.phtml', $args);
    });

    $app->post('/atualizarCarro/[{id}]', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/atualizarCarro/' route");

        $conexao = $container->get('pdo');

        $params = $request->getParsedBody();

        $atualizar = $_POST;

        if ($atualizar['modelo']== null || $atualizar['marca']== null || $atualizar['ano']== null) {
            $args['erro'] = "Erro! Tente Novamente.";
        } else {
            $resultSet = $conexao->query ('UPDATE carro SET modelo = "' . $atualizar['modelo'] . '", 
                                                            marca = "' . $atualizar['marca'] . '",
                                                            ano = ' . $atualizar['ano'] . ' WHERE id = ' . $args['id'])->fetchAll();
        }
        
        // Render index view
        return $container->get('renderer')->render($response, 'atualizar.phtml', $args);
    });
};
