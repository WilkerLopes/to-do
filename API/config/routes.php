<?php

use Slim\App;
use App\Action\TypeAction;
use App\Action\TaskAction;

return function (App $app) {
    $app->addBodyParsingMiddleware();
    $app->addRoutingMiddleware();
    $app->addErrorMiddleware(true, true, true);

    $app->get('/', \App\Action\HomeAction::class)->setName('home');

    $app->get('/task', TaskAction::class . ':getAll');
    $app->post('/task', TaskAction::class . ':create');
    $app->put('/task', TaskAction::class . ':edit');
    $app->put('/task/status', TaskAction::class . ':alterStatus');
    $app->delete('/task', TaskAction::class . ':delete');

    $app->get('/type', TypeAction::class . ':getAll');
    $app->post('/type', TypeAction::class . ':create');
    $app->put('/type', TypeAction::class . ':edit');
    $app->delete('/type', TypeAction::class . ':delete');

    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($req, $res) {
        $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
        return $handler($req, $res);
    });
};
