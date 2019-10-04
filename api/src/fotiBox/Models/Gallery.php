<?php

namespace fotiBox\Models;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Gallery
{
    private $logger;
    private $imageService;

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
        $this->imageService = $container->get('imageService');
    }

    public function getTestImage(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write(file_get_contents(__DIR__ . "/../../image/test.jpg"));
        return $response->withHeader("Content-Type", "image/jpg");
    }

    public function getImage(Request $request, Response $response, $args): Response
    {
        $path = $this->imageService->getImagePath($args['id']);
        $response->getBody()->write(file_get_contents(__DIR__ . "/../../image/" . $path));
        return $response->withHeader("Content-Type", "image/jpg");
    }

    public function getImages(Request $request, Response $response, $args): Response
    {
        $images = $this->imageService->getAllImages();
        return $response->withJson($images);
    }
}
