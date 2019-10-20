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
        switch ($request->getAttribute('order')) {
            case "desc":
                $orderDESC = true;
                break;
            default:
                $orderDESC = false;
        }
        $images = $this->imageService->getAllImages($orderDESC);
        return $response->withJson($images);
    }

    public function triggerBW(Request $request, Response $response, $args): Response
    {
        if ($this->imageService->isImageBW($args['id'])) {
            $this->imageService->removeImagesWithFilter($args['id']);
        } else {
            $this->imageService->generateImagesWithFilter($args['id']);
        }
        return $response->withJson($this->imageService->getOneImage($args['id']));
    }
}
