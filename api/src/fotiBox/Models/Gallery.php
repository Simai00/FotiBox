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

    public function getOriginalImage(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write($this->imageService->getImage($args['id'], "original"));
        return $response->withHeader("Content-Type", "image/jpg");
    }

    public function getMediumImage(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write($this->imageService->getImage($args['id'], "medium"));
        return $response->withHeader("Content-Type", "image/jpg");
    }

    public function getPreviewImage(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write($this->imageService->getImage($args['id'], "preview"));
        return $response->withHeader("Content-Type", "image/jpg");
    }

    public function getImages(Request $request, Response $response, $args): Response
    {
        $images = $this->imageService->getAllImages();
        return $response->withJson($images);
    }

    public function generateBwImages(Request $request, Response $response, $args): Response
    {
        if (!$this->imageService->isImageBW($args['id'])) {
            $this->imageService->generateImagesWithFilter($args['id']);
        }
        return $response->withJson($this->imageService->getOneImage($args['id']));
    }

    public function removeBwImages(Request $request, Response $response, $args): Response
    {
        if ($this->imageService->isImageBW($args['id'])) {
            $this->imageService->removeImagesWithFilter($args['id']);
        }
        return $response->withJson($this->imageService->getOneImage($args['id']));
    }
}
