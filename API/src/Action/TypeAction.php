<?php

namespace App\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Query\TypeQuery;

final class TypeAction
{
    public function getAll(Request $request, Response $response): Response
    {
        $types = new TypeQuery();
        $data = $types->getAll();

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function create(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $types = new TypeQuery();
        $types->insert($data);

        $response->getBody()->write((string)json_encode(['Created' => true]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function edit(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $types = new TypeQuery();
        $types->update($data);

        $response->getBody()->write((string)json_encode(['Altered' => true]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $types = new TypeQuery();
        $types->delete($data['id']);

        $response->getBody()->write((string)json_encode(['Deleted' => true]));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
