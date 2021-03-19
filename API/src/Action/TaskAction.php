<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Query\TaskQuery;

final class TaskAction
{
    public function getAll(Request $request, Response $response): Response
    {
        $types = new TaskQuery();
        $res  = $types->getAll();

        $response->getBody()->write(json_encode($res));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function create(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $types = new TaskQuery();
        $types->insert($data);

        $response->getBody()->write((string)json_encode(['Created' => true]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $types = new TaskQuery();
        $types->update($data);

        $response->getBody()->write((string)json_encode(['Edited' => true]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function alterStatus(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $types = new TaskQuery();
        $types->alterStatus($data);

        $response->getBody()->write((string)json_encode(['Altered' => true]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $types = new TaskQuery();
        $types->delete($data['id']);

        $response->getBody()->write((string)json_encode(['Deleted' => true]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
