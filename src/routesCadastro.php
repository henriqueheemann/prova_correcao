<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/cadastro/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inicio/' route");

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

        $resultSet = $conexao->query ("INSERT INTO carro (modelo, marca, ano) 
                                    VALUES ('$modelo', 
                                            '$marca', 
                                            '$ano')");
                                            
        return $response->withRedirect('/cadastro/');
    });

};
