<?php

namespace fotiBox\Models;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Gallery
{
    private $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
    }

    public function getTestImage(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write(file_get_contents(__DIR__ . "/../../image/test.jpg"));
        return $response->withHeader("Content-Type", "image/jpg");
    }
}
