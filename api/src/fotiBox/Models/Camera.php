<?php

namespace fotiBox\Models;

use Psr\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class Camera
{
    private $logger;
    private $imageService;
    protected $imagePath = "images";

    public function __construct(ContainerInterface $container)
    {
        $this->logger = $container->get('logger');
        $this->imageService = $container->get('imageService');
    }

    public function captureImage(Request $request, Response $response, $args): Response
    {
        $path = __DIR__ . "/../../../" . $this->imagePath . "/original/";
        $file = "DSC" . date("YmdHis") . ".jpg";
        exec("gphoto2 --capture-image-and-download --filename " . $path . $file);

        $imageId = $this->imageService->insertImageInDB($file);

        return $response->withJson($this->imageService->getOneImage($imageId));
    }
}
